<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #e6e6e6;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #333;
        }
        th, td {
            padding: 12px;
            border: 1px solid #b300b3;
            text-align: center;
        }
        th {
            background-color: #b300b3;
            color: white;
        }
        a {
            color: #b300b3;
            text-decoration: none;
        }
        a:hover {
            color: #800080;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center; color: #b300b3;">Lista de Produtos</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Setor</th>
            <th>Custo</th>
            <th>Venda</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
        <?php
        // Conexão com o banco de dados
        $conn = new mysqli('localhost', 'root', '', 'produtos');
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta os produtos
        $sql = "SELECT p.id_prod, p.nome_prod, s.nome_set, p.custo_prod, p.venda_prod, p.estoque_prod
                FROM produtos p
                INNER JOIN setores s ON p.setor_prod = s.id_set";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nome_prod'] . "</td>";
                echo "<td>" . $row['nome_set'] . "</td>";
                echo "<td>" . $row['custo_prod'] . "</td>";
                echo "<td>" . $row['venda_prod'] . "</td>";
                echo "<td>" . $row['estoque_prod'] . "</td>";
                echo "<td><a href='excluir_produto.php?id=" . $row['id_prod'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este produto?\")'>Excluir</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
