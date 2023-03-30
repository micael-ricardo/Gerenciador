
//Data table


$(document).ready(function () {
    var table =   $('#consultar_pedidos').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":
        {
            "url": "dataTable",
            "type": "GET"
        },
        // "columns": [
        //     { "width": "200px" },
        //     { "width": "150px" },
        //     { "width": "150px" },
        //     { "width": "100px" },
        //     { "width": "50px" },
        //     { "width": "100px" },
        //     { "width": "100px" },
        //     { "width": "100px" },
        //     { "width": "100px" },
        //     { "width": "100px" },
        //     { "width": "10px" },
        //     { "width": "100px" },
        //     { "width": "100px" },
        //     { "width": "250px" },
        //     { "width": "10px" },
        //     { "width": "300px" },
        //     { "width": "100px" },
        //     { "width": "50px" },
        //     { "width": "10px" }
        // ],
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
        // "columnDefs": [
        //     {
        //         "targets": -1,
        //         "render": function (data, type, row) {
        //             var nome = row[0]; 
        //             var status = row[17];
        //             var btnEditar = '<a href="http://localhost/Gerenciador/Pedidos/editar/' + data + '" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>';
        //             var btnFinalizar = '<a id="abrir-modal" href="#"  data-id=' + data + ' data-nome=' + nome + ' " class="btn btn-success btn-xs finalizar-pedido"><i class="fa fa-check"></i></a>';
        //             if (status === '0') {

        //                 btnEditar = ' <button class="btn btn-info btn-xs" disabled><i class="fa fa-pencil"></i></button>';
        //                 btnFinalizar = ' <button class="btn btn-success btn-xs" disabled><i class="fa fa-check"></i></button>';
        //             }
        //             return btnEditar + ' ' + btnFinalizar;
        //         }
        //     },
        //     {
        //         "targets": -2,
        //         "render": function (data, type, row) {

        //             console.log(data);

        //             if (data == 0) {
        //                 return '<span class="btn btn-success btn-xs">Finalizado</span>';
        //             } else {
        //                 return '<span class="btn btn-primary btn-xs">Ativo</span>';
        //             }
        //         }
        //     },
        //     {
        //         "targets": 6,
        //         "render": function (data, type, row) {

        //             if (data == 'dinheiro') {
        //                 return '<span class="btn btn-success btn-xs">Dinheiro</span>';
        //             } else {
        //                 return '<span class="btn btn-primary btn-xs">Cartão</span>';
        //             }
        //         }
        //     },
        // ],
        "scrollY": "300px",
        "scrollX": true
    });

    //   Atualizar o DataTable ao enviar o formulário
  $('#filtro-rapido').on('submit', function(event) {
    event.preventDefault();
    table.ajax.url('dataTable?' + $(this).serialize()).load();
  });
});

// $(document).ready(function () {
//     var table = $('#consultar_pedidos').DataTable();


//     // Ao clicar no botão de pesquisa, atualize o DataTable com os novos resultados
//     $('#botao-pesquisar').click(function (event) {

//         event.preventDefault();
//         table.ajax.reload();
//     });

//     // Configurar o DataTable para buscar dados usando AJAX
//     table.ajax.url("dataTable").load();
// });


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