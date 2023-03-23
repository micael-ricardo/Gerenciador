<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        date_default_timezone_set('America/Sao_Paulo');
        permissao();
    }
    public function index()
    {
        $this->load->model("model_usuario");
        $data["dados"] = $this->model_usuario->index();
        $this->load->helper(array('form'));
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('usuario/index', $data);

    }
}