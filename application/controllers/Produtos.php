<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller
{
	public function index()
	{
		$this->load->model("model_produtos");
		$listar = $this->model_produtos->listar();
		$dados = array("produtos" => $listar);
		$this->load->view('templates/header', $dados);
		$this->load->view('templates/js', $dados);
		$this->load->view('produtos/index', $dados);
	}

	public function delete($id)
	{
		$this->load->model("model_produtos");
		$this->model_produtos->deletar_produto($id);

	}
}