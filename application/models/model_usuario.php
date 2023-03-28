<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_usuario extends CI_Model
{
  public function index()
  {
    return $this->db->get("usuarios")->result_array();
  }

  public function cadastrarusuarios($data)
  {
    $this->db->insert('usuarios', $data);
    return true;
    
  }

  public function inativar($id)
  {
      $data = array('status' => '0');
      $this->db->where('id', $id);
      $this->db->update('usuarios', $data);
  }
 
}
?>