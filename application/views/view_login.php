<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="<?= base_url("css/login.css") ?>">
    <meta charset="utf-8">
    <title>Tela de Login</title>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="<?= base_url()?>Login/store">
            <input type="text" id="login" name="login" placeholder="Usuário ou E-mail:" required>
            <br><br>
            <input type="password" id="senha" name="senha" placeholder="Senha:" required>
            <br><br>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>