<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_consultar extends CI_Model
{
    public function consultar($pesquisa, $tipo_pessoa, $nome, $documento, $telefone, $cep, $bairro, $rua, $numero, $status, $tipo_colaborador)
    {
        $filtrorapido = $this->db->escape_str($pesquisa);
        $this->db->like('nome', $filtrorapido);
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
        $status = $this->db->escape_str($status);
        $this->db->like('status', $status);
        $tipo_pessoa = $this->db->escape_str($tipo_pessoa);
        $this->db->like('tipo_pessoa', $tipo_pessoa);
        $query = $this->db->get('colaboradores');
        return $query->result();
    }

    public function consultarUsuario($pesquisa, $nome, $login,$email,$status )
    {

        $filtrorapido = $this->db->escape_str($pesquisa);
        $this->db->like('nome', $filtrorapido);
        $nome = $this->db->escape_str($nome);
        $this->db->like('nome', $nome);
        $login = $this->db->escape_str($login);
        $this->db->like('login', $login);
        $email = $this->db->escape_str($email);
        $this->db->like('email', $email);
        $status = $this->db->escape_str($status);
        $this->db->like('status', $status);
        $query = $this->db->get('usuarios');
        return $query->result();
    }

}