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