CREATE TABLE setores (
  id_set INT(9) AUTO_INCREMENT PRIMARY KEY,
  nome_set VARCHAR(20) NOT NULL
);

-- Inserir dados diretamente na tabela de setores
INSERT INTO setores (nome_set) VALUES 
('Alimentos'),
('Bebidas'),
('Limpeza'),
('Eletrônicos');
