//Data table

$(document).ready(function () {
    var table = $('#consultar_usuarios').DataTable({
        "processing": true,
        "ajax":
        {
            "url": "dataTable",
            "type": "GET"
        },
        "columns": [
            { "width": "200px" },
            { "width": "50px" },
            { "width": "50px" },
            { "width": "300px" },
            { "width": "200px" },
            { "width": "100px" },
            { "width": "100px" },
            { "width": "50px" },
            { "width": "70px" },
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
                    var status = row[7];
                    var btnEditar = '<a href="http://localhost/Gerenciador/Produtos/editar/' + data + '" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>';
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
        ],
        "scrollY": "250px",
        "scrollX": true,
        "select": {
            style: 'single' // define que apenas uma linha pode ser selecionada
        }
    });

    // Evento click na tabela para selecionar uma linha
    $('#consultar_usuarios tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    // chamar filtro via ajax
    $("#botao_filtrar").click(function (event) {
        event.preventDefault();
        var nome = $('#nome').val();
        var login = $('#login').val();
        var email = $('#email').val();
        var status = $('#status').val();

        $.ajax({
            url: "dataTable",
            data:
            {
                nome: nome,
                login: login,
                email: email,
                status: status,
            },
            type: "GET",
            dataType: "json",
            success: function (result) {
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
            alert("Produto inativo com sucesso!");
            $('#modal').hide();
            location.reload();
        },
        error: function () {
            alert("Ocorreu um erro ao excluir o produto.");
        }
    });
});


// select2
$(document).ready(function () {
    $('.select').select2();
});


//Mascara
$(document).ready(function () {
    $('#preco').mask('#.##0,00', {reverse: true});
});


$(document).ready(function() {
    // Verifica se o campo está vazio quando o formulário é submetido
    $('#cadastro').on('submit', function(event) {
      var fornecedor = $('#fornecedor').val();
      if (fornecedor == '') {
        $('#fornecedor-error').remove();
        $('#fornecedor').after('<div id="fornecedor-error" class="text-danger">Campo obrigatório.</div>');
        event.preventDefault();
      }
    });
    
    // Verifica se o campo está vazio quando o valor do campo é alterado
    $('#fornecedor').on('change', function() {
      var fornecedor = $(this).val();
      if (fornecedor == '') {
        $('#fornecedor-error').remove();
        $(this).after('<div id="fornecedor-error" class="text-danger">Campo obrigatório.</div>');
      } else {
        $('#fornecedor-error').remove();
      }
    });
  });