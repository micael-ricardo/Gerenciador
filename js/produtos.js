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
    $('#preco').mask('#.##0,00', {reverse: true});
});
