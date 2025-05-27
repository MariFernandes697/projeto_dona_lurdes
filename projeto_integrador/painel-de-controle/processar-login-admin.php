<?php
session_start();

// Dados de login (você pode substituir por uma consulta ao banco no futuro)
$usuario_valido = 'DonaLurdes';
$senha_valida = 'Anne';

// Dados recebidos do formulário
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

// Verifica se estão corretos
if ($usuario === $usuario_valido && $senha === $senha_valida) {
    $_SESSION['admin_logada'] = true;
    header('Location: painel-admin.php');
    exit;
} else {
    header('Location: login-admin.php?erro=1');
    exit;
}
?>
