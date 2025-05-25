<?php
session_start();

// Se já estiver logada, redireciona para o painel
if (isset($_SESSION['admin_logada'])) {
    // Redireciona diretamente para o painel
    header('Location: painel-admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login da Dona Lurdes</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container-login">
        <h2>Área da Dona Lurdes</h2>
        <form action="processar-login-admin.php" method="POST">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
