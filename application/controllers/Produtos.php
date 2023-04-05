<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		date_default_timezone_set('America/Sao_Paulo');
		permissao();
	}
	public function index()
	{
		$this->load->model("model_produtos");
		$listar = $this->model_produtos->index();
		$dados = array("produtos" => $listar);
		$this->load->view('templates/header', $dados);
		$this->load->view('templates/js', $dados);
		$this->load->view('produtos/index', $dados);
	}


	public function dataTable()
	{
		$this->load->model("model_produtos");

		try {

			// filtro
			if ($this->input->get('nome') || $this->input->get('login') || $this->input->get('email') || $this->input->get('status')) {
				$produto = $this->model_produtos->pesquisar(
					$this->input->get('nome'),
					$this->input->get('login'),
					$this->input->get('email'),
					$this->input->get('status')
				);
			} else {
				$produto = $this->model_produtos->index();
			}
			// listagem
			$result = [];

			foreach ($produto as $value) {

				$result[] = [
					$value['nome_produto'],
					reais($value['preco']),
					$value['quantidade_produto'],
					$value['descricao'],
					$value['nome'],
					formatar_telefone($value['telefone']),
					formatar_data($value['datacadastro_produto']),
					$value['status_produto'],
					$value['id']
				];
			}

			$produtos = [
				'data' => $result
			];

			echo json_encode($produtos);

		} catch (Exception $e) {
			$error = [
				'error' => $e->getMessage()
			];

			echo json_encode($error);
		}
	}

	public function cadastro()
	{
		$this->load->model('model_colaborador');
		$data['fornecedor'] = $this->model_colaborador->fornecedor_ativo();
		$this->load->view('templates/header');
		$this->load->view('templates/js');
		$this->load->view('produtos/cadastro', $data);
	}


	public function store()
	{
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required|numeric');
		$this->form_validation->set_rules('quantidade', 'Quantidade', 'required|numeric');
		$this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required|numeric');

		if ($this->form_validation->run()) {

			$preco = str_replace('.', '', $this->input->post('preco'));

			if ($this->input->post()) {
				$data_produto = array(
					'nome_produto' => $this->input->post('nome'),
					'preco' => $preco,
					'quantidade_produto' => $this->input->post('quantidade'),
					'descricao' => $this->input->post('descricao'),
					'status_produto' => '1',
					'datacadastro_produto' => date('Y-m-d H:i:s'),
					'id_fornecedor_produto' => $this->input->post('fornecedor'),
					'id_usuario' => $this->session->logged_user['id']
				);
			}

			$this->load->model("model_produtos");

			$this->model_produtos->store($data_produto);
			$this->session->set_flashdata('success', 'Produto cadastrado com sucesso!');
			redirect('produtos/index');

		} else {
			$this->session->set_flashdata('error', 'Não foi possível cadastrar o produto!');
			redirect('produtos/cadastro');
		}

	}

	public function editar($id)
	{

		$this->load->model("model_produtos");
		$data['produto'] = $this->model_produtos->show($id);

		$this->load->model('model_colaborador');
		$data['fornecedor'] = $this->model_colaborador->fornecedor_ativo();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/js', $data);
		$this->load->view('produtos/cadastro', $data);

	}

	public function update($id)
	{
		$preco = str_replace('.', '', $this->input->post('preco'));

		$this->load->model("model_produtos");
		$produto = array(
			'nome_produto' => $this->input->post('nome'),
			'preco' => $preco,
			'quantidade_produto' => $this->input->post('quantidade'),
			'descricao' => $this->input->post('descricao'),
			'id_fornecedor_produto' => $this->input->post('fornecedor'),
			'id_usuario' => $this->session->logged_user['id']
		);
		$resultado = $this->model_produtos->update($id, $produto);

		if ($resultado) {
			$this->session->set_flashdata('update', 'ok');
			redirect('produtos/index');
		} else {
			$this->session->set_flashdata('update', 'false');
			redirect('produtos/editar/'. $id);
		}

	}

	public function delete()
	{
		$id = $this->input->post('id');

		$this->load->model("model_produtos");
		$this->model_produtos->inativar($id);
		redirect('produtos/index');
	}

	public function pesquisar($pesquisa = null, $nome = null, $preco = null)
	{
		$this->load->model("model_consultar");

		if (!$pesquisa) {
			$pesquisa = $this->input->get('Pesquisa');
		}
		if (!$nome) {
			$nome = $this->input->get('nome');
		}
		if (!$preco) {
			$preco = $this->input->get('preco');
		}


		$data['produtos'] = $this->model_consultar->consultarProdutos($pesquisa, $nome, $preco);
		$formata = json_decode(json_encode($data), true);
		$this->load->helper(array('form'));
		$this->load->view('templates/header');
		$this->load->view('templates/js');
		$this->load->view('produtos/index', $formata);

	}

}