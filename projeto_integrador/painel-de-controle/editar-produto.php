<?php
session_start();
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login-admin.php");
    exit;
}

require_once('../listar/conexao.php');

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    echo "ID do produto não informado.";
    exit;
}

$id = intval($_GET['id']);
$mensagem = "";

// Atualiza o produto ao enviar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = floatval($_POST['preco']);

    $query = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco' WHERE id=$id";

    if (mysqli_query($conexao, $query)) {
        $mensagem = "Produto atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar o produto.";
    }
}

// Busca os dados atuais do produto
$query = "SELECT * FROM produtos WHERE id=$id";
$resultado = mysqli_query($conexao, $query);
$produto = mysqli_fetch_assoc($resultado);

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}
?><!DOCTYPE html><html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h2>Editar Produto</h2>
    <p><?php echo $mensagem; ?></p>
    <form action="" method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required><br><br>
        <label>Descrição:</label><br>
        <textarea name="descricao" required><?php echo $produto['descricao']; ?></textarea><br><br>
        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?php echo $produto['preco']; ?>" required><br><br>
        <button type="submit">Salvar Alterações</button>
    </form>
    <a href="listar-produtos.php">Voltar</a>
</body>
</html>
