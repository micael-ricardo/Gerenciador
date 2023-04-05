//Data table

$(document).ready(function () {
    var table = $('#consultar_pedidos').DataTable({
        "processing": true,
        "ajax":
        {
            "url": "dataTable",
            "type": "GET"
        },
        "columns": [
            { "width": "150px" },
            { "width": "100px" },
            { "width": "50px" },
            { "width": "50px" },
            { "width": "50px" },
            { "width": "100px" },
            { "width": "100px" },
            { "width": "100px" },
            { "width": "70px" },
            { "width": "70px" },
            { "width": "50px" },
            { "width": "100px" },
            { "width": "70px" },
            { "width": "150px" },
            { "width": "50px" },
            { "width": "200px" },
            { "width": "70px" },
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
        "scrollY": "250px",
        "scrollX": true,
        "select": {
            style: 'single' // define que apenas uma linha pode ser selecionada
        },
        "columnDefs": [
            {
                "targets": -1,
                "render": function (data, type, row) {
                    var nome = row[0];
                    var status = row[7];
                    var btnEditar = '<a href="http://localhost/Gerenciador/Pedidos/editar/' + data + '" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>';
                    var btnFinalizar = '<a id="abrir-modal" href="#"  data-id=' + data + ' data-nome=' + nome + ' " class="btn btn-success btn-xs finalizar-pedido"><i class="fa fa-check"></i></a>';                    //             if (status === '0') {
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

                    if (data == '1') {
                        return '<span class="btn btn-warning btn-xs">Em Andamento</span>';
                    } else if (data == '2') {
                        return '<span class="btn btn-danger btn-xs">Pendente</span>';
                    } else {
                        return '<span class="btn btn-success btn-xs">Concluído</span>';
                    }
                }
            },
            {
                "targets": 6,
                "render": function (data, type, row) {

                    if (data == 'dinheiro') {
                        return '<span class="btn btn-success btn-xs">Dinheiro</span>';
                    } else {
                        return '<span class="btn btn-warning btn-xs">Cartão</span>';
                    }
                }
            },
        ],
    });

    // Evento click na tabela para selecionar uma linha
    $('#consultar_pedidos tbody').on('click', 'tr', function () {
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
                var table = $('#consultar_pedidos').DataTable();
                table.rows().remove().draw();
                table.rows.add(result.data).draw();
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });


    // atualizar status 
    $('#consultar_pedidos').on('draw.dt', function () {
        var rows = table.rows().data();
        var url = "alterarStatus";
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var status_pedido = row[17];
            if (moment(row[16], 'DD/MM/YYYY HH:mm').isBefore(moment()) && status_pedido != 3) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { id: row[18], status_pedido: 2 },
                    success: function (response) {
                        console.log('Pedido atualizado com sucesso');
                    },
                    error: function (xhr, status, error) {
                        console.log('Erro ao atualizar pedido: ' + error);
                    }
                });
            }
        }
    });
});


//Mascara
$(document).ready(function () {
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


// função preencher campos com dados de produtodo colaborador
$(document).ready(function () {
    $('#produto').change(function () {

        // no primeiro change o input mask estava retornando o valor errado então tive que usar essa  formataçaão para contornar o erro
        var valor = $(this).find(':selected').data('value');
        var valor_formatado = parseFloat(valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        $('#valor').val(valor_formatado);



        // Atribuir valor para o fornecedor
        var fornecedor = $(this).find(':selected').data('fornecedor');
        $('#fornecedor').val(fornecedor);

        //   Sempre que ouver um change no campo produto limpa o valor total inibundo erros 
        $('#valor_total').val('');
    });

    $('#quantidade').blur(function () {
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
        var valor_total_formatado = parseFloat(valor_total).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        $('#valor_total').val(valor_total_formatado);
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


$(document).on("click", ".finalizar-pedido", function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    let nome = $(this).data('nome');
    $('#confirmar-finalizar input[name="id"]').val(id);
    $('#nome-usuario').text(nome);
    $('#modal').show();
});

$(document).on("submit", "#confirmar-finalizar", function (e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        type: "POST",
        url: finalizar,
        data: form.serialize(),
        success: function () {
            alert("Pedido finalizado com sucesso!");
            $('#modal').hide();
            location.reload();
        },
        error: function () {
            alert("Ocorreu um erro ao finalizar pedido.");
        }
    });
});

// fim modal