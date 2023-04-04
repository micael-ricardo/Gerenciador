<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_usuario extends CI_Model
{

  public function index()
  {

    $this->db->from('usuarios');
    $this->db->order_by('datacadastro', 'desc');
    $result = $this->db->get();
    if ($result instanceof CI_DB_result) {
      return $result->result_array();
    } else {
      return array();
    }
  }

  public function pesquisar(
    $nome = '',
    $login = '',
    $email = '',
    $status = ''
  ) {
    $nome = $this->db->escape_str($nome);
    $this->db->like('nome', $nome);
    $login = $this->db->escape_str($login);
    $this->db->like('login', $login);
    $email = $this->db->escape_str($email);
    $this->db->like('email', $email);
    $status = $this->db->escape_str($status);
    $this->db->like('status', $status);

    $query = $this->db->get('usuarios');
    return $query->result_array();
  }



  public function cadastrarusuarios($data)
  {
    $this->db->insert('usuarios', $data);
    return true;

  }

  public function show($id)
  {
    return $this->db->get_where('usuarios', array("id" => $id))->row_array();
  }

  public function update($id, $usuarios)
  {
    $this->db->where('id', $id);
    return $this->db->update("usuarios", $usuarios);
  }

  public function inativar($id)
  {
    $data = array('status' => '2');
    $this->db->where('id', $id);
    $this->db->update('usuarios', $data);
  }

}
?>