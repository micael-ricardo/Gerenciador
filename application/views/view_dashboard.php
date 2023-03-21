<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>
</head>

<style>
    html,
    body {
        height: 100%;
    }

    header {
        background-color: #00008b;
        padding: 10px 2%;
        display: flex;
        justify-content: space-between;
    }

    .estilo-header {
        color: white;
        display: flex;
        justify-content: space-around;
        width: 200px;
    }

    .estilo-header svg {
        margin-left: 0 10px;
    }

    .main {
        display: flex;
        flex-wrap: wrap;
        height: 100%;
    }

    .sidebar a.sidebar-active {
        border-left: 4px solid #00008b;
        background-color: rgb(230, 230, 230);
        font-weight: bold;
        color: #777;
    }

    .sidebar a.sidebar-active>svg {
        color: #777;
    }


    .sidebar {
        width: 20%;
        background-color: white;
        height: 100%;
    }

    .sidebar h3 {
        color: #333;
        font-size: 20px;
        margin: 10px;
    }

    .sidebar a {
        display: block;
        text-decoration: none;
        padding: 10px;
        color: #444;
    }
 
    .sidebar a:hover {
        border-left: 4px solid #00008b;
        background-color: rgb(230, 230, 230);
        font-weight: bold;
        color: #777;
    }

    .sidebar a>svg {
        color: #444;
    }

    .content {
        width: 80%;
        background-color: rgb(230, 230, 230);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

    <header>
        <div class="estilo-header">
                <h3>Gerenciador</h3>
        </div>
        <div style="align-items: center;" class="estilo-header">
            <i class="fa fa-sign-in" aria-hidden="true"> Sair</i>
        </div>
    </header>

    <section class="main">
        <div class="sidebar">
            <h3>Home</h3>
            <i class="fa-solid fa-house-chimney"></i>
            <a class="sidebar-active" href="#">teste</a>
            <a href="#">teste</a>
            <a href="#">teste</a>
            <hr>
        </div>
        <div class="content">

            <div><i class="fa fa-home">Home</i></div>
            <div><i class="fa fa-search">Busca</i></div>
            <div><i class="fa fa-cloud">Nuvem</i></div>
            <div><i class="fa fa-trash">Lixo</i></div>
        </div>

    </section>


</body>