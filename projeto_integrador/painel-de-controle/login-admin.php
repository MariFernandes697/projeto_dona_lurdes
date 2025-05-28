<?php
session_start();
require_once '../listar/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $admin = $resultado->fetch_assoc();
        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_email'] = $admin['email'];
            header("Location: painel-admin.php");
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Administrador não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
    body {
        background-color: #fff8e1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background-color: #fff3cd;
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 320px;
    }

    .login-container h2 {
        color: #6c3900;
        margin-bottom: 20px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 10px;
        margin: 10px 0;
        border: 1px solid #d4a373;
        border-radius: 10px;
        box-sizing: border-box;
        background-color: #fffaf0;
    }

    button {
        background-color: #bc6c25;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 10px;
        width: 100%;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s ease;
    }

    button:hover {
        background-color: #99582a;
    }

    p {
        color: #d62828;
        font-weight: bold;
        margin-top: 10px;
    }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Login da Dona Lurdes</h2>
        <?php if (isset($erro)) echo "<p>$erro</p>"; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>