<?php
// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'produtos');

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recuperar dados do formulário
$nome_prod = $_POST['nome_prod'];
$setor_prod = $_POST['setor_prod'];
$custo_prod = $_POST['custo_prod'];
$venda_prod = $_POST['venda_prod'];
$estoque_prod = $_POST['estoque_prod'];

// Inserir produto na tabela
$sql = "INSERT INTO produtos (nome_prod, setor_prod, custo_prod, venda_prod, estoque_prod)
        VALUES ('$nome_prod', '$setor_prod', '$custo_prod', '$venda_prod', '$estoque_prod')";

if ($conn->query($sql) === TRUE) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: produtos.php");
exit();
?>
