<?php
session_start();
include '../listar/conexao.php';


if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Busca os dados atuais do usuário
$sql = "SELECT * FROM usuarios WHERE id = $usuario_id";
$result = $conexao->query($sql);
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Meus Dados</title>
    <link rel="stylesheet" href="../html/loja_dona_lurdes/css/style.css">
    <style>  

    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 40px;
    color: #444;
}

form {
    max-width: 500px;
    margin: 40px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
    color: #333;
}

input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus {
    border-color:#A4C994;
    outline: none;
}

input[type="submit"] {
    background-color:#A4C994;
    color: white;
    border: none;
    padding: 14px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background-color 0.3s ease;
    transition: transform 0.5s;
}

input[type="submit"]:hover {
    background-color:#A4C994;
    color:#1C150A;
    transform: scale(1.05);
}




    </style>
</head>
<body>

<h2>Editar Meus Dados</h2>
<form method="POST" action="salvar_edicao.php">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>

    <label>Endereço:</label><br>
    <input type="text" name="endereco" value="<?php echo $usuario['endereco']; ?>"><br>

    <br>
    <input type="submit" value="Salvar alterações">
</form>

<?php include '../includes/footer.php'; ?>
</body>
</html>
