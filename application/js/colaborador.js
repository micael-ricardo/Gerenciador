$(document).ready(function () {
    var $checkbox = $('#cadastrarusuario');
    $checkbox.click(function () {
        if ($checkbox.is(':checked')) {
            $('#login, #email, #senha').attr('required', true);
        } else {
            $('#login, #email, #senha').removeAttr('required');
        }
    });
});
