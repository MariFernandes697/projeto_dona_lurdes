<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "projeto_dona_lurdes");

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta os produtos
echo " ";

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

// Exibe os produtos
if ($result->num_rows > 0) {
    echo '<div class="container-produtos">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card-produto">';
        echo '<img src="' . $row["imagem"] . '" alt="' . $row["nome"] . '">';
        echo '<h3>' . $row["nome"] . '</h3>';
        echo '<p>' . $row["descricao"] . '</p>';
        echo '<p><strong>R$ ' . number_format($row["preco"], 2, ',', '.') . '</strong></p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>Nenhum produto encontrado.</p>';
}

$conn->close();
?>
