<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_produtos extends CI_Model
{

  public function listar()
  {
    return $this->db->get('produtos')->result_array();
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

}