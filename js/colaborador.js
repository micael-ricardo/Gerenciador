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
            { "sType": "num-html", "aTargets": [0] },
        ],
        "scrollX": true,
        "scrollY": "250px",
        "bFilter": false,
        "ordering": false
    });
});



// função cadastro usuarios
$(document).ready(function () {
    var $checkbox = $('#cadastrarusuario');
    $checkbox.click(function () {
        if ($checkbox.is(':checked')) {
            $('#login, #email, #senha, #confirma').attr('required', true);
        } else {
            $('#login, #email, #senha, #confirma').removeAttr('required');
        }
    });
});


//Mascara
$(document).ready(function () {
    $('#cpf').mask('000.000.000-00');
    $("#cnpj").mask("99.999.999/9999-99");
    $("#telefone").mask("(00) 0000-00009");
    $("#cep").mask("99.999-999");
});

//Função Tipo_Pessoa
$(document).ready(function () {

    $('#pessoa_fisica').show();
    $('#nomes, #cpf').attr('required', true);

    $('input[type="radio"][name="tipo_pessoa"]').on('change', function () {
        if ($(this).val() == '0') {
            $('#nomes, #cpf').attr('required', true);
            $('#pessoa_fisica').show();
            $('#pessoa_juridica').hide();
            $('#razao_social, #cnpj').removeAttr('required');
        } else {
            $('#razao_social, #cnpj').attr('required', true);
            $('#pessoa_juridica').show();
            $('#pessoa_fisica').hide();
            $('#nomes, #cpf').removeAttr('required');
        }
    });
});

$(document).ready(function(){
    $( "#olho" ).mousedown(function() {
        $("#senha").attr("type", "text");
        $("#olho i").removeClass("fa-eye").addClass("fa-eye-slash");
      });    
      $( "#olho" ).mouseup(function() {
        $("#senha").attr("type", "password");
        $("#olho i").removeClass("fa-eye-slash").addClass("fa-eye");
      });
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

    console.log(endereco);

    $("#bairro").val(endereco.bairro);
    $("#rua").val(endereco.logradouro);
    $("#cidade").val(endereco.localidade);
    $("#estado").val(endereco.uf);
}