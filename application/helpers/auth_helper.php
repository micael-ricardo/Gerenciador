<?php

function permissao()
{
    $ci = get_instance();
    $usuariologado = $ci->session->userdata("logged_user");
    if (!$usuariologado) {
        $ci->session->set_flashdata("danger", "Favor faça o login!");
        redirect("login");
    }
    return $usuariologado;
}