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


                <div class="img-linha">
                    <div class="img-colunm">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/pote_de_mel.jpeg" width="100%"  alt="" class="miniatura-do-produto">
                
                    </div>
                    <div class="img-colunm">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/doce_de_mamao.png"  width="100%" alt="" class="miniatura-do-produto">
                
                    </div>
                    <div class="img-colunm">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/doce_de_amora.png"  width="100%"  alt="" class="miniatura-do-produto">
                
                    </div>
                    <div class="img-colunm">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/doce_de_amora.png"  width="100%"  alt="" class="miniatura-do-produto">
                
                    </div>
                </div>
                 
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

        <!--Destaque-Produtos-->
        <div class="corpo_categorias">
            <div class="linha">
                <!--Produtos-->
                <div class="colunm4">
                    <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/pote_de_mel.jpeg" alt="" width="200px" height="200px">
                    <h4>Pote de Mel Artesanal</h4>
                    <p>R$ 14,90</p>
                </div>
                <div class="colunm4">
                    <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/geleia.png" alt="" width="200px" height="200px">
                    <h4>Geleia de frutas</h4>
                    <p>R$ 20,90</p>
                </div>
                <div class="colunm4">
                    <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/queijo_caseiro.png" alt="" width="200px" height="200px">
                    <h4>Queijo Caseiro</h4>
                    <p>R$ 45,90</p>
                </div>
                <div class="colunm4">
                    <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/bolacha.jpg" alt="" width="200px" height="200px">
                    <h4>Bolachas de Nata</h4>
                    <p>R$ 8,90</p>
                </div>
                        <!--Fim-Produtos-->
            </div>
        </div>
<?php require_once('includes/footer.php')?>