<?php
session_start();
require_once 'listar/conexao.php'; // ou o caminho correto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodo = $_POST['metodo_pagamento'] ?? '';

    if ($metodo === 'cartao') {
    $nome = trim($_POST['nome_titular'] ?? '');
    $numero = preg_replace('/\D/', '', $_POST['numero_cartao'] ?? '');
    $validade = trim($_POST['validade'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');

    $erros = [];

    if (empty($nome)) $erros[] = "Nome do titular é obrigatório.";

    if (!preg_match('/^\d{16}$/', $numero)) $erros[] = "Número do cartão inválido.";

    if (!preg_match('/^\d{2}\/\d{2}$/', $validade)) {
        $erros[] = "Formato da validade inválido (use MM/AA).";
    } else {
        [$mes, $ano] = explode('/', $validade);
        $mes = (int)$mes;
        $ano = (int)$ano + 2000;
        $agora = new DateTime();
        $validadeData = DateTime::createFromFormat('Y-m', "$ano-$mes");

        if ($mes < 1 || $mes > 12 || $validadeData < $agora) {
            $erros[] = "Data de validade expirada.";
        }
    }

    if (!preg_match('/^\d{3,4}$/', $cvv)) $erros[] = "CVV inválido.";

    if (!empty($erros)) {
        echo "<h3>Erros no pagamento:</h3><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul><a href='javascript:history.back()'>Voltar</a>";
        exit;
    }
}


    // Aqui entra o switch
 switch ($metodo) {
    case 'cartao':
        $pagamento_aprovado = true;
        break;

    case 'pix':
        $chave = $_POST['chave_pix'] ?? '';

        // Se a chave estiver correta, aprova
        if ($chave === '00020126450014BR.GOV.BCB.PIX0123chave pix alphanumerica5204000053039865802BR5911Dona Lurdes6008Loada-PR62070503***6304EFBC') {
            $pagamento_aprovado = true;
        } else {
            $pagamento_aprovado = false;
        }
        break;

    case 'presencial':
        // Pagamento será feito na entrega é "pendente"
        $pagamento_aprovado = true; 
        break;

    case 'mercado_pago':
        // Redireciona para o gateway Mercado Pago
        require 'pagamento_mercadopago.php';
        exit;

    default:
        echo "Método de pagamento inválido.";
        exit;
}

$usuario_id = $_SESSION['usuario_id'] ?? null;
$data_pedido = date('Y-m-d H:i:s');
$status = ($metodo === 'presencial') ? 'pendente' : 'aprovado';
$metodo_pagamento = $metodo;
$total = 0;

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Carrinho vazio.";
    exit;
}

foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['preco'] * $item['quantidade'];
}

$stmt = $conexao->prepare("INSERT INTO pedidos (usuario_id, data_pedido, total, status, metodo_pagamento) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isdss", $usuario_id, $data_pedido, $total, $status, $metodo_pagamento);
$stmt->execute();
$pedido_id = $stmt->insert_id;
$stmt->close();

foreach ($_SESSION['carrinho'] as $item) {
    //depois eu resolvo
    $produto_id = $item['produto_id'] ?? $item['id'] ?? null;
    $quantidade = $item['quantidade'];
    $preco = floatval(str_replace(',', '.', $item['preco']));

    $stmt = $conexao->prepare("INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $pedido_id, $produto_id, $quantidade, $preco_unitario);
    $stmt->execute();
    $stmt->close();
}

// 4. Limpa o carrinho
unset($_SESSION['carrinho']);
echo "Pagamento aprovado? ";
var_dump($pagamento_aprovado);

$endereco = trim($_POST['endereco'] ?? '');

if (!empty($usuario_id) && !empty($endereco)) {
    $stmt = $conexao->prepare("UPDATE usuarios SET endereco = ? WHERE id = ?");
    $stmt->bind_param("si", $endereco, $usuario_id);
    $stmt->execute();
    $stmt->close();
}}

echo "<script>console.log('Pagamento aprovado? " . ($pagamento_aprovado ? "sim" : "não") . "');</script>";
if ($pagamento_aprovado) {
    header("Location: listar/sucesso.php");
    exit;
} else {
    header("Location: listar/falha.php");
    exit;
}
?>
