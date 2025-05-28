<?php
session_start();
require_once '../listar/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../minha_conta.php");
    exit;
}

// Verifica se o carrinho tem itens
if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
    echo "<h3>Seu carrinho está vazio.</h3>";
    echo "<a href='../index.php'>Voltar para loja</a>";
    exit;
}

// Recupera dados do usuário
$usuario_nome = $_SESSION['usuario_nome'];
$usuario_email = ''; // opcional, se você armazenar o email na sessão

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação do Pedido</title>
    <link rel="stylesheet" href="confirmar-pedido.css?v=3">
    <style>
        .form-pagamento {
            margin-top: 30px;
        }
        .form-pagamento label {
            display: block;
            margin-bottom: 5px;
            color: #4a2d14;
        }
        .form-pagamento input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d8c6aa;
            border-radius: 6px;
        }
        .form-pagamento .metodo {
            margin-bottom: 20px;
        }
        .pagamento-opcoes {
            display: flex;
            gap: 20px;
        }
        .cartao-info, .pix-info {
            flex: 1;
            background-color: #fffaf0;
            padding: 15px;
            border: 1px solid #f0d9b5;
            border-radius: 10px;
        }
        .icon-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .icon-label img {
            width: 24px;
            height: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirmar Pedido</h2>
        <p><strong>Cliente:</strong> <?= $usuario_nome ?></p>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['carrinho'] as $produto_id => $item) {
                    $nome = $item['nome'];
                    $quantidade = $item['quantidade'];
                    $preco = $item['preco'];
                    $subtotal = $quantidade * $preco;
                    $total += $subtotal;
                    echo "<tr><td>$nome</td><td>$quantidade</td><td>R$ ".number_format($subtotal, 2, ',', '.')."</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>
<form id="formPagamento" class="form-pagamento" action="../finalizar-pedido.php" method="POST">
    <label for="endereco_entrega">Endereço para Entrega</label>
    <input type="text" name="endereco_entrega" id="endereco_entrega" required>

    <div class="metodo">
        <label><input type="radio" name="metodo_pagamento" value="cartao" checked> Cartão de Crédito</label>
        <label><input type="radio" name="metodo_pagamento" value="pix"> PIX</label>
        <label><input type="radio" name="metodo_pagamento" value="mercado_pago"> Mercado Pago</label>
        <label>
            <input type="radio" name="metodo_pagamento" value="presencial">
            <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" alt="Pagamento Presencial" width="20">
            Pagamento Presencial
        </label>
    </div>

    <div class="pagamento-opcoes">
        <div class="cartao-info">
            <div class="icon-label">
                <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/icons/credit-card.svg" alt="Cartão"> Cartão de Crédito
            </div>
            <label for="nome_titular">Nome no Cartão</label>
            <input type="text" name="nome_titular" id="nome_titular">

            <label for="numero_cartao">Número do Cartão</label>
            <input type="text" name="numero_cartao" id="numero_cartao">

            <label for="validade">Validade</label>
            <input type="text" name="validade" id="validade" placeholder="MM/AA">

            <label for="cvv">CVV</label>
            <input type="text" name="cvv" id="cvv">
        </div>

        <div class="pix-info" style="display: none;">
            <label>Sua chave PIX para pagamento:</label>
            <input type="text" id="chave_pix" name="chave_pix" value="00020126450014BR.GOV.BCB.PIX0123chave pix alphanumerica5204000053039865802BR5911Dona Lurdes6008Loada-PR62070503***6304EFBC" readonly>
            <button type="button" onclick="copiarPix()">Copiar</button>

            <div style="margin-top: 20px;">
                <p>Ou escaneie o QR Code abaixo:</p>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=dona.lurdes@armazem.com.br" alt="QR Code PIX">
            </div>
        </div>
    </div>

    <button type="submit" class="botao-confirmar">Confirmar e Pagar</button>
</form>

        <br>
        <a href="../carrinho.php">Voltar ao carrinho</a>
    </div>

   <script>
    function mostrarCampos(metodo) {
        const cartao = document.querySelector('.cartao-info');
        const pix = document.querySelector('.pix-info');
        
        cartao.style.display = (metodo === 'cartao') ? 'block' : 'none';
        pix.style.display = (metodo === 'pix') ? 'block' : 'none';

        // Para os outros, esconde tudo
        if (metodo !== 'cartao' && metodo !== 'pix') {
            cartao.style.display = 'none';
            pix.style.display = 'none';
        }
    }

    document.querySelectorAll('input[name="metodo_pagamento"]').forEach(el => {
        el.addEventListener('change', () => {
            mostrarCampos(el.value);
        });
    });

    // Mostrar o campo certo ao carregar a página
    window.addEventListener('DOMContentLoaded', () => {
        const metodoSelecionado = document.querySelector('input[name="metodo_pagamento"]:checked').value;
        mostrarCampos(metodoSelecionado);
    });
</script>
<script>
document.getElementById("formPagamento").addEventListener("submit", function(e) {
    const metodo = document.querySelector('input[name="metodo_pagamento"]:checked').value;

    if (metodo === "cartao") {
        const nome = document.getElementById("nome_titular").value.trim();
        const numero = document.getElementById("numero_cartao").value.trim();
        const validade = document.getElementById("validade").value.trim();
        const cvv = document.getElementById("cvv").value.trim();

        const erros = [];

        if (nome === "") erros.push("O nome do titular é obrigatório.");
        if (!/^\d{16}$/.test(numero)) erros.push("O número do cartão deve ter 16 dígitos.");

        if (!/^\d{2}\/\d{2}$/.test(validade)) {
            erros.push("A validade deve estar no formato MM/AA.");
        } else {
            const [mes, ano] = validade.split("/").map(Number);
            const dataAtual = new Date();
            const anoAtual = parseInt(dataAtual.getFullYear().toString().slice(-2));
            const mesAtual = dataAtual.getMonth() + 1;

            if (mes < 1 || mes > 12 || ano < anoAtual || (ano === anoAtual && mes < mesAtual)) {
                erros.push("A validade do cartão está vencida.");
            }
        }

        if (!/^\d{3,4}$/.test(cvv)) erros.push("O CVV deve ter 3 ou 4 dígitos.");

        if (erros.length > 0) {
            e.preventDefault();
            alert("Erros encontrados:\n\n" + erros.join("\n"));
        }
    }
});
</script>

</body>
</html>
