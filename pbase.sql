CREATE TABLE produtos (
  id_prod INT(9) AUTO_INCREMENT PRIMARY KEY,
  nome_prod VARCHAR(30) NOT NULL,
  setor_prod INT(9),
  custo_prod FLOAT(10) NOT NULL,
  venda_prod FLOAT(10) NOT NULL,
  estoque_prod INT(5) NOT NULL,
  situacao_prod INT(1) DEFAULT 1, -- 1 para ativo, 0 para inativo
  FOREIGN KEY (setor_prod) REFERENCES setores(id_set)
);
