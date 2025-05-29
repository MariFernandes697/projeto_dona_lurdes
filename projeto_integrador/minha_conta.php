<?php
session_start();
require_once('includes/header-minha-conta.php');
require_once('listar/conexao.php'); // Garante conexão com o banco

if (isset($_SESSION['mensagem'])) {
    echo "<div class='alerta-login'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}


// Cadastro de novo usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha

    // Verifica se e-mail já existe
    $verifica = mysqli_query($conexao, "SELECT id FROM usuarios WHERE email = '$email'");
    if (mysqli_num_rows($verifica) > 0) {
        echo "<script>alert('E-mail já cadastrado!');</script>";
    } else {
        $query = "INSERT INTO usuarios (nome, email, senha, criado_em) VALUES ('$nome', '$email', '$senha', NOW())";
        if (mysqli_query($conexao, $query)) {
            $_SESSION['usuario_id'] = mysqli_insert_id($conexao);
            $_SESSION['usuario_nome'] = $nome;
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='$redirect';</script>";

        } else {
            echo "<script>alert('Erro ao cadastrar.');</script>";
        }
    }
}

// Login de usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);

    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        
        $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
        echo "<script>alert('Login realizado com sucesso!'); window.location.href='$redirect';</script>";
        exit;
    } else {
        echo "<script>alert('Senha incorreta!');</script>";
    }
} else {
    echo "<script>alert('Usuário não encontrado!');</script>";

}
}
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

                    <!-- Formulário de Login -->
                    <form action="" method="post" id="EntrarPainel">
                        <input type="email" name="email" placeholder="E-mail de acesso" required>
                        <input type="password" name="senha" placeholder="Senha" required>
                        <button type="submit" name="Entrar" class="botao">Entrar</button>
                        <a href="" title="">Esqueceu sua senha</a>
                    </form>

                    <!-- Formulário de Cadastro -->
                    <form action="" method="post" id="CadastroSite">
                        <input type="text" name="nome" placeholder="Nome Completo" required>
                        <input type="email" name="email" placeholder="E-mail de acesso" required>
                        <input type="password" name="senha" id="senhaCadastro" placeholder="Digite sua Senha" required>
                            <small style="display:block; margin-top:5px;">
                                <a href="#" onclick="gerarSenha(); return false;">Gerar senha forte</a>
                            </small>


                        <button type="submit" name="Cadastrar" class="botao">Cadastre-se</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Fim Minha Conta-->

<?php
require_once('includes/footer-minha-conta.php');
?>
