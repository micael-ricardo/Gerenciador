<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colaborador extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        date_default_timezone_set('America/Sao_Paulo');
        permissao();
    }
    public function index()
    {

        $this->load->model("model_colaborador");
        $this->load->helper(array('form'));

        if ($this->input->get('nome')) {
            return $this->dataTable();
        }

        $data["colaborador"] = $this->model_colaborador->index();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/index', $data);
    }

    public function dataTable()
    {
        $this->load->model("model_colaborador");

        try {
  
            // filtro

            if (
                $this->input->get('nome') || $this->input->get('documento') || $this->input->get('telefone') ||
                $this->input->get('cep') || $this->input->get('bairro') || $this->input->get('rua') ||
                $this->input->get('numero') || $this->input->get('tipo_colaborador') || $this->input->get('tipo_pessoa')
                || $this->input->get('status')
            ) {
                $colaborador = $this->model_colaborador->pesquisar(
                    $this->input->get('nome'),
                    $this->input->get('documento'),
                    $this->input->get('telefone'),
                    $this->input->get('cep'),
                    $this->input->get('bairro'),
                    $this->input->get('rua'),
                    $this->input->get('numero'),
                    $this->input->get('status'),
                    $this->input->get('tipo_colaborador'),
                    $this->input->get('tipo_pessoa')
                );
            } else {
                $colaborador = $this->model_colaborador->index();
            }

            // listagem


            $result = [];

            foreach ($colaborador as $value) {
                $result[] = [
                    $value['nome'],
                    formatar_cpf_cnpj($value['documento']),
                    formatar_telefone($value['telefone']),
                    formatar_cep($value['cep']),
                    $value['estado'],
                    $value['cidade'],
                    $value['bairro'],
                    $value['rua'],
                    $value['numero'],
                    $value['tipo_colaborador'],
                    $value['tipo_pessoa'],
                    formatar_data($value['datacadastro']),
                    $value['status'],
                    $value['id']
                ];
            }
            $colaboradors = [
                'data' => $result
            ];

            echo json_encode($colaboradors);

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
        $this->load->view('colaborador/cadastro');
    }

    public function store()
    {
        if ($this->input->post()) {

            $documento = null;
            $nome = null;

            $this->load->helper('RemoveMascara');
            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));

            if ($this->input->post('tipo_pessoa') == 1) {
                $nome = $this->input->post('razao_social');
                $documento = RemoveMascara($this->input->post('cnpj'));
            } else {
                $nome = $this->input->post('nome');
                $documento = RemoveMascara($this->input->post('documento'));
            }

            $data_colaborador = array(
                'documento' => $documento,
                'telefone' => $telefone,
                'nome' => $nome,
                'cep' => $cep,
                'estado' => $this->input->post('estado'),
                'cidade' => $this->input->post('cidade'),
                'rua' => $this->input->post('rua'),
                'tipo_colaborador' => $this->input->post('tipo_colaborador'),
                'tipo_pessoa' => $this->input->post('tipo_pessoa'),
                'bairro' => $this->input->post('bairro'),
                'numero' => $this->input->post('numero'),
                'status' => '1',
                'datacadastro' => date('Y-m-d H:i:s'),
                'id_usuario' => $this->session->logged_user['id']
            );

            $data_usuario = null;
            //Cadastro de Usuario pela tela de colaborador

            if ($this->input->post('login')) {
                $data_usuario = array(
                    'nome' => $nome,
                    'login' => $this->input->post('login'),
                    'email' => $this->input->post('email'),
                    'senha' => $this->input->post('senha'),
                    'status' => '1',
                    'datacadastro' => date('Y-m-d H:i:s')
                );
            }
            $this->load->model("model_colaborador");
            $this->model_colaborador->cadastrarcolaborador($data_colaborador, $data_usuario);

            redirect("Colaborador/index");
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

        $documento = null;
        $nome = null;

        $this->load->helper('RemoveMascara');
        $telefone = RemoveMascara($this->input->post('telefone'));
        $cep = RemoveMascara($this->input->post('cep'));

        if ($this->input->post('tipo_pessoa') == 1) {
            $nome = $this->input->post('razao_social');
            $documento = RemoveMascara($this->input->post('cnpj'));
        } else {
            $nome = $this->input->post('nome');
            $documento = RemoveMascara($this->input->post('documento'));
        }

        $this->load->model("model_colaborador");
        $colaborador = array(
            'nome' => $nome,
            'documento' => $documento,
            'telefone' => $telefone,
            'cep' => $cep,
            'estado' => $this->input->post('estado'),
            'cidade' => $this->input->post('cidade'),
            'bairro' => $this->input->post('bairro'),
            'rua' => $this->input->post('rua'),
            'numero' => $this->input->post('numero'),
            'tipo_colaborador' => $this->input->post('tipo_colaborador'),
            'id_usuario' => $this->session->logged_user['id']
        );

        $this->model_colaborador->update($id, $colaborador);
  
        redirect("Colaborador/index");
    }

    public function delete()
    {
        $id = $this->input->post('id');

        $this->load->model('model_colaborador');
        $this->model_colaborador->inativar($id);

        redirect('Colaborador');
    }

}