<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Colaborador extends CI_Controller
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
        $this->load->model("model_colaborador");
        $this->load->helper(array('form'));

        if ($this->input->get('Pesquisa')) {
            return $this->pesquisar();
        }

        $data["colaborador"] = $this->model_colaborador->index();
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/index', $data);

    }
    public function cadastro()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/cadastro');
    }

    public function store()
    {
        if ($this->input->post()) {

            $documento = null;
            $nome = null;

            $this->load->helper('RemoveMascara');
            $telefone = RemoveMascara($this->input->post('telefone'));
            $cep = RemoveMascara($this->input->post('cep'));

            if ($this->input->post('tipo_pessoa') == 1) {
                $nome =  $this->input->post('razao_social');
                $documento =  RemoveMascara($this->input->post('cnpj'));
            }else{
                $nome =  $this->input->post('nome');
                $documento =  RemoveMascara($this->input->post('documento'));
            }

            $data_colaborador = array(
                'documento' => $documento,
                'telefone' => $telefone,
                'nome' =>  $nome,
                'cep' => $cep,
                'estado' => $this->input->post('estado'),
                'cidade' => $this->input->post('cidade'),
                'rua' => $this->input->post('rua'),
                'tipo_colaborador' => $this->input->post('tipo_colaborador'),
                'tipo_pessoa' => $this->input->post('tipo_pessoa'),
                'bairro' => $this->input->post('bairro'),
                'numero' => $this->input->post('numero'),
                'status' => '1',
                'datacadastro' => date('Y-m-d H:i:s')
            );

            $data_usuario = null;
            //Cadastro de Usuario pela tela de colaborador
            
            if ($this->input->post('login')) {
                $data_usuario = array(
                    'nome' =>  $nome,
                    'login' => $this->input->post('login'),
                    'email' => $this->input->post('email'),
                    'senha' => $this->input->post('senha'),
                    'status' => '1',
                    'datacadastro' => date('Y-m-d H:i:s')
                );
            }
            $this->load->model("model_colaborador");
            $this->model_colaborador->cadastrarcolaborador($data_colaborador, $data_usuario);

            redirect("Colaborador");
        }
    }

    public function editar($id)
    {
        $this->load->model("model_colaborador");
        $data['colaborador'] = $this->model_colaborador->show($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/js', $data);
        $this->load->view('colaborador/cadastro', $data);
    }

    public function update($id)
    {
        $this->load->model("model_colaborador");
        $colaborador = array(
            'nome' => $this->input->post('nome'),
            'documento' => $this->input->post('documento'),
            'telefone' => $this->input->post('telefone'),
            'cep' => $this->input->post('cep'),
            'rua' => $this->input->post('rua'),
            'bairro' => $this->input->post('bairro'),
            'numero' => $this->input->post('numero'),
            'tipo_colaborador' => $this->input->post('tipo_colaborador'),
        );

        $this->model_colaborador->update($id, $colaborador);

        redirect("Colaborador");
    }

    public function delete($id)
    {
        $this->load->model('model_colaborador');
        $this->model_colaborador->inativar($id);

        redirect('Colaborador');
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

        $data['colaborador'] = $this->model_consultar->consultar($pesquisa,$tipo_pessoa, $nome, $documento, $telefone, $cep, $bairro, $rua, $numero, $status, $tipo_colaborador);
        $formata = json_decode(json_encode($data), true);
        $this->load->helper(array('form'));
        $this->load->view('templates/header');
        $this->load->view('templates/js');
        $this->load->view('colaborador/index', $formata);

    }

}