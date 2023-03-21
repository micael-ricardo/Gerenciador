<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		date_default_timezone_set('America/Sao_Paulo');

	}
	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('view_login');
	}

	public function store()
	{
		$this->load->model("model_usuario");
		$login = $_POST["login"];
		$senha = $_POST["senha"];
		$user = $this->model_usuario->store($login, $senha);

		if ($user) {
			$this->session->set_userdata("logged_user", $user);
			redirect("dashboard");
		}else{
			redirect("login");
		}

	}
}