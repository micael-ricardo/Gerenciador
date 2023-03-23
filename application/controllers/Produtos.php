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
		$this->load->model("model_produtos");
		$produto = array(
			"nome" => $_POST["nome"],
			"preco" => $_POST["preco"],
			"quantidade" => $_POST["quantidade"],
			"data" => $_POST["data"],
			"categoria" => $_POST["categoria"],
			"descricao" => $_POST["descricao"],
			"ativo" => $_POST["ativo"],
		);
		$dados = $this->model_produtos->store($produto);

		if ($dados == true) {
			redirect('produtos/index');

		} else {
			echo "Deu ruim de novo";
		}

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
		$this->model_produtos->deletar_produto($id);

	}
}