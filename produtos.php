<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Produtos</title>
  <style>
    body {
      background-color: #1a1a1a; /* Fundo preto */
      color: #e6e6e6; /* Texto claro */
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    h2 {
      color: #b300b3; /* Roxo */
      text-align: center;
      padding: 20px 0;
    }
    form {
      background-color: #333;
      padding: 20px;
      border-radius: 10px;
      max-width: 400px;
      margin: 20px auto;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    }
    input[type="text"], input[type="number"], select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #b300b3; /* Borda roxa */
      background-color: #262626; /* Caixa de texto preto */
      color: #e6e6e6; /* Texto claro */
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #b300b3; /* Botão roxo */
      border: none;
      border-radius: 5px;
      color: #fff; /* Texto branco */
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
      background-color: #800080; /* Roxo mais escuro ao passar o mouse */
    }
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #333; /* Fundo preto para a tabela */
      color: #e6e6e6; /* Texto claro */
    }
    th, td {
      padding: 12px;
      border: 1px solid #b300b3; /* Bordas roxas */
      text-align: center;
    }
    th {
      background-color: #b300b3; /* Cabeçalhos roxos */
      color: white;
    }
    a {
      color: #b300b3;
      text-decoration: none;
    }
    a:hover {
      color: #800080; /* Roxo mais escuro */
    }
    .container {
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Cadastrar Produto</h2>
    <form method="POST" action="saveproduto.php">
      Nome do Produto: <input type="text" name="nome_prod" required><br><br>
      
      Setor do Produto:
      <select name="setor_prod" required>
        <?php
        // Conexão com o banco de dados
        $conn = new mysqli('localhost', 'root', '', 'produtos');
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
        
        // Consultar setores
        $sql = "SELECT id_set, nome_set FROM setores";
        $result = $conn->query($sql);
        
        // Preencher a caixa de seleção com setores
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_set'] . "'>" . $row['nome_set'] . "</option>";
            }
        }
        ?>
      </select><br><br>
      
      Preço de Custo: <input type="text" name="custo_prod" required><br><br>
      Preço de Venda: <input type="text" name="venda_prod" required><br><br>
      Estoque: <input type="number" name="estoque_prod" required><br><br>
      
      <input type="submit" value="Salvar Produto">
    </form>

    <h2>Lista de Produtos</h2>
    <table border="1">
      <tr>
        <th>Nome</th>
        <th>Setor</th>
        <th>Custo</th>
        <th>Venda</th>
        <th>Estoque</th>
        <th>Ações</th>
      </tr>
      <?php
      $sql = "SELECT p.id_prod, p.nome_prod, s.nome_set, p.custo_prod, p.venda_prod, p.estoque_prod
              FROM produtos p
              INNER JOIN setores s ON p.setor_prod = s.id_set";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['nome_prod'] . "</td>";
              echo "<td>" . $row['nome_set'] . "</td>";
              echo "<td>" . $row['custo_prod'] . "</td>";
              echo "<td>" . $row['venda_prod'] . "</td>";
              echo "<td>" . $row['estoque_prod'] . "</td>";
              echo "<td><a href='excluir_produto.php?id=" . $row['id_prod'] . "'>Excluir</a></td>";
              echo "</tr>";
          }
      }
      $conn->close();
      ?>
    </table>
  </div>
</body>
</html>
