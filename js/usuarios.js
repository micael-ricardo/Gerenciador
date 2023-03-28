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


$(document).on("click", ".excluir-usuario", function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    let nome = $(this).data('nome');
    $('#confirmar-exclusao input[name="id"]').val(id);
    $('#nome-usuario').text(nome);
    $('#modal').show();
});


$(document).on("submit", "#confirmar-exclusao", function(e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        type: "POST",
        url: excluirUrl,
        data: form.serialize(),
        success: function() {
            alert("Usuário excluído com sucesso!");
            $('#modal').hide();
            location.reload();
        },
        error: function() {
            alert("Ocorreu um erro ao excluir o usuário.");
        }
    });
});



