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

  public function pesquisar(
    $nome = '',
    $documento = '',
    $telefone = '',
    $cep = '',
    $bairro = '',
    $rua = '',
    $numero = '',
    $status = '',
    $tipo_colaborador = '',
    $tipo_pessoa = ''
    ) {
    $nome = $this->db->escape_str($nome);
    $this->db->like('nome', $nome);
    $documento = $this->db->escape_str($documento);
    $this->db->like('documento', $documento);
    $telefone = $this->db->escape_str($telefone);
    $this->db->like('telefone', $telefone);
    $cep = $this->db->escape_str($cep);
    $this->db->like('cep', $cep);
    $bairro = $this->db->escape_str($bairro);
    $this->db->like('bairro', $bairro);
    $rua = $this->db->escape_str($rua);
    $this->db->like('rua', $rua);
    $numero = $this->db->escape_str($numero);
    $this->db->like('numero', $numero); 
    $status = $this->db->escape_str($status);
    $this->db->like('status', $status);
    $tipo_colaborador = $this->db->escape_str($tipo_colaborador);
    $this->db->like('tipo_colaborador', $tipo_colaborador);
    $tipo_pessoa = $this->db->escape_str($tipo_pessoa);
    $this->db->like('tipo_pessoa', $tipo_pessoa);

    $query = $this->db->get('colaboradores');
    return $query->result_array();
  }


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
    $data = array('status' => '2');
    $this->db->where('id', $id);
    $this->db->update('colaboradores', $data);
  }

  public function fornecedor_ativo()
  {
    $this->db->select('id, nome');
    $this->db->where('status', '1');
    $this->db->where('tipo_colaborador', 'Fornecedor');
    $query = $this->db->get('colaboradores');
    return $query->result_array();
  }

}
?>