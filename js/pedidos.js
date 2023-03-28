//Data table

$(document).ready(function () {
    $('#consultar_usuarios').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<"H"Tlfr>t<"F"ip>',
        "oTableTools": {
            "sSwfPath": "../../js/DataTables-1.9.4/extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
        },
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Pesquisar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        },
        "aaSorting": [[0, 'desc']],
        "aoColumnDefs": [
            { "sType": "num-html", "aTargets": [0] }
        ],
        "scrollY": "250px",
        "bFilter": false,
        "ordering": false,
        "scrollX": true,
    });
});

//Mascara
$(document).ready(function () {
    $('#valor').mask('#.##0,00', { reverse: true });
    $("#telefone").mask("(00) 0000-00009");
    $("#cep").mask("99.999-999");
});

// Buscar Cep

$(document).ready(function () {

    $("#cep").on("change", function () {
        let cep = $(this).val().replace(/\D/g, '');
        console.log(cep)
        let url = `https://viacep.com.br/ws/${cep}/json/`;

        $.get(url, function (dados) {
            if (dados.erro) {
                alert("CEP não encontrado!");
            } else {
                exibirEndereco(dados);
            }
        })
            .fail(function () {
                alert("Erro ao buscar CEP!");
            });
    });
});

function exibirEndereco(endereco) {

    $("#bairro").val(endereco.bairro);
    $("#rua").val(endereco.logradouro);
    $("#cidade").val(endereco.localidade);
    $("#estado").val(endereco.uf);
}



$(document).ready(function() {
    $('#produto').change(function() {
      // Atribuir valor para o campo valor
      var valor = $(this).find(':selected').data('value');
      var valor_formatado = parseFloat(valor).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
      $('#valor').val(valor_formatado).mask('#.##0,00');   
      // Atribuir valor para o fornecedor
      var fornecedor = $(this).find(':selected').data('fornecedor');
      $('#fornecedor').val(fornecedor);   
  
    //   Sempre que ouver um change no campo produto limpa o valor total inibundo erros 
    $('#valor_total').val('');
    });
  
    $('#quantidade').blur(function() {
      // Verificar se a quantidade informada é maior que a quantidade disponível
      var quantidade_informada = parseFloat($(this).val().replace(',', '.'));
      var quantidade_disponivel = parseFloat($('#produto').find(':selected').data('quantidade'));
  
      if (quantidade_informada > quantidade_disponivel) {
        // Quantidade informada é maior que a quantidade disponível
        alert('A quantidade informada é maior que a quantidade disponível (' + quantidade_disponivel + '). O valor máximo foi preenchido no campo.');
        $(this).val(quantidade_disponivel.toFixed(2).replace('.', ','));
      }
  
      // Multiplicar a quantidade pelo valor do produto
      var valor = parseFloat($('#produto').find(':selected').data('value'));
      var valor_total = quantidade_informada * valor;
  
      // Atribuir o valor total no campo valor_total
      var valor_total_formatado = valor_total.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
      $('#valor_total').val(valor_total_formatado).mask('#.##0,00');
    });
  });
  

