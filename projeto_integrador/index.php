<?php 

 require_once('includes/header.php');
 require_once('listar/conexao.php')?>

<div class="linha">

    <div class="colunm">
        <h1>Armazém de Produtos Artesanais e Hortifruti<br> da Dona Lourdes.<br> Seja Bem Vindo!</h1>
            <p>No Armazém da Dona Lourdes, cada produto conta uma história do campo e a tradição se mistura com o frescor da roça!
            <br></p>

        <br><br><a href="#mais-informacoes" class="botao">Mais informações &#8594 </a>
    </div>

    <div class="colunm">
        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logoDonaLurdes.png" alt="">
    </div>
    

</div>

        </div>
        <!--Fim-Container-->
        <!--Fim-Banner-->
    </div>

        <!--Destaque-Categorias-->
            <div class="categorias">
                <!--Categorias-corpo-->
                <div class="corpo-categorias">
                    <!--linha-categoria-->
                    <div class="linha">

                        <div class="colunm3">
                                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/categoria_produtos_artesanais.png" alt="">
                                <h2>Produtos Artesanais</h2>
                        </div>
                        
                        <div class="colunm3">
                                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/categoria_hortifruti.png" alt="">
                                <h2>Hortifruti</h2>
                        </div>

                    </div>
                    <!--fim-linha-categoria-->
                    
                </div>
                <!--Fim-Categorias-corpo-->
            </div>
        <!--Fim-Destaque-Categorias-->
        <!--Novidades-->
        <h2 class="titulo">--Novidades--</h2>
        <?php
$sql_destaques = "SELECT * FROM produtos ORDER BY RAND() LIMIT 7";
$resultado_destaques = mysqli_query($conexao, $sql_destaques);
?>
<div class="container-produtos">
  <?php while($produto = mysqli_fetch_assoc($resultado_destaques)): ?>
    <div class="card-produto">
      <img src="<?= $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>">
      <h3><?= $produto['nome'] ?></h3>
      <p><strong>R$ <?= number_format($produto['preco'],2,',','.') ?></strong></p>
      <a href="ver-produto.php?id=<?= $produto['id'] ?>" class="botao-vermais">Ver Produto</a>
    </div>
  <?php endwhile; ?>
</div>
        <div class="linha">
             <br><br><a href="produtos.php" class="botao">Comprar agora &#8594;</a>
        </div>
        <!--Fim-Novidades-->

        <!--Fim-Destaque-Produtos-->

        <!--Marcas-->
        <div class="marcas">
            <div class="corpo-categorias">
                <div class="linha">

                    <div class="colunm5">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_parana.png" alt="">
                    </div>
                    <div class="colunm5">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_uepg.png" alt="">
                    </div>
                    <div class="colunm5">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_talento_tech.png" alt="">
                    </div>
                    <div class="colunm5">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_fundacao_araucaria.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!--Fim-Marcas-->
<?php require_once('includes/footer.php')?>