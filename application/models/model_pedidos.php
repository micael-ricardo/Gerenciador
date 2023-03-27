<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_pedidos extends CI_Model
{
  public function index()
  {
    return $this->db->get("pedidos")->result_array();
  }
  public function cadastrarpedidos($data_pedidos)
  {
    $this->db->insert('pedidos', $data_pedidos);
    return true;
    
  }
  public function show($id)
  {
    return $this->db->get_where('pedidos', array("id" => $id))->row_array();
  }
  public function update($id, $colaborador)
  {
    $this->db->where('id', $id);
    return $this->db->update("pedidos", $colaborador);
  }

  public function inativar($id)
{
    $data = array('status' => '0');
    $this->db->where('id', $id);
    $this->db->update('pedidos', $data);
}

}
?>