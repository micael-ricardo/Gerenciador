//Data table
$(document).ready(function () {
    $('#consultar_usuarios').DataTable({
        "processing": true,
        "ajax":
        {
            "url": "dataTable",
            "type": "GET"
        },
        "columns": [
            { "width": "200px" },
            { "width": "100px" },
            { "width": "100px" },
            { "width": "100px" },
            { "width": "50px" },
            { "width": "100px" },
            { "width": "100px" },
            { "width": "200px" },
            { "width": "50px" },
            { "width": "50px" },
            { "width": "50px" },
            { "width": "100px" },
            { "width": "50px" },
            { "width": "50px" },
        ],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "columnDefs": [
            {
                "targets": -1,
                "render": function (data, type, row) {
                    var nome = row[0];
                    var status = row[12];
                    var btnEditar = '<a href="http://localhost/Gerenciador/Colaborador/editar/' + data + '" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>';
                    var btnFinalizar = '<a id="abrir-modal" href="#"  data-id=' + data + ' data-nome=' + nome + ' " class="btn btn-danger btn-xs excluir-usuario"><i class="fa fa-trash"></i></a>';                    //             if (status === '0') {
                    if (status === '2') {
                        btnEditar = ' <button class="btn btn-info btn-xs" disabled><i class="fa fa-pencil"></i></button>';
                        btnFinalizar = ' <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash"></i></button>';
                    }
                    return btnEditar + ' ' + btnFinalizar;
                }
            },
            {
                "targets": -2,
                "render": function (data, type, row) {
                    if (data == '2') {
                        return '<span class="btn btn-danger btn-xs">Inativo</span>';
                    } else {
                        return '<span class="btn btn-success btn-xs">Ativo</span>';
                    }
                }
            },
            {
                "targets": -4,
                "render": function (data, type, row) {
                    if (data == 2) {
                        return '<span class="btn btn-primary btn-xs">Física</span>';
                    } else {
                        return '<span class="btn btn-success btn-xs">Juridica</span>';
                    }
                }
            },
            {
                "targets": -5,
                "render": function (data, type, row) {
                    if (data == 'Funcionario') {
                        return '<span class="btn btn-primary btn-xs">Funcionario</span>';
                    } else {
                        return '<span class="btn btn-success btn-xs">Fornecedor</span>';
                    }
                }
            }
        ],
        "scrollY": "250px",
        "scrollX": true,
        "select": true
    });

    // chamar filtro via ajax

    $("#botao_filtrar").click(function (event) {
        event.preventDefault();
        var nome = $('#nome').val();
        var documento = $('#documento').val();
        var telefone = $('#telefone').val();
        var cep = $('#cepFiltro').val();
        var bairro = $('#bairro').val();
        var rua = $('#rua').val();
        var numero = $('#numero').val();
        var status = $('#status').val();
        var tipo_colaborador = $('#tipo_colaborador').val();
        var tipo_pessoa = $('#tipo_pessoa').val();

        $.ajax({
            url: "dataTable",
            data:
            {
                nome: nome,
                documento: documento,
                telefone: telefone,
                cep: cep,
                bairro: bairro,
                rua: rua,
                numero: numero,
                status: status,
                tipo_colaborador: tipo_colaborador,
                tipo_pessoa: tipo_pessoa


            },
            type: "GET",
            dataType: "json",
            success: function (result) {
                console.log(result);
                var table = $('#consultar_usuarios').DataTable();
                table.rows().remove().draw();
                table.rows.add(result.data).draw();
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });



});

// select2
$(document).ready(function () {
    $('.select2').select2();
});

// função de clique no  cadastro usuarios
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
        if ($(this).val() == '2') {
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


// Vizualisar senha
$(document).ready(function () {
    $("#olho").mousedown(function () {
        $("#senha").attr("type", "text");
        $("#olho i").removeClass("fa-eye").addClass("fa-eye-slash");
    });
    $("#olho").mouseup(function () {
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

    $("#bairro").val(endereco.bairro);
    $("#rua").val(endereco.logradouro);
    $("#cidade").val(endereco.localidade);
    $("#estado").val(endereco.uf);
}

// Modal

$(document).ready(function () {

    var modal = $("#modal");
    var fecharModal = $(".close");


    //fecha o modal
    fecharModal.click(function () {
        modal.hide();
    });

    // Quando o usuário clicar fora do modal, feche-o
    $(window).click(function (event) {
        if (event.target == modal[0]) {
            modal.hide();
        }
    });
});


$(document).on("click", ".excluir-usuario", function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    let nome = $(this).data('nome');
    $('#confirmar-exclusao input[name="id"]').val(id);
    $('#nome-usuario').text(nome);
    $('#modal').show();
});

$(document).on("submit", "#confirmar-exclusao", function (e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        type: "POST",
        url: excluirUrl,
        data: form.serialize(),
        success: function () {
            alert("Colaborador inativo com sucesso!");
            $('#modal').hide();
            location.reload();
        },
        error: function () {
            alert("Ocorreu um erro ao excluir o Colaborador.");
        }
    });
});

// fim modal