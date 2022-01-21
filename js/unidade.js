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
  var proprietario_unid = document.getElementById('proprietariounid').value;
  var condominio_unid = document.getElementById('condominiounid').value;
	var endereco_unid = document.getElementById('enderecounid').value;

  var request = $.ajax ({
    url:"php/unid.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      proprietario_unid: proprietario_unid,
      condominio_unid:condominio_unid,
			endereco_unid:endereco_unid,
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
    url:"php/listaunid.php",
    type:"GET",
    datatype: 'json',
    data:{
      aux_op: $("#aux_op").val()
    },
    success: function(data) {
      var data = JSON.parse(data)
      $("table > #conteudo_unid").html('')
      $("table > #conteudo_unid").append(data)
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

function abre_unid(aux_op, id) {

  $("#aux_op").val('A');

  carrega_dados(id);
  abre_modal(aux_op, 'modal-edi');
}

function carrega_dados(id) {
    $.ajax ({
      url:"php/unid.php",
      type:"POST",
      datatype:"json",
      data: {
        aux_op: 'carrega_dados',
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        console.log(data.condominio_unid);
        $("#edi_proprietariounid").val(data.proprietario_unid);
        $("#edi_condominiounid").val(data.condominio_unid);
				$("#edi_enderecounid").val(data.endereco_unid);
        $("#id").val(id);
      },
      async: true
    });
}
function salvaredicao() {
  var proprietario_unid = document.getElementById('edi_proprietariounid').value;
  var condominio_unid = document.getElementById('edi_condominiounid').value;
	var endereco_unid = document.getElementById('edi_enderecounid').value;

  var request = $.ajax ({
    url:"php/unid.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      proprietario_unid: proprietario_unid,
      condominio_unid: condominio_unid,
			endereco_unid: endereco_unid,
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
function remover_unid(aux_op, id) {
  $.ajax ({
    url:"php/unid.php",
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
