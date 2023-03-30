<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_colaborador extends CI_Model
{
  public function index()
  {
  
    $this->db->from('colaboradores');
    $this->db->order_by('datacadastro', 'desc');
    $result = $this->db->get();
    if ($result instanceof CI_DB_result) {
        return $result->result_array();
    } else {
        return array();
    }
  }

  public function pesquisar($nome = '') {
    $nome = $this->db->escape_str($nome);
    $this->db->like('nome', $nome);
    // $documento = $this->db->escape_str($documento);
    // $this->db->like('documento', $documento);
    $query = $this->db->get('colaboradores');
    return $query->result_array();
}

//   public function pesquisar($nome = '', $documento = '') {
//     $this->db->select('*');
//     $this->db->from('colaboradores');
//     $this->db->like('nome', $nome, 'both');
//     // $this->db->or_like('documento', $documento, 'both');
//     // $this->db->or_like('telefone', $filtro, 'both');
//     $query = $this->db->get();
   

//     return $query->result_array();
// }
  
  public function cadastrarcolaborador($data_colaborador, $data_usuario = null)
  {
    $this->db->insert('colaboradores', $data_colaborador);
    //Insert de Usuario
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
    $data = array('status' => '0');
    $this->db->where('id', $id);
    $this->db->update('colaboradores', $data);
  }

  public function fornecedor_ativo()
  {
    $this->db->select('id, nome');
    $this->db->where('status', '1');
    $this->db->where('tipo_colaborador', '1');
    $query = $this->db->get('colaboradores');
    return $query->result_array();
  }

}
?>