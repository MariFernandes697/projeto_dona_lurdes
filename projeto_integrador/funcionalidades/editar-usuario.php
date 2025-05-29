<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../listar/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $conexao->prepare("SELECT nome, email, endereco FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($nome, $email, $endereco);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    // Validação básica (pode expandir depois)
    if (empty($nome) || empty($email) || empty($endereco)) {
        echo "<script>alert('Preencha todos os campos.'); window.history.back();</script>";
        exit;
    }

    $stmt = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, endereco = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nome, $email, $endereco, $usuario_id);
    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href = 'meus_dados.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar.'); window.history.back();</script>";
    }
    $stmt->close();
} else {
    header("Location: usuario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Meus Dados</title>
    <style>
        form {
            max-width: 400px;
            margin: 30px auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input, textarea, button {
            padding: 10px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Editar Meus Dados</h2>

<form method="post" action="editar-usuario.php">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($nome) ?>" required>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>

    <label for="endereco">Endereço:</label>
    <textarea name="endereco" id="endereco" required><?= htmlspecialchars($endereco) ?></textarea>

    <button type="submit">Salvar Alterações</button>
</form>

</body>
</html>