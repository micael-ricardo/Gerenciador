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
        $data["pedidos"] = $this->model_pedidos->index();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('pedidos/index', $data);

    }
    public function dataTable()
    {
        $this->load->model("model_pedidos");

        try {

            // filtro
            if ($this->input->get('nome') || $this->input->get('login') || $this->input->get('email') || $this->input->get('status')) {
                $pedido = $this->model_pedidos->pesquisar(
                    $this->input->get('nome'),
                    $this->input->get('login'),
                    $this->input->get('email'),
                    $this->input->get('status')
                );
            } else {
                $pedido = $this->model_pedidos->index();
            }

            // listagem
            $result = [];

            foreach ($pedido as $value) {
                $result[] = [
                    $value['nome_cliente'],
                    formatar_telefone($value['telefone_pedido']),
                    $value['produto_nome'],
                    reais($value['produto_preco']),
                    $value['quantidade'],
                    reais($value['valor_total']),
                    $value['forma_pagamento'],
                    $value['nome'],
                    formatar_data($value['datacadastro_pedido']),
                    formatar_cep($value['pedido_cep']),
                    $value['estado_pedido'],
                    $value['cidade_pedido'],
                    $value['bairro_pedido'],
                    $value['rua_pedido'],
                    $value['numero_pedido'],
                    $value['observacao'],
                    formatar_data($value['data_retirada']),
                    $value['status_pedido'],
                    $value['pedido_id'],
                ];
            }
            $pedidos = [
                'data' => $result
            ];

            echo json_encode($pedidos);

        } catch (Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];

            echo json_encode($error);
        }
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

        $this->form_validation->set_rules('nome', 'nome_cliente', 'required');
        $this->form_validation->set_rules('telefone', 'telefone_pedido', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');
        $this->form_validation->set_rules('valor_total', 'Valor_Total', 'required');
        $this->form_validation->set_rules('data_retirada', 'data_retirada', 'required');
        $this->form_validation->set_rules('forma_pagamento', 'forma_pagamento', 'required');
        $this->form_validation->set_rules('cep', 'cep_pedido', 'required');
        $this->form_validation->set_rules('estado', 'estado_pedido', 'required');
        $this->form_validation->set_rules('cidade', 'cidade_pedido', 'required');
        $this->form_validation->set_rules('bairro', 'bairro_pedido', 'required');
        $this->form_validation->set_rules('numero', 'numero_pedido', 'required');
        $this->form_validation->set_rules('rua', 'rua_pedido', 'required');
        $this->form_validation->set_rules('fornecedor', 'id_fornecedor_pedido', 'required');
        $this->form_validation->set_rules('produto', 'id_produto_pedido', 'required');
        $this->form_validation->set_rules('quantidade', 'quantidade', 'required');

        $this->load->model("model_pedidos");
        $this->load->helper('RemoveMascara');

        if ($this->input->post() && $this->form_validation->run()) {

            $valor_mask = RemoveSifrao($this->input->post('valor'));
            $valor_total_mask = RemoveSifrao($this->input->post('valor_total'));

            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));
            $valor = str_replace('.', '', $valor_mask);
            $valor_total = str_replace('.', '', $valor_total_mask);

            $data_pedidos = array(
                'nome_cliente' => $this->input->post('nome'),
                'telefone_pedido' => $telefone,
                'valor' => $valor,
                'valor_total' => $valor_total,
                'data_retirada' => $this->input->post('data_retirada'),
                'forma_pagamento' => $this->input->post('forma_pagamento'),
                'cep_pedido' => $cep,
                'estado_pedido' => $this->input->post('estado'),
                'cidade_pedido' => $this->input->post('cidade'),
                'bairro_pedido' => $this->input->post('bairro'),
                'numero_pedido' => $this->input->post('numero'),
                'rua_pedido' => $this->input->post('rua'),
                'datacadastro_pedido' => date('Y-m-d H:i:s'),
                'id_fornecedor_pedido' => $this->input->post('fornecedor'),
                'id_produto_pedido' => $this->input->post('produto'),
                'quantidade' => $this->input->post('quantidade'),
                'observacao' => $this->input->post('observacao'),
                'status_pedido' => '1',
                'id_usuario_pedido' => $this->session->logged_user->id
            );

            $this->model_pedidos->cadastrarpedidos($data_pedidos);

            $this->session->set_flashdata('success', 'Pedido cadastrado com sucesso!');
            redirect('pedidos/index');

        } else {
            $this->session->set_flashdata('error', 'Não foi possível cadastrar o pedido!');
            redirect('Pedidos/cadastro');

        }
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

                'nome_cliente' => $this->input->post('nome'),
                'telefone_pedido' => $telefone,
                'valor' => $valor,
                'valor_total' => $valor_total,
                'data_retirada' => $this->input->post('data_retirada'),
                'forma_pagamento' => $this->input->post('forma_pagamento'),
                'cep_pedido' => $cep,
                'estado_pedido' => $this->input->post('estado'),
                'cidade_pedido' => $this->input->post('cidade'),
                'bairro_pedido' => $this->input->post('bairro'),
                'numero_pedido' => $this->input->post('numero'),
                'rua_pedido' => $this->input->post('rua'),
                'id_fornecedor_pedido' => $this->input->post('fornecedor'),
                'id_produto_pedido' => $this->input->post('produto'),
                'quantidade' => $this->input->post('quantidade'),
                'observacao' => $this->input->post('observacao'),
                'id_usuario_pedido' => $this->session->logged_user->id
            );
        }

        $resultado = $this->model_pedidos->update($id, $pedidos);

        if ($resultado) {
            $this->session->set_flashdata('update', 'ok');
            redirect('pedidos/index');
        } else {
            $this->session->set_flashdata('update', 'false');
            redirect('pedidos/editar/' . $id);
        }
    }

    public function finalizar()
    {

        $id = $this->input->post('id');
        $this->load->model('model_pedidos');
        $this->model_pedidos->finalizar($id);
        redirect('Pedidos/index');
    }


    public function alterarStatus()
    {
        $id = $this->input->post('id');
        $this->load->model('model_pedidos');
        $this->model_pedidos->trocarStatus($id);
        redirect('Pedidos/index');
    }

}