<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends CI_Controller
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
        $this->load->model("model_pedidos");
        $this->load->helper(array('form'));

        if ($this->input->get('Pesquisa')) {
            return $this->pesquisar();
        }

        $data["pedidos"] = $this->model_pedidos->index();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('pedidos/index', $data);

    }
    public function cadastro()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('pedidos/cadastro');
    }

    public function store()
    {
        if ($this->input->post()) {

            $this->load->model("model_pedidos");

            $this->load->helper('RemoveMascara');
            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));
            $valor = RemoveMascara($this->input->post('valor'));

            $data_pedidos = array(
                'nome' => $this->input->post('nome'),
                'telefone' => $telefone,
                'produto' => $this->input->post('produto'),
                'valor' =>  $valor,
                'data_retirada' => $this->input->post('data_retirada'),
                'forma_pagamento' => $this->input->post('forma_pagamento'),
                'cep' => $cep,
                'estado' => $this->input->post('estado'),
                'cidade' => $this->input->post('cidade'),
                'bairro' => $this->input->post('bairro'),
                'numero' => $this->input->post('numero'),
                'rua' => $this->input->post('rua'),
                'status' => '1',
                'datacadastro' => date('Y-m-d H:i:s'),
                'usuario_id' => $this->session->logged_user['id']
            );
        }

        $this->model_pedidos->cadastrarpedidos($data_pedidos);

        redirect("pedidos");
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

        redirect('Colaborador');
    }

    public function pesquisar($tipo_pessoa = null, $pesquisa = null, $nome = null, $documento = null, $telefone = null, $cep = null, $bairro = null, $rua = null, $numero = null, $status = null, $tipo_colaborador = null)
    {
        $this->load->model("model_consultar");
        $this->load->helper('RemoveMascara');

        if (!$pesquisa) {
            $pesquisa = $this->input->get('Pesquisa');
        }
        if (!$nome) {
            $nome = $this->input->get('nome');
        }
        if (!$documento) {
            $documento = RemoveMascara($this->input->get('documento'));
        }
        if (!$telefone) {
            $telefone = RemoveMascara($this->input->get('telefone'));
        }
        if (!$cep) {
            $cep = RemoveMascara($this->input->get('cep'));
        }
        if (!$bairro) {
            $bairro = $this->input->get('bairro');
        }
        if (!$rua) {
            $rua = $this->input->get('rua');
        }
        if (!$numero) {
            $numero = $this->input->get('numero');
        }
        if (!$status) {
            $status = $this->input->get('status');
        }

        if (!$tipo_colaborador) {
            $tipo_colaborador = $this->input->get('tipo_colaborador');
        }
        if (!$tipo_pessoa) {
            $tipo_pessoa = $this->input->get('tipo_pessoa');
        }

        $data['colaborador'] = $this->model_consultar->consultar($pesquisa, $tipo_pessoa, $nome, $documento, $telefone, $cep, $bairro, $rua, $numero, $status, $tipo_colaborador);
        $formata = json_decode(json_encode($data), true);
        $this->load->helper(array('form'));
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/index', $formata);

    }

}