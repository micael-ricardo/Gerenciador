<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_pedidos extends CI_Model
{
  public function listar()
  {
    $this->db->from('lista_produtos_pedidos');
    $this->db->order_by('datacadastro', 'desc');
    $result = $this->db->get();
    if ($result instanceof CI_DB_result) {
        return $result->result_array();
    } else {
        return array();
    }
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