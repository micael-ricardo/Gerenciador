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
        $this->load->helper(array('form'));
     
        if ($this->input->get('Pesquisa')) {
            return $this->pesquisar();
        }
        $data["dados"] = $this->model_usuario->index();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('usuario/index', $data);

    }

    public function pesquisar($pesquisa = null,$nome = null, $login = null, $email = null, $status = null)
    {
        $this->load->model("model_consultar");

        if (!$pesquisa) {
            $pesquisa = $this->input->get('Pesquisa');
        }
        if (!$nome) {
            $nome = $this->input->get('nome');
        }
        if (!$login) {
            $login = $this->input->get('login');
        }
        if (!$email) {
            $email = $this->input->get('email');
        }
        if (!$status) {
            $status = $this->input->get('status');
        }
      
        $data['dados'] = $this->model_consultar->consultarUsuario($pesquisa, $nome, $login,$email,$status);
        $formata = json_decode(json_encode($data), true);
        $this->load->helper(array('form'));
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('usuario/index', $formata);

    }

    public function delete($id)
    {
        $this->load->model('model_usuario');
        $this->model_usuario->inativar($id);

        redirect('Usuarios');
    }

}

