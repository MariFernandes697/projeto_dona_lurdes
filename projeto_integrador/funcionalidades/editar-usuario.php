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
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<?php include '../includes/header.php'?>

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
