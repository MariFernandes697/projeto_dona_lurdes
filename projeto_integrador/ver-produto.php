<?php require_once('includes/header-ver-produto.php')?>
<?php
include 'listar/conexao.php';

session_start();



// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara e executa a consulta
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql);
    // Verifica se encontrou o produto
    if (mysqli_num_rows($resultado) > 0) {
        $produto = mysqli_fetch_assoc($resultado);
    } else {
        echo "Produto não encontrado!";
        exit;
    }
} else {
    echo "ID do produto não informado!";
    exit;
}
?>

<!--Produtos detalhes-->
    <div class="corpo-categorias ver-produto">
        <div class="linha">
            <div class="colunm">
                <img src="<?php echo $produto['imagem']; ?>" width="80%" alt="<?php echo $produto['nome']; ?>" id="produtoImg">


                 
            </div>

            <div class="colunm">
            <h1><?php echo $produto['nome']; ?></h1>
            <h4>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></h4>
            <p><?php echo $produto['descricao']; ?></p>

             <form action="adicionar-carrinho.php" method="post">
                <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                <input type="hidden" name="nome" value="<?= $produto['nome'] ?>">
                <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">
                <input type="hidden" name="imagem" value="<?= $produto['imagem'] ?>">
                
                <label for="quantidade">Quantidade:</label>
                <select name="quantidade" id="quantidade">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <button type="submit" class="botao">Adicionar ao Carrinho</button>
            </form>


                    


            </div>
        </div>
    </div>



<!-- Fim-Produtos detalhes-->
<div class="corpo-categorias">
    <div class="linha linha2">
        <h2>Produtos relacionados</h2>
        <p>Veja mais</p>
        
    </div>
</div>
<?php

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
<?php require_once('includes/footer.php')?>