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
			redirect("Dashboard");
		}else{
			  $this->session->set_flashdata('error', 'Login ou Senha incorreto!');
                redirect('login');
		}




		// $this->load->model("model_login");
		// $login = $_POST['login'];
		// $senha = $_POST['senha'];

		// $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE login = :login");
		// $stmt->execute(['login' => $login]);
		// $user = $stmt->fetch();

		// if ($user && password_verify($senha, $user['senha'])) {
		// 	// Atualiza a tabela de tentativas de login com uma nova entrada indicando que a tentativa foi bem-sucedida
		// 	$stmt = $pdo->prepare("INSERT INTO trava_ip (ip, login, senha, tentativa, data) VALUES (:ip, :login, :senha, :tentativa, :data)");
		// 	$stmt->execute([
		// 		'ip' => $_SERVER['REMOTE_ADDR'],
		// 		'login' => $login,
		// 		'senha' => password_hash($senha, PASSWORD_DEFAULT),
		// 		'tentativa' => 1,
		// 		'data' => date('Y-m-d H:i:s')
		// 	]);

		// 	// Armazena algumas informações de sessão
		// 	session_start();
		// 	$_SESSION['user_id'] = $user['id'];
		// 	redirect('dashboard');
		// } else {
		// 	// Atualiza a tabela de tentativas de login com uma nova entrada indicando que a tentativa falhou
		// 	$stmt = $pdo->prepare("INSERT INTO trava_ip (ip, login, senha, tentativa, data) VALUES (:ip, :login, :senha, :tentativa, :data)");
		// 	$stmt->execute([
		// 		'ip' => $_SERVER['REMOTE_ADDR'],
		// 		'login' => $login,
		// 		'senha' => password_hash($senha, PASSWORD_DEFAULT),
		// 		'tentativa' => 0,
		// 		'data' => date('Y-m-d H:i:s')
		// 	]);
		// 	redirect('login');
		// }

		
	}



	public function sair()
	{
		unset($_SESSION['Usuario_Logado']);
		$this->session->unset_userdata("logged_user");
		redirect("login");

	}
}