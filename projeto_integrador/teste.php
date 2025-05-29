<?php
// teste logout.php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>
<?php 
    // teste menu usuario
           
           
           if (isset($_SESSION['usuario_id'])): ?>
    <div class="menu-usuario">
        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_principal.png"  alt="Usuário" onclick="toggleMenuUsuario()">
        <div class="dropdown-usuario" id="dropdownUsuario">
            <a href="minha_conta.php">Minha Conta</a>
            <a href="minhas-compras.php">Minhas Compras</a>
            <a href="logout.php">Sair</a>
        </div>
    </div>
<?php else: ?>
    <a href="minha_conta.php" class="botao">Login</a>
    <a href="carrinho.php" title=""><img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/carrinho-de_compras.png" alt="" width="60px" height="60px"></a>
                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/menu.png" alt="" class="menu-celular" onclick="menucelular()">
<?php endif; ?>

<?php
        // teste produtos dinamicos página index
$produto_id_atual = $_GET['id'];

$sql_relacionados = "
SELECT * FROM produtos 
WHERE id != $produto_id_atual 
ORDER BY RAND() 
LIMIT 4
";
$resultado_relacionados = mysqli_query($conexao, $sql_relacionados);
?>
<div class="produtos-relacionados">
    <?php while($relacionado = mysqli_fetch_assoc($resultado_relacionados)): ?>
        <div class="produto">
             <img src="<?php echo $relacionado['imagem']; ?>" alt="<?php echo $relacionado['nome']; ?>">
            <h3><?php echo $relacionado['nome']; ?></h3>
            <p>R$ <?php echo number_format($relacionado['preco'], 2, ',', '.'); ?></p>
            <a href="ver-produto.php?id=<?php echo $relacionado['id']; ?>" class="botao">Ver Produto</a>
        </div>
    <?php endwhile; ?>
</div>



<?php
//teste produtos dinamicos página ver-produto
// Busca produtos relacionados (exceto o produto atual)
$produto_id_atual = $_GET['id'];

$sql_relacionados = "
SELECT * FROM produtos 
WHERE id != $produto_id_atual 
ORDER BY RAND() 
LIMIT 4
";

$resultado_relacionados = mysqli_query($conexao, $sql_relacionados);
?>
<div class="produtos-relacionados">
    <?php while($relacionado = mysqli_fetch_assoc($resultado_relacionados)): ?>
        <div class="produto">
            <img src="<?php echo $relacionado['imagem']; ?>" alt="<?php echo $relacionado['nome']; ?>">
            <h4><?php echo $relacionado['nome']; ?></h4>
            <p>R$ <?php echo number_format($relacionado['preco'], 2, ',', '.'); ?></p>
            <a href="ver-produto.php?id=<?php echo $relacionado['id']; ?>" class="botao">Ver Produto</a>
        </div>
    <?php endwhile; ?>
    </div>

<?php
//teste produtos dinamicos página produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

// Exibe os produtos
if ($result->num_rows > 0) {
    echo '<div class="container-produtos">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card-produto">';
        echo '<img src="' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
        echo '<h3>' . $row["nome"] . '</h3>';
        echo '<p>' . $row["descricao"] . '</p>';
        echo '<p><strong>R$ ' . number_format($row["preco"], 2, ',', '.') . '</strong></p>';
        echo '<a class="botao-vermais" href="ver-produto.php?id=' . $row['id'] . '">Ver mais</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>Nenhum produto encontrado.</p>';
}

$conn->close();
?>

   
<?php require_once('includes/header-produtos.php')?>

        <div class="corpo_categorias">

            <div class="linha linha2">
                <h2>Todos os Produtos</h2>
                <select name = "" id="">
                    <option value="">Mais comprados</option>
                    <option value="">Maior preço</option>
                    <option value="">Menor preço</option>
                </select>
            </div>

<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "projeto_dona_lurdes");

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta os produtos


$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

// Exibe os produtos
if ($result->num_rows > 0) {
    echo '<div class="container-produtos">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card-produto">';
        echo '<img src="' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
        echo '<h3>' . $row["nome"] . '</h3>';
        echo '<p>' . $row["descricao"] . '</p>';
        echo '<p><strong>R$ ' . number_format($row["preco"], 2, ',', '.') . '</strong></p>';
        echo '<a class="botao-vermais" href="ver-produto.php?id=' . $row['id'] . '">Ver mais</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>Nenhum produto encontrado.</p>';
}

$conn->close();
?>

            

<?php require_once('includes/footer.php')?>



<ul>
                        <?php
                        // teste minhas-compras.php
                        $pedido_id = $pedido['id'];
                        $sql_produtos = "
                            SELECT p.nome, ip.quantidade, ip.preço_unitario
                            FROM itens_pedido ip
                            JOIN produtos p ON ip.produto_id = p.id
                            WHERE ip.pedido_id = $pedido_id
                        ";
                        $res_produtos = mysqli_query($conexao, $sql_produtos);

                        while ($item = mysqli_fetch_assoc($res_produtos)) {
                            echo '<li>' . $item['nome'] . ' - ' . $item['quantidade'] . 'x R$ ' . number_format($item['preço_unitario'], 2, ',', '.') . '</li>';
                        }
                        ?>
                    </ul>