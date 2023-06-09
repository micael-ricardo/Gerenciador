<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    
      <link rel="stylesheet"  href="<?= base_url("DataTable/select.dataTables.css") ?>">
    <link rel="stylesheet"  href="<?= base_url("Datatable/dataTables.bootstrap.min.css") ?>">
    <link rel="stylesheet"  href="<?= base_url("Datatable/datatables.min.css") ?>">
    <link rel="stylesheet"  href="<?= base_url("Datatable/datatables.css") ?>">
    <link rel="stylesheet"  href="<?= base_url("js/bootstrap.min.js") ?>">
    <link rel="stylesheet"  href="<?= base_url("css/sweetalert2.min.css") ?>">


    <link rel="stylesheet"  href="<?= base_url("css/select2.css") ?>">
    <link rel="stylesheet"  href="<?= base_url("css/estilodatatable.css") ?>">
  
    
    <link rel="stylesheet"  href="<?= base_url("css/bootstrap.min.css") ?>">
    <link rel="stylesheet"  href="<?= base_url("css/bootstrap-theme.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("css/estrutura.css") ?>">
    <link rel="stylesheet" href="<?= base_url("css/modal.css") ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <header>
        <div class="estilo-header">
            <?= anchor("login/sair", " Sair", array("class" => "fa fa-sign-in btn btn-danger")) ?>
        </div>
    </header>
    <section class="main">
        <div class="sidebar">
        <a href="<?= base_url('dashboard/index') ?>">  <h5><i class="fa fa-home" aria-hidden="true"></i> Home</h5> </a>
            <a href="<?= base_url('Usuarios/index') ?>"><i class="fa fa-user"
                    aria-hidden="true"></i> Usuários</a>
            <a href="<?= base_url('Colaborador/index') ?>"><i class="fa fa-users"></i>
                Colaboradores</a>
            <a href="<?= base_url('Produtos/index') ?>"><i class="fa fa-archive"></i> Produtos</a>
            <a href="<?= base_url('Pedidos/index') ?>"><i class="fa fa-file-text" aria-hidden="true"></i> Pedidos</a>
            <hr>
        </div>