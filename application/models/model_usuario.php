<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_usuario extends CI_Model
{

  public function store($data)
  {
    $this->db->insert('usuarios', $data);
    return true;
  }
  public function cadastrarcolaborador($data)
  {
    $this->db->insert('colaboradores', $data);
    return true;
  }

}