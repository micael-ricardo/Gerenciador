<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('login/index');
	}

	public function store()
	{

		$this->load->model("model_login");
		$login = $_POST["login"];
		$senha = $_POST["senha"];
		$user = $this->model_login->store($login,$senha);

		if($user) {
			$this->session->set_userdata("logged_user", $user);
			redirect("Dashboard/index");
		}else{
			  $this->session->set_flashdata('error', 'Login ou Senha incorreto!');
                redirect('login');
		}		
	}

	public function sair()
	{
		unset($_SESSION['Usuario_Logado']);
		$this->session->unset_userdata("logged_user");
		redirect("login");

	}
}