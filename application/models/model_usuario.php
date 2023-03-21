<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_usuario extends CI_Model
{

  public function store($login, $senha)
  {
    
    $this->db->where('login', $login);
    $this->db->where('senha', $senha);
    $user = $this->db->get('usuarios')->row_array();
    return $user;
  }
}