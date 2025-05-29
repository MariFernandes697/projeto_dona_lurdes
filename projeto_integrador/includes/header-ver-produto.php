<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Vendas Armazém do Sítio</title>
    <link rel="stylesheet" href="html/loja_dona_lurdes/css/style.css">
    <link rel="stylesheet" href="html/loja_dona_lurdes_produtos/css/style.css">
    <style>
.produtos-relacionados {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 30px;
    margin-bottom: 30px;
}
.produto {
    background-color: #fff8e1;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 8px #ccc;
    text-align: center;
}
.produto img {
    max-width: 100%;
    height: auto;
}
.botao {
    background-color: #A4C994;
    color: white;
    padding: 10px;
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    border-radius: 5px;
}
.botao:hover {
    background-color: #88b277;
}


    </style>
</head>
<body>
    <!--Início-->
    <!--Menu-->
    <div class="novoMenu">
        <!--Container-->
        <div class="container">
            <!--Navegação do Site-->
            <div class="navbar">

               <div class="logo">
                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_principal.png" alt="Logo Dona Lurdes" width="110px" height="100px">
               </div>

               <!--Menu-->
               <nav>
                <ul id="MenuItens">
                    <li><a href="index.php" title="">Início</a></li>
                    <li><a href="produtos.php" title="">Produtos</a></li>
                    <li><a href="#contato" title="">Contato</a></li>
                    <li><a href="minha_conta.php" title="">Minha Conta</a></li>
                </ul>
               </nav>

                <a href="carrinho.php" title=""><img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/carrinho-de_compras.png" alt="" width="60px" height="60px"></a>
                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/menu.png" alt="" class="menu-celular" onclick="menucelular()">
               <!--Fim-Menu-->
            
            </div>