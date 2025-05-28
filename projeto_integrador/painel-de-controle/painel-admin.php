<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel da Dona Lurdes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #fefae0;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .painel-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 60px 20px;
            text-align: center;
        }

        h1 {
            color: #6c3900;
            margin-bottom: 40px;
            font-size: 1.5em;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 25px;
        }

        .card {
            background: #8b5e3c;
            color: #fff;
            padding: 30px 20px;
            border-radius: 20px;
            text-decoration: none;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .card:hover {
            background: #a66b43;
            transform: translateY(-5px);
        }

        .card i {
            font-size: 28px;
            margin-bottom: 10px;
            display: block;
        }

        .card span {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="painel-container">
        <h1>Bem-vinda, Dona Lurdes!</h1>
        <div class="card-container">
            <a href="listar-produtos.php" class="card">
                <i class="fas fa-boxes"></i>
                <span>Listar Produtos</span>
            </a>
            <a href="cadastrar-produto.php" class="card">
                <i class="fas fa-plus-square"></i>
                <span>Cadastrar Produto</span>
            </a>
            <a href="ver-pedido.php" class="card">
                <i class="fas fa-clipboard-list"></i>
                <span>Ver Pedidos</span>
            </a>
            <a href="logout_admin.php" class="card">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a>
        </div>
    </div>
</body>
</html>
