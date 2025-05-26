<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'projeto_dona_lurdes';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
<?php
$host = 'localhost';
$dbname = 'projeto_dona_lurdes';
$user = 'root';
$pass = ''; // ou sua senha, se tiver

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>