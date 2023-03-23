<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_usuario extends CI_Model
{
  public function index()
  {
    return $this->db->get("usuarios")->result_array();
  }
 
}
?>