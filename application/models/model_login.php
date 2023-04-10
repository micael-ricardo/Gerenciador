<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_login extends CI_Model
{

    public function store($login, $senha)
    {
        $query = $this->db->get_where('usuarios', array('login' => $login));
        $user = $query->row();
    
        if ($user && password_verify($senha, $user->senha)) {
            return $user;
        } else {
            return false;
        }

    }

}