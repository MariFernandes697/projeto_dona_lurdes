<?php
 require_once('includes/header-minha-conta.php')
?>
<!--Minha Conta-->

    <div class="minha-conta">
        <div class="container">
            <div class="linha">

                <div class="colunm">
                    <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logoDonaLurdes.png" alt="" width="70%" height="480px">

                </div>
                <div class="colunm">
                    <div class="formulario">
                        <div class="botao-formulario">
                            <span onclick="Entrar()">Entrar</span>
                            <span onclick="Cadastro()">Cadastro</span>
                            <hr id="Indicador">
                        </div>

                        <form action="" method="post" id="EntrarPainel">
                            <input type="email" name="email" id="" placeholder="E-mail de acesso">
                            <input type="password" name="senha" id="" placeholder="Senha">
                            <button type="submit" name="Entrar" class="botao">Entrar</button>
                            <a href="" title="">Esqueceu sua senha</a>
                        </form>

                        <form action="" method="post" id="CadastroSite">                      
                            <input type="text" name="nome" id="" placeholder="Nome Completo">
                            <input type="email" name="email" id="" placeholder="E-mail de acesso">
                            <input type="password" name="senha" id="" placeholder=" Digite sua Senha">
                            <button type="submit" name="Entrar" class="botao">Cadastre-se</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Fim Minha Conta-->
<?php
 require_once('includes/footer.php')
?>