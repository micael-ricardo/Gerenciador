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

        if ($this->input->post()) {

            $data_colaborador = array(

                'documento' => $this->input->post('documento'),
                'telefone' => $this->input->post('telefone'),
                'nome' => $this->input->post('nome'),
                'cep' => $this->input->post('cep'),
                'rua' => $this->input->post('rua'),
                'tipo_colaborador' => $this->input->post('tipo_colaborador'),
                'bairro' => $this->input->post('bairro'),
                'numero' => $this->input->post('numero'),
                'datacadastro' => date('Y-m-d H:i:s')
            );

            $data_usuario = null;

            if ($this->input->post('login')) {

                $data_usuario = array(
                    'nome' => $this->input->post('nome'),
                    'login' => $this->input->post('login'),
                    'email' => $this->input->post('email'),
                    'senha' => $this->input->post('senha'),
                    'datacadastro' => date('Y-m-d H:i:s')
                );
            }
            $this->load->model("model_colaborador");
            $this->model_colaborador->cadastrarcolaborador($data_colaborador, $data_usuario);

            redirect("Colaborador");
        }
    }

    public function editar($id)
    {
        $this->load->model("model_colaborador");
        $data['colaborador'] = $this->model_colaborador->show($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/js', $data);
        $this->load->view('colaborador/cadastro', $data);
    }

    public function update($id)
    {
        $this->load->model("model_colaborador");
        $colaborador = array(
            'nome' => $this->input->post('nome'),
            'documento' => $this->input->post('documento'),
            'telefone' => $this->input->post('telefone'),
            'cep' => $this->input->post('cep'),
            'rua' => $this->input->post('rua'),
            'bairro' => $this->input->post('bairro'),
            'numero' => $this->input->post('numero'),
            'tipo_colaborador' => $this->input->post('tipo_colaborador'),
        );

        $this->model_colaborador->update($id, $colaborador);

        redirect("Colaborador");
    }

    public function delete($id)
{
    $this->load->model('model_colaborador');
    $this->model_colaborador->inativar($id);
    // echo $this->db->last_query();
    // exit();
    redirect('Colaborador');
}

    public function pesquisar()
    {
        $this->load->model("model_consultar");
        $filtro_nome = $this->input->get('Pesquisa');
        $data['colaborador'] = $this->model_consultar->consultar($filtro_nome);
        $this->load->view('colaborador/index', $data);


    }

}