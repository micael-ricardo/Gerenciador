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
              'datacadastro' => date('Y-m-d H:i:s')
            );        


        $this->model_usuario->cadastrarusuarios($data);

        redirect("Usuarios");
    }


//     public function editar($id)
// {
//     $this->load->model("model_usuarios");
//     $data['usuario'] = $this->model_usuarios->getUsuarioPorId($id);
//     $this->load->view('templates/header', $data);
//     $this->load->view('templates/js', $data);
//     $this->load->view('usuarios/cadastro', $data);
// }


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

    public function delete()
    {

        $id = $this->input->post('id');
       
        $this->load->model('model_usuario');
        $this->model_usuario->inativar($id);

        redirect('Usuarios');
    }

}

