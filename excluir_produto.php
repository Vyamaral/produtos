<?php

$conn = new mysqli('localhost', 'root', '', 'produtos');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id_prod = intval($_GET['id']);


    $sql = "DELETE FROM produtos WHERE id_prod = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_prod);

    
        if ($stmt->execute()) {
            echo "<script>alert('Produto excluído com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao excluir o produto.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Erro ao preparar a exclusão.');</script>";
    }
} else {
    echo "<script>alert('ID do produto não especificado.');</script>";
}
$conn->close();
echo "<script>window.location.href = 'produtos.php';</script>";
?>
