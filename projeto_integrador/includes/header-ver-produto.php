<?php
session_start()
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Vendas Armazém do Sítio</title>
    <link rel="stylesheet" href="html/loja_dona_lurdes/css/style.css">
    <link rel="stylesheet" href="html/loja_dona_lurdes_produtos/css/style.css">
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
.container-produtos {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 30px;
}

.card-produto {
  background-color: #fff8ed;
  border: 2px solid #ffefd7;
  border-radius: 10px;
  padding: 15px;
  width: 250px;
  text-align: center;
  transition: transform 0.3s ease;
  box-shadow: 2px 2px 8px rgba(180,174,174,0.1);
}

.card-produto:hover {
  transform: scale(1.03);
}

.card-produto img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 10px;
}

.card-produto h3 {
  font-size: 1.25rem;
  color: #4e2e0f;
  margin: 8px 0 4px;
}

.card-produto p {
  font-size: 1rem;
  color: #6b4c1d;
  margin: 4px 0 12px;
}

.botao-vermais {
  background-color: #5cb85c;
  color: #fff;
  padding: 8px 14px;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
}

.botao-vermais:hover {
  background-color: #4cae4c;
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
                    <?php if (!isset($_SESSION['usuario_id'])): ?>
                            <li><a href="minha_conta.php">Login</a></li>
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
                            <a href="minha_conta.php" title="">Minha Conta</a>
                            <a href="funcionalidades/minhas-compras.php">Minhas Compras</a>
                            <a href="logout.php">Sair</a>
                        </div>
                    </div>
                <?php endif; ?>
                </ul>
               </nav>
            
            </div>