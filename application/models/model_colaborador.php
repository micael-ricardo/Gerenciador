<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_colaborador extends CI_Model
{
    public function index()
    {
     return $this->db->get("colaboradores")->result_array();
    }
}
?>