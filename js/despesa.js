
function salvar() {
  const modal = document.getElementById('modal-adcdesp');
  var descricao_desp = document.getElementById('descricaodesp').value;
  var propi_unid = document.getElementById('propiunid').value;
  var tipo_desp = document.getElementById('tipodesp').value;
	var vencimento_desp = document.getElementById('vencimentodesp').value;
	var valor_desp = document.getElementById('valordesp').value;
	var status_desp = document.getElementById('statusdesp').value;

  var request = $.ajax ({
    url:"php/desp.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      propi_unid: propi_unid,
      descricao_desp: descricao_desp,
      tipo_desp:tipo_desp,
			vencimento_desp:vencimento_desp,
			valor_desp:valor_desp,
			status_desp:status_desp,
    },
    datatype:"json",
  }).done(function(resposta) {
    montagrid_desp()

  }).fail(function(jqXHR, textStatus){

  }).always(function() {
  });
  modal.classList.remove('mostrar');

}
function montagrid_desp(){
	 	var pesquisa = document.getElementById('pesquisa').value;

    $.ajax ({
    url:"php/listadesp.php",
    type:"GET",
    datatype: 'json',
    data:{
			pesquisa : pesquisa,
      aux_op: $("#aux_op").val()
    },
    success: function(data) {
      var data = JSON.parse(data)
      $("table > #conteudo_despesa").html('')
      $("table > #conteudo_despesa").append(data)
    },
    async: false
  })


};
$(document).ready(function () {
  montagrid_desp()


});

function abre_modal_despesa(aux_op, id){
  $("#aux_op").val(aux_op);
  console.log("#"+id)
  $("#"+id).addClass('mostrar');
}

function fecha_modal(id){
  const modal = document.getElementById(id);
  $(modal).removeClass('mostrar');
}

function abre_edi_desp(aux_op, id) {

  $("#aux_op").val('A');

  carrega_dados_desp(id);
  abre_modal_despesa(aux_op, 'modal-edi-desp');
}

function carrega_dados_desp(id) {
    $.ajax ({
      url:"php/desp.php",
      type:"POST",
      datatype:"json",
      data: {
        aux_op: 'carrega_dados_desp',
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        console.log(data.tipo_desp);
        $("#edi_propiunid").val(data.propi_unid);
        $("#edi_descricaodesp").val(data.descricao_desp);
        $("#edi_tipodesp").val(data.tipo_desp);
				$("#edi_vencimentodesp").val(data.vencimento_desp);
				$("#edi_valordesp").val(data.valor_desp);
				$("#edi_statusdesp").val(data.status_desp);
        $("#id").val(id);
      },
      async: true
    });
}
function salvar_edicao_despesa() {
  var propi_unid = document.getElementById('edi_propiunid').value;
  var descricao_desp = document.getElementById('edi_descricaodesp').value;
  var tipo_desp = document.getElementById('edi_tipodesp').value;
	var vencimento_desp = document.getElementById('edi_vencimentodesp').value;
	var valor_desp = document.getElementById('edi_valordesp').value;
	var status_desp = document.getElementById('edi_statusdesp').value;

  var request = $.ajax ({
    url:"php/desp.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      propi_unid: propi_unid,
      descricao_desp: descricao_desp,
      tipo_desp: tipo_desp,
			vencimento_desp: vencimento_desp,
			valor_desp: valor_desp,
			status_desp:status_desp,
      id: $("#id").val()
    },
    datatype:"json",
  }).done(function(resposta) {
    montagrid_desp()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
  });
 fecha_modal('modal-edi-desp');

}
function remover_desp(aux_op, id) {
  $.ajax ({
    url:"php/desp.php",
    type:"POST",
    datatype:"json",
    data: {
    id: id,
    aux_op: 'E'
},
    datatype:"json",
  }).done(function(resposta) {
    montagrid_desp()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
  });
}
