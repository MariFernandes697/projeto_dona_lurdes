<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

require_once('../listar/conexao.php');

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = floatval($_POST['preco']);

    $query = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ssd", $nome, $descricao, $preco);

    if ($stmt->execute()) {
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar produto: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            background: #fefae0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            color: #6c3900;
            text-align: center;
            margin-bottom: 30px;
        }

        input, textarea, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #8b5e3c;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #a66b43;
        }

        .mensagem {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }

        a {
            display: block;
            text-align: center;
            color: #6c3900;
            text-decoration: none;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Cadastrar Novo Produto</h2>
        <?php if (!empty($mensagem)) echo "<div class='mensagem'>$mensagem</div>"; ?>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome do produto" required>
            <textarea name="descricao" placeholder="Descrição do produto" required></textarea>
            <input type="number" name="preco" step="0.01" placeholder="Preço (ex: 19.90)" required>
            <button type="submit">Cadastrar</button>
        </form>
        <a href="painel-admin.php">Voltar ao Painel</a>
    </div>
</body>
</html>