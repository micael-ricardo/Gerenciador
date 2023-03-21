<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_produtos extends CI_Model
{

  public function listar()
  {
    return $this->db->get("produtos")->result_array();
  }

  public function deletar_produto($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('produtos');
    redirect('/');
  }
  
}