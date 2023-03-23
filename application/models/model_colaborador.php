<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_colaborador extends CI_Model
{
  public function index()
  {
    return $this->db->get("colaboradores")->result_array();
  }
  public function cadastrarcolaborador($data_colaborador, $data_usuario = null)
  {
    $this->db->insert('colaboradores', $data_colaborador);

    if ($data_usuario) {
      $this->db->insert('usuarios', $data_usuario);
      $id_usuario = $this->db->insert_id();
      $this->db->set('id_usuario', $id_usuario);
      $this->db->where('documento', $data_colaborador["documento"]);
      $this->db->update('colaboradores');
    }

    return true;
  }
  public function show($id)
  {
    return $this->db->get_where('colaboradores', array("id" => $id))->row_array();
  }
  public function update($id, $colaborador)
  {
    $this->db->where('id', $id);
    return $this->db->update("colaboradores", $colaborador);
  }

  public function inativar($id)
{
    $data = array('ativo' => false);
    $this->db->where('id', $id);
    $this->db->update('colaboradores', $data);
}

}
?>