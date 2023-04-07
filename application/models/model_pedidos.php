<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_pedidos extends CI_Model
{
  public function index()
  {
    $this->db->from('filto_produtos_pedidos');
    $this->db->order_by('datacadastro_pedido', 'desc');
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

  public function finalizar($id)
{
    $data = array('status_pedido' => '3');
    $this->db->where('id', $id);
    $this->db->update('pedidos', $data);
}

public function trocarStatus($id)
{
    $data = array('status_pedido' => '2');
    $this->db->where('id', $id);
    $this->db->update('pedidos', $data);
}

public function consultarpedidos($filtro) {

  $this->db->select('*');
  $this->db->from('pedidos');
  $this->db->join('produtos', 'produtos.id = pedidos.id_produto_pedido', 'left');
  $this->db->join('colaboradores', 'colaboradores.id = pedidos.id_fornecedor_pedido', 'left');
  
  // adicione a cláusula WHERE
  $this->db->like('nome_cliente', $filtro, 'both');
  
  $query = $this->db->get();
  return $query->result_array();
}

public function status() {
  $this->db->select('status_pedido, COUNT(*) AS quantidade');
  $this->db->from('pedidos');
  $this->db->group_by('status_pedido');
  $query = $this->db->get();
  return $query->result_array();
}



}
?>