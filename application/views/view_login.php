<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tela de Login</title>
    <style>
        h1 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        body {
            background-image: linear-gradient(45deg, blue, white);
        }

        .container {

            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            position: absolute;
            padding: 80px;
            border-radius: 15px;
            color: antiquewhite;
        }

        input {
            padding: 10px;
            border-radius: 5px;
            border: none;
            outline: none;
            box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.1);
        }

        .btn {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0069d9;
        }
    </style>
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