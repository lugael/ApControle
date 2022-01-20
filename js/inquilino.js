function iniciaModal(modalID) {
  const modal = document.getElementById(modalID);
  $("#aux_op").val('I');
  modal.classList.add('mostrar');
  modal.addEventListener('click',(e) => {
    if(e.target.id == modalID || e.target.className == 'fechar' || e.target.className == 'salvar'){
      fecha_modal(modalID)
    }
  })
}

function salvarf() {
  const modal = document.getElementById('modal-adc');
  var nome_inq = document.getElementById('nomeinq').value;
  var idade_inq = document.getElementById('idadeinq').value;
	var sexo_inq = document.getElementById('sexoinq').value;
  var telefone_inq = document.getElementById('telefoneinq').value;
  var email_inq = document.getElementById('emailinq').value;

  var request = $.ajax ({
    url:"php/inq.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      nome_inq: nome_inq,
      idade_inq:idade_inq,
			sexo_inq:sexo_inq,
      telefone_inq: telefone_inq,
      email_inq: email_inq,
    },
    datatype:"json",
  }).done(function(resposta) {
    montagrid()

  }).fail(function(jqXHR, textStatus){

  }).always(function() {
  });
  modal.classList.remove('mostrar');

}
function montagrid(){
    $.ajax ({
    url:"php/listainq.php",
    type:"GET",
    datatype: 'json',
    data:{
      aux_op: $("#aux_op").val()
    },
    success: function(data) {
      var data = JSON.parse(data)
      $("table > #conteudo_inq").html('')
      $("table > #conteudo_inq").append(data)
    },
    async: false
  })


};
$(document).ready(function () {
  montagrid()


});

function abre_modal(aux_op, id){
  $("#aux_op").val(aux_op);
  console.log("#"+id)
  $("#"+id).addClass('mostrar');
}

function fecha_modal(id){
  const modal = document.getElementById(id);
  $(modal).removeClass('mostrar');
}

function abre_inq(aux_op, id) {

  $("#aux_op").val('A');

  carrega_dados(id);
  abre_modal(aux_op, 'modal-edi');
}

function carrega_dados(id) {
    $.ajax ({
      url:"php/inq.php",
      type:"POST",
      datatype:"json",
      data: {
        aux_op: 'carrega_dados',
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        console.log(data.idade_inq);
        $("#edi_nomeinq").val(data.nome_inq);
        $("#edi_idadeinq").val(data.idade_inq);
				$("#edi_sexoinq").val(data.sexo_inq);
        $("#edi_telefoneinq").val(data.telefone_inq);
        $("#edi_emailinq").val(data.email_inq);
        $("#id").val(id);
      },
      async: true
    });
}
function salvaredicao() {
  var nome_inq = document.getElementById('edi_nomeinq').value;
  var idade_inq = document.getElementById('edi_idadeinq').value;
	var sexo_inq = document.getElementById('edi_sexoinq').value;
  var telefone_inq = document.getElementById('edi_telefoneinq').value;
  var email_inq = document.getElementById('edi_emailinq').value;

  var request = $.ajax ({
    url:"php/inq.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      nome_inq: nome_inq,
      idade_inq: idade_inq,
			sexo_inq: sexo_inq,
      telefone_inq: telefone_inq,
      email_inq: email_inq,
      id: $("#id").val()
    },
    datatype:"json",
  }).done(function(resposta) {
    montagrid()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
  });
 fecha_modal('modal-edi');

}
function remover_inq(aux_op, id) {
  $.ajax ({
    url:"php/inq.php",
    type:"POST",
    datatype:"json",
    data: {
    id: id,
    aux_op: 'E'
},
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
}
