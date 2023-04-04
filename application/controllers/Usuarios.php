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

        $data["dados"] = $this->model_usuario->index();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('usuario/index', $data);

    }

    public function dataTable()
    {
        $this->load->model("model_usuario");

        try {

            // filtro

            if ($this->input->get('nome') || $this->input->get('login') || $this->input->get('email') || $this->input->get('status')) {
                $usuario = $this->model_usuario->pesquisar(
                    $this->input->get('nome'),
                    $this->input->get('login'),
                    $this->input->get('email'),
                    $this->input->get('status')
                );
            } else {
                $usuario = $this->model_usuario->index();
            }

            // listagem


            $result = [];

            foreach ($usuario as $value) {
                $result[] = [
                    $value['nome'],
                    $value['login'],
                    $value['email'],
                    formatar_data($value['datacadastro']),
                    $value['status'],
                    $value['id'],
                ];
            }
            $usuarios = [
                'data' => $result
            ];

            echo json_encode($usuarios);

        } catch (Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];

            echo json_encode($error);
        }
    }

    public function cadastro()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('usuario/cadastro');
    }

    public function store()
    {
        $this->load->model("model_usuario");

        $nome = $this->input->post('nome');
        $login = $this->input->post('login');
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        $confirmarSenha = $this->input->post('confirma');

        // verifica se as senhas coincidem
        if ($senha != $confirmarSenha) {
            $this->session->set_flashdata('error', 'As senhas não coincidem!');
            redirect('Usuarios/cadastro');
        }

        $data = array(
            'nome' => $nome,
            'login' => $login,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'status' => '1',
            'datacadastro' => date('Y-m-d H:i:s')
        );


        $this->model_usuario->cadastrarusuarios($data);

        redirect("Usuarios");
    }


    public function editar($id)
    {
        $this->load->model("model_usuario");
        $data['usuario'] = $this->model_usuario->show($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/js', $data);
        $this->load->view('usuario/cadastro', $data);
    }

    public function update($id)
    {

        $this->load->model("model_usuario");
        $usuarios = array(
            'nome' => $this->input->post('nome'),
        );

        $this->model_usuario->update($id, $usuarios);

        redirect("Usuarios/index");
    }

    public function delete()
    {

        $id = $this->input->post('id');

        $this->load->model('model_usuario');
        $this->model_usuario->inativar($id);

        redirect('Usuarios');
    }

}