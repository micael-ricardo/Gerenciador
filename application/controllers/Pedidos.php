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

    

        $data["pedidos"] = $this->model_pedidos->listar();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('pedidos/index', $data);

    }


    public function dataTable()
    {

        $this->load->model("model_pedidos");
        
    

        if ($this->input->get('Pesquisa')) {
            $pedidos = $this->model_pedidos->consultarpedidos($this->input->get('Pesquisa'));
        } else {
            $pedidos = $this->model_pedidos->listar();
        }

     
        foreach ($pedidos as $value) {

            $result[] = [
                $value['nome_cliente'],
                $value['nome'],
                $value['datacadastro_pedido'],
   
            ];
          
        }
        $pedido = [
            'data' => $result
        ];
        echo json_encode($pedido);

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

            $valor_mask = RemoveSifrao($this->input->post('valor'));
            $valor_total_mask = RemoveSifrao($this->input->post('valor_total'));

            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));
            $valor = str_replace('.', '', $valor_mask);
            $valor_total = str_replace('.', '',  $valor_total_mask);

            $data_pedidos = array(
                'nome' => $this->input->post('nome'),
                'telefone' => $telefone,
                'valor' =>  $valor,
                'valor_total' => $valor_total,
                'data_retirada' => $this->input->post('data_retirada'),
                'forma_pagamento' => $this->input->post('forma_pagamento'),
                'cep' => $cep,
                'estado' => $this->input->post('estado'),
                'cidade' => $this->input->post('cidade'),
                'bairro' => $this->input->post('bairro'),
                'numero' => $this->input->post('numero'),
                'rua' => $this->input->post('rua'),
                'datacadastro' => date('Y-m-d H:i:s'),
                'id_fornecedor' => $this->input->post('fornecedor'),
                'id_produto' => $this->input->post('produto'),
                'quantidade' => $this->input->post('quantidade'),
                'observacao' => $this->input->post('observacao'),
                'status' => '1',
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
        $this->load->model('model_produtos');
        $data['produto'] = $this->model_produtos->produto_ativo();
        $this->load->model('model_colaborador');
        $data['fornecedor'] = $this->model_colaborador->fornecedor_ativo();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/js', $data);
        $this->load->view('pedidos/cadastro', $data);
    }

    public function update($id)
    {
        if ($this->input->post()) {
            $this->load->model("model_pedidos");
            $this->load->helper('RemoveMascara');

            $valor_mask = RemoveSifrao($this->input->post('valor'));
            $valor_total_mask = RemoveSifrao($this->input->post('valor_total'));

            $this->load->helper('RemoveMascara');
            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));
            $valor = str_replace('.', '', $valor_mask);
            $valor_total = str_replace('.', '', $valor_total_mask);

            $pedidos = array(
                'nome' => $this->input->post('nome'),
                'telefone' => $telefone,
                'valor' => $valor,
                'valor_total' => $valor_total,
                'data_retirada' => $this->input->post('data_retirada'),
                'forma_pagamento' => $this->input->post('forma_pagamento'),
                'quantidade' => $this->input->post('quantidade'),
                'cep' => $cep,
                'estado' => $this->input->post('estado'),
                'cidade' => $this->input->post('cidade'),
                'bairro' => $this->input->post('bairro'),
                'numero' => $this->input->post('numero'),
                'rua' => $this->input->post('rua'),
                'id_fornecedor' => $this->input->post('fornecedor'),
                'id_produto' => $this->input->post('produto'),
                'observacao' => $this->input->post('observacao'),
                'id_usuario' => $this->session->logged_user['id']
            );
        }

        $this->model_pedidos->update($id, $pedidos);

        redirect("Pedidos");
    }

    public function finalizar()
    {

        $id = $this->input->post('id');
        $this->load->model('model_pedidos');
        $this->model_pedidos->finalizar($id);
        redirect('Pedidos');
    }

}