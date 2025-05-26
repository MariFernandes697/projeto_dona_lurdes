<?php require_once('includes/header-produtos.php')?>

        <!--Destaque-Produtos-->
        <div class="corpo_categorias">

            <div class="linha linha2">
                <h2>Todos os Produtos</h2>
                <select name = "" id="">
                    <option value="">Mais comprados</option>
                    <option value="">Maior preço</option>
                    <option value="">Menor preço</option>
                </select>
            </div>

<?php
// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "projeto_dona_lurdes");

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta os produtos


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
        echo '<a class="botao-vermais" href="ver-produto.php?id=' . $row['id'] . '">Ver mais</a>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>Nenhum produto encontrado.</p>';
}

$conn->close();
?>

            

<?php require_once('includes/footer.php')?>