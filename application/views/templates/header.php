<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= base_url("css/estrutura.css") ?>">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<body>
    <header>
        <div class="estilo-header">
            <h3>Gerenciador</h3>
        </div>
        <div style="margin-left: 90%; align-items: center; " class="estilo-header">
        <?= anchor("login/sair", " Sair", array("class" => "fa fa-sign-in btn btn-primary")) ?>
        </div>
    </header>
    <section class="main">
        <div class="sidebar">
            <h3>Home</h3>
            <a class="sidebar-active" href="<?= base_url('Colaborador/index') ?>"><i class="fa fa-users"></i> Colaboradores</a>
            <a href="<?= base_url('Produtos/index') ?>"><i class="fa fa-archive"></i> Produtos</a>
            <a href="#"><i class="fa fa-file-text" aria-hidden="true"></i> Pedidos</a>
            <hr>
        </div>