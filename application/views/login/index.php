<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('js/login.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url("css/login.css") ?>">
    <meta charset="utf-8">
    <title>Tela de Login</title>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="<?= base_url() ?>Login/store">
            <input type="text" id="login" name="login" placeholder="Usuário ou E-mail:" required>
            <br><br>
            <input type="password" id="senha" name="senha" placeholder="Senha:" required>
            <br><br>
            <span class="input-group-text" id="olho">
                <i class="fa fa-eye"></i>
            </span>
            <br><br>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
