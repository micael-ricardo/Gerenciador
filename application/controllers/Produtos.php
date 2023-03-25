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
		$listar = $this->model_produtos->listar();
		$dados = array("produtos" => $listar);
		$this->load->view('templates/header', $dados);
		$this->load->view('templates/js', $dados);
		$this->load->view('produtos/index', $dados);
	}

	public function cadastro()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/js');
		$this->load->view('produtos/cadastro');
	}


	public function store()
	{

		if ($this->input->post()) {
			$data_produto = array(
				'nome' => $this->input->post('nome'),
				'preco' => $this->input->post('preco'),
				'quantidade' => $this->input->post('quantidade'),
				'descricao' => $this->input->post('descricao'),
				'status' => '1',
				'datacadastro' => date('Y-m-d H:i:s'),
				'usuario_id' => $this->session->logged_user['id']
			);
		}

		$this->load->model("model_produtos");
		$this->model_produtos->store($data_produto);

		redirect("Produtos");


	}

	public function editar($id)
	{
		$this->load->model("model_produtos");
		$data['produto'] = $this->model_produtos->show($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/js', $data);
		$this->load->view('produtos/cadastro', $data);

	} 

	public function update($id)
	{
		$this->load->model("model_produtos");
		$produto = $_POST;
		$this->model_produtos->update($id, $produto);
		redirect("produtos");

	}

	public function delete($id)
	{
		$this->load->model("model_produtos");
		$this->model_produtos->inativar($id);

	}
}