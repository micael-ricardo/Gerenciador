<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_consultar extends CI_Model
{
    public function consultar($nome)
    {
        if (empty($nome)) {
            return array();
        }
        $nome = $this->db->escape_str($nome);
        $this->db->like('nome', $nome);
        $query = $this->db->get('colaboradores');
        return $query->result();
    }
}