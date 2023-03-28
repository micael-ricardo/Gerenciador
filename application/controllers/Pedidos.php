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

        $data["pedidos"] = $this->model_pedidos->listar();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('pedidos/index', $data);

    }
    public function cadastro()
    {
        $this->load->model('model_produtos');
        $data['produto'] = $this->model_produtos->produto_ativo();
        $this->load->model('model_colaborador');
		$data['fornecedor'] = $this->model_colaborador->fornecedor_ativo();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('pedidos/cadastro', $data);
        

    }

    public function store()
    {
        if ($this->input->post()) {
            $this->load->model("model_pedidos");

            $this->load->helper('RemoveMascara');
            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));
            $valor = str_replace('.', '',  $this->input->post('valor'));
            $valor_total = str_replace('.', '',  $this->input->post('valor_total'));

            $data_pedidos = array(
                'nome' => $this->input->post('nome'),
                'telefone' => $telefone,
                'valor' =>  $valor,
                'valor_total' =>  $valor_total,
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
                'id_fornecedor' => $this->input->post('fornecedor'),
                'id_produto' => $this->input->post('produto'),
                'id_usuario' => $this->session->logged_user['id']
            );
        }

        $this->model_pedidos->cadastrarpedidos($data_pedidos);

        redirect("pedidos");
    }


    public function editar($id)
    {
        $this->load->model("model_pedidos");
        $data['pedidos'] = $this->model_pedidos->show($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/js', $data);
        $this->load->view('pedidos/cadastro', $data);
    }

    public function update($id)
    {
        $this->load->model("model_pedidos");
        $pedidos = array(
            'nome' => $this->input->post('nome'),
            'documento' => $this->input->post('documento'),
            'telefone' => $this->input->post('telefone'),
            'cep' => $this->input->post('cep'),
            'rua' => $this->input->post('rua'),
            'bairro' => $this->input->post('bairro'),
            'numero' => $this->input->post('numero'),
            'tipo_colaborador' => $this->input->post('tipo_colaborador'),
        );

        $this->model_pedidos->update($id, $pedidos);

        redirect("Pedidos");
    }

    public function delete($id)
    {
        $this->load->model('model_pedidos');
        $this->model_pedidos->inativar($id);

        redirect('Pedidos');
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