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
        $this->form_validation->set_rules('nome', 'nome', 'required');
        $this->form_validation->set_rules('login', 'login', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('senha', 'senha', 'required');

        $this->load->model("model_usuario");

        if ($this->input->post() && $this->form_validation->run()) {
            $nome = $this->input->post('nome');
            $login = $this->input->post('login');
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            $confirmarSenha = $this->input->post('confirma');

            // verifica se as senhas coincidem

            if ($senha != $confirmarSenha) {
                $this->session->set_flashdata('error', 'As senhas não coincidem!');
                // Armazena o valor da sessão anterior 
                $this->session->set_flashdata('email', $this->input->post('email'));
                $this->session->set_flashdata('login', $this->input->post('login'));
                $this->session->set_flashdata('nome', $this->input->post('nome'));
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

            if ($this->model_usuario->cadastrarusuarios($data)) {
                $this->session->set_flashdata('success', 'Usuario cadastrado com sucesso!');
                redirect('Usuarios/index');
            } else {
                $this->session->set_flashdata('error', 'Login ou email já existe!');
                // Armazena o valor da sessão anterior 
                $this->session->set_flashdata('email', $this->input->post('email'));
                $this->session->set_flashdata('login', $this->input->post('login'));
                $this->session->set_flashdata('nome', $this->input->post('nome'));
                redirect('Usuarios/cadastro');
            }
        } else {
            $this->session->set_flashdata('error', 'Não foi possível cadastrar o usuario!');
            // Armazena o valor da sessão anterior 
            $this->session->set_flashdata('email', $this->input->post('email'));
            $this->session->set_flashdata('login', $this->input->post('login'));
            $this->session->set_flashdata('nome', $this->input->post('nome'));
            redirect('Usuarios/cadastro');
        }
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
        if ($this->input->post()) {

            $this->load->model("model_usuario");

            $nome = $this->input->post('nome');
            $login = $this->input->post('login');
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            $confirmarSenha = $this->input->post('confirma');

            // verifica se as senhas coincidem
            if ($this->input->post('alterarSenha') == 1 && $senha != $confirmarSenha) {
                $this->session->set_flashdata('error', 'As senhas não coincidem!');
                redirect('Usuarios/editar/' . $id);
            }
            //   verifica se tem algum email cadastrado com o mesmo do update
            $usuario_existente = $this->model_usuario->get_usuario_por_email($email);
            if ($usuario_existente && $usuario_existente->id != $id) {
                $this->session->set_flashdata('error', 'O email já está sendo utilizado por outro usuário!');
                redirect('Usuarios/editar/' . $id);
            }
            //   verifica se tem algum usuario cadastrado com o mesmo do update
            $usuario_existente_login = $this->model_usuario->get_usuario_por_login($login);
            if ($usuario_existente_login && $usuario_existente_login->id != $id) {
                $this->session->set_flashdata('error', 'O login já está sendo utilizado por outro usuário!');
                redirect('Usuarios/editar/' . $id);
            }
            $usuarios = array(
                'nome' => $nome,
                'login' => $login,
                'email' => $email,
            );
            if ($this->input->post('alterarSenha') == 1) {
                $usuarios['senha'] = password_hash($senha, PASSWORD_DEFAULT);
            }
        }

        $resultado = $this->model_usuario->update($id, $usuarios);

        if ($resultado) {
            $this->session->set_flashdata('update', 'ok');
            redirect('Usuarios/index');
        } else {
            $this->session->set_flashdata('update', 'false');
            redirect('Usuarios/editar/' . $id);
        }

    }

    public function delete()
    {

        $id = $this->input->post('id');

        $this->load->model('model_usuario');
        $this->model_usuario->inativar($id);

        redirect('Usuarios');
    }

}