<?php
session_start();
include '../listar/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

// Atualiza os dados no banco
$sql = "UPDATE usuarios SET nome = ?, email = ?, endereco = ? WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssi", $nome, $email, $endereco, $usuario_id);

if ($stmt->execute()) {
    echo "<script>alert('Dados atualizados com sucesso!'); window.location='usuario.php';</script>";
} else {
    echo "Erro ao atualizar: " . $conexao->error;
}
?>