<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_produtos extends CI_Model
{

  public function listar()
  {
    $this->db->from('lista_produtos_colaboradores');
    $this->db->order_by('datacadastro', 'desc');
    $result = $this->db->get();
    if ($result instanceof CI_DB_result) {
        return $result->result_array();
    } else {
        return array();
    }

  }

  public function store($produto)
  {
    $this->db->insert('produtos', $produto);
    return true;
  }


  public function show($id)
	{
		return $this->db->get_where('produtos', array(
      "id"=>$id

    ))->row_array();
	}

  public function update($id, $produto)
	{
		 $this->db->where('id', $id);
     return $this->db->update("produtos", $produto);
	}

  public function inativar($id)
{
    $data = array('status' => '0');
    $this->db->where('id', $id);
    $this->db->update('produtos', $data);
}

public function produto_ativo() {
  $this->db->select('id, nome, preco, quantidade, id_fornecedor');
  $this->db->where('status', '1');
  $query = $this->db->get('produtos');
  return $query->result_array();
}

}