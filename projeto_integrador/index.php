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
<div class="banner" id="mais-informacoes">
    <div class="container">
    
                 <div class="linha">
    
                            <div class="colunm">
                                <h1>Armazém da Dona Lourdes.<br> Nossa História</h1>
                                    <p>
Dona Lourdes, com seus 53 anos, mantém vivo seu negócio há mais de 20 anos, cultivando sabores e memórias autênticos.

Do pão quentinho que perfuma o ar, ao mel dourado e às verduras vibrantes, tudo aqui respira a pureza do campo. Cada item é selecionado com o amor e o respeito que só a terra e quem trabalha com ela podem oferecer.

Nosso armazém é o seu convite para sentir o abraço e a tradição do interior, onde cada compra é uma experiência única. Venha nos visitar e leve um pedacinho do campo para sua casa!
                                    <br></p>
    
                            </div>
    
                            <div class="colunm">
                                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/Design sem nome (1).jpg" alt="" margin-left="30px">
                            </div>
    
                        </div>
    </div>
</div>
         
        <!--Novidades-->
        <h2 class="titulo">--Novidades--</h2>
        <?php
$sql_destaques = "SELECT * FROM produtos ORDER BY RAND() LIMIT 6";
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