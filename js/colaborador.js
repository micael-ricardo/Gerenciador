//Data table
$(document).ready(function() {
    $('#consultar_usuarios').DataTable({
      "ajax": "dataTable",
      "columns": [
        {"width": "300px"}, //defina a largura de cada coluna
        {"width": "150px"},
        {"width": "150px"},
        {"width": "150px"},
        {"width": "100px"},
        {"width": "100px"},
        {"width": "200px"},
        {"width": "300px"},
        {"width": "50px"},
        {"width": "50px"},
        {"width": "50px"},
        {"width": "150px"},
        {"width": "50px"},
        {"width": "50px"},
    ],
    "columnDefs": [
        {
            "targets": -1, //última coluna
            "render": function(data, type, row) {
              return '<a href="http://localhost/Gerenciador/Colaborador/editar/'+data+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>' + '  <a href="<?= base_url() ?>colaboradores/delete/'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>';
            }
          },
        {
          "targets": -2, //última coluna
          "render": function(data, type, row) {
            if (data == 0) {
                return '<span class="btn btn-danger btn-xs">Inativo</span>';
              } else {
                return '<span class="btn btn-success btn-xs">Ativo</span>';
              }
          }
        },
        {
            "targets": -4, //última coluna
            "render": function(data, type, row) {
              if (data == 0) {
                  return '<span class="btn btn-primary btn-xs">Física</span>';
                } else {
                  return '<span class="btn btn-success btn-xs">Juridica</span>';
                }
            }
          },
          {
            "targets": -5, //última coluna
            "render": function(data, type, row) {
              if (data == 0) {
                  return '<span class="btn btn-primary btn-xs">Funcionario</span>';
                } else {
                  return '<span class="btn btn-success btn-xs">Fornecedor</span>';
                }
            }
          }
      ],
    "scrollY": "300px", //defina a altura da tabela
    "scrollX": true //habilite a rolagem horizontal
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