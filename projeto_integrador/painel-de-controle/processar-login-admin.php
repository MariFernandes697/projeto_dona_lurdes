<?php
session_start();

// Dados de exemplo (substitua por consulta ao banco)
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$usuario_valido = 'dona_lurdes'; // Exemplo de nome de usuário
$senha_valida = 'senha123'; // Exemplo de senha

if ($usuario === $usuario_valido && $senha === $senha_valida) {
    $_SESSION['admin_logada'] = true;
    header('Location: painel-admin.php');
} else {
    echo "Usuário ou senha inválidos!";
}
?>
