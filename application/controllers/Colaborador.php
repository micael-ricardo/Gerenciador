<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colaborador extends CI_Controller
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
        $this->load->model("model_colaborador");
        $data["dados"] = $this->model_colaborador->index();
        $this->load->helper(array('form'));
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/index', $data);

    }
    public function cadastro()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/cadastro');
    }

    public function store()
    {
        $this->load->model("model_usuario");



        if ($_POST["cadastrarusuario"] == 1) {

            $user = array(
                "login" => $_POST["login"],
                "senha" => $_POST["senha"],
                "nome" => $_POST["nome"],
                "email" => $_POST["email"],
                "datacadastro" => $_POST["datacadastro"]
            );

            $this->model_usuario->store($user);
        }

        $colaborador = array(
            "documento" => $_POST["documento"],
            "telefone" => $_POST["telefone"],
            "nome" => $_POST["nome"],
            "cep" => $_POST["cep"],
            "rua" => $_POST["rua"],
            "bairro" => $_POST["bairro"],
            "numero" => $_POST["numero"],
            "datacadastro" => $_POST["datacadastro"]
        );

        $dados = $this->model_usuario->cadastrarcolaborador($colaborador);
        if ($dados == true) {
            redirect("Colaborador");

        } else {
            echo "Deu ruim de novo";
        }


    }

}