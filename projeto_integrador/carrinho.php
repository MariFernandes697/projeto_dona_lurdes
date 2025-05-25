<?php
 require_once('includes/header-carrinho.php')
?>
<!--Carrinho de Compras-->
        <div class="corpo-categorias carrinho-de-compras" >
            <!--Tabela Carrinho de Compras-->
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td>
                        <div class="carrinho-info">
                            <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/bolacha.jpg" alt="">
                            <div>
                                <p>Bolacha de Nata</p>
                                <small>valor: R$54</small>
                                <br>
                                <a href="" title="">Remover</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="number" name="" id="" value="1">
                        </form></td>
                    <td>R$45,00</td>
                    
                </tr>
                <tr>
        
                </tr>
                <tr>
                    <td>
                        <div class="carrinho-info">
                            <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/doce_de_abobora.png" alt="">
                            <div>
                                <p>Doce de Abóbora</p>
                                <small>valor: R$54</small>
                                <br>
                                <a href="" title="">Remover</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="number" name="" id="" value=" 1">
                        </form></td>
                    <td>R$45,00</td>
                    
                </tr>

                <tr>
                    <td>
                        <div class="carrinho-info">
                            <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/doce_de_figo.png" alt="">
                            <div>
                                <p>Doce de Figo</p>
                                <small>valor: R$54</small>
                                <br>
                                <a href="" title="">Remover</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="number" name="" id="" value=" 1">
                        </form></td>
                    <td>R$45,00</td>
                    
                </tr>
            </table>
            <div class="valor-total">
                <table>
                    <tr>
                        <td>Sub-Total</td>
                        <td>40,00</td>
                    </tr>
                    <tr>
                        <td>Frete</td>
                        <td>5,00</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>45,00</td>
                    </tr>
                </table>
                <div class="botao-final"><a class="botao-finalizar" href="checkout.html">Finalizar Compra</a></div>
               
            </div>
             
            <!--Fim Tabela Carrinho de Compras-->
            
        </div>
     

        <!--Fim- Carrinho de Compras-->
<?php
 require_once('includes/footer.php')
?>