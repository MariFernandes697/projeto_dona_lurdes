<?php
session_start();
require_once('../listar/conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit();
}

// Busca os dados do usuário
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nome, email, endereco FROM usuarios WHERE id = $usuario_id";
$resultado = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Conta</title>
    <style>
        :root {
            --color01: #FFE9A3;
            --color02: #A4C994;
            --color03: #634A1A;
            --color04: #452409;
            --color05: #1C150A;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fefae0;
            margin: 0;
            padding: 0;
        }

        .usuario-container {
            max-width: 700px;
            margin: 60px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px #ccc;
        }

        .usuario-container h2 {
            color: var(--color05);
            font-size: 2em;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 15px;
            font-size: 1.2em;
            color: var(--color04);
        }

        .info span {
            font-weight: bold;
        }

        .botoes {
            margin-top: 30px;
        }

        .botoes a {
            display: inline-block;
            margin-right: 15px;
            padding: 10px 20px;
            background-color: var(--color02);
            color: var(--color05);
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .botoes a:hover {
            background-color: var(--color03);
            color: white;
        }
    </style>
</head>
<body>

<div class="usuario-container">
    <h2>Olá, <?php echo $usuario['nome']; ?>!</h2>

    <div class="info"><span>Email:</span> <?php echo $usuario['email']; ?></div>
    <div class="info"><span>Endereço:</span> <?php echo !empty($usuario['endereco']) ? $usuario['endereco'] : 'Não cadastrado'; ?></div>

    <div class="botoes">
        <a href="minhas-compras.php">Minhas Compras</a>
        <a href="editar-usuario.php" class="botao">Editar Meus Dados</a>
        <a href="../logout.php">Sair</a>
    </div>
</div>

</body>
</html>