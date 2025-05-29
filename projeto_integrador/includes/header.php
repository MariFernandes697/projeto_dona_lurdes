<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Vendas Armazém do Sítio</title>
    <link rel="stylesheet" href="html/loja_dona_lurdes/css/style.css">
    <style>  
        .menu-usuario {
            position: relative;
            display: inline-block;
            margin-left: 10px;
        }

        .menu-usuario img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #ccc;
            padding: 5px;
            background-color: #fff;
        }

        .dropdown-usuario {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            border-radius: 8px;
            min-width: 160px;
            z-index: 999;
            margin-top: 10px;
        }

        .dropdown-usuario a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-usuario a:hover {
            background-color: #f1f1f1;
        }
.produtos-destaque {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 30px;
    margin-bottom: 30px;
    margin-left: 20px;
    margin-right: 20px;
    transition: transform 0.5s;
}
.produtos-destaque :hover{
     transform: scale(1.03);
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
    <!--Banner-->
    <div class="banner">
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

                        <?php if (!isset($_SESSION['usuario_id'])): ?>
                            <li><a href="minha_conta.php" class="botao">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <a href="carrinho.php" title="">
                    <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/carrinho-de_compras.png" alt="Carrinho" width="60px" height="60px">
                </a>

                <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/menu.png" alt="Menu Celular" class="menu-celular" onclick="menucelular()">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <div class="menu-usuario">
                        <img src="html/loja_dona_lurdes/projeto/arquivos-loja-v-1/img/logo_principal.png"  alt="Usuário" onclick="toggleMenuUsuario()">
                        <div class="dropdown-usuario" id="dropdownUsuario">
                            <a href="funcionalidades/usuario.php" title="">Minha Conta</a>
                            <a href="funcionalidades/minhas-compras.php">Minhas Compras</a>
                            <a href="logout.php">Sair</a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <!--Fim-Navegação do Site-->