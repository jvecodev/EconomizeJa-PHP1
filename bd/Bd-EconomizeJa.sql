DROP DATABASE BDPROJETO2;
CREATE DATABASE BDPROJETO2; 
USE BDPROJETO2; 

 
CREATE TABLE Usuario ( 

    ID_Usuario INT PRIMARY KEY, 

    Nome VARCHAR(50), 

    Email VARCHAR(100), 

    Senha VARCHAR(100), 

    CPF VARCHAR(11), 

    Telefone VARCHAR(11), 

    Tipo VARCHAR(50), 

    CEP VARCHAR(30), 

    Bairro VARCHAR(50), 

    Logradouro VARCHAR(50), 

    fk_Cidade_ID_Cidade INT 

); 

 

CREATE TABLE Estabelecimento ( 

    ID_Estabelecimento INT PRIMARY KEY, 

    CNPJ CHAR(14), 

    Nome_Empresa VARCHAR(100), 

    Email VARCHAR(100), 

    Senha VARCHAR(100), 

    Telefone CHAR(11), 

    CEP VARCHAR(30), 

    Bairro VARCHAR(30), 

    Logradouro VARCHAR(30), 

    fk_Cidade_ID_Cidade INT 

); 

 
CREATE TABLE Produtos ( 

    ID_Produtos INT auto_increment PRIMARY KEY, 

    Nicho VARCHAR(20), 

    Nome VARCHAR(50), 

    Descricao VARCHAR(150), 

    Preco DECIMAL(10,2) 

); 

CREATE TABLE Pedido ( 
    ID_Pedido INT AUTO_INCREMENT PRIMARY KEY, 
    fk_Produto_ID_Produto INT, 
    Data DATE 
);
 

CREATE TABLE Produtos_Pedidos ( 

    ID_Produtos_Pedidos INT auto_increment KEY, 

    Quantidade INT, 

    Dt_Fabricacao DATE, 

    Dt_Validade DATE, 

    fk_Produtos_ID_Produtos INT, 

    fk_Pedido_ID_Pedido INT 

); 

 

CREATE TABLE Pagamento ( 

    ID_Pagamento INT PRIMARY KEY, 

    Metodo VARCHAR(20), 

    Status VARCHAR(30), 

    Dt_Pagamento DATE 

); 

 

CREATE TABLE Nicho ( 

    Descricao VARCHAR(150), 

    ID_Nicho INT PRIMARY KEY 

); 

 

CREATE TABLE Nicho_Produto ( 

    ID_NichoProduto INT PRIMARY KEY, 

    fk_Produtos_ID_Produtos INT, 

    fk_Nicho_ID_Nicho INT 

); 

 

CREATE TABLE Estabelecimento_Produto ( 

    ID_EstabelecimentoProduto INT PRIMARY KEY, 

    fk_Estabelecimento_ID_Estabelecimento INT, 

    fk_Produtos_ID_Produtos INT 

); 

 

CREATE TABLE Cidade ( 

    Nome VARCHAR(70), 

    Estado VARCHAR(50), 

    ID_Cidade INT PRIMARY KEY 

); 

  

ALTER TABLE Usuario ADD CONSTRAINT FK_Usuario_2 

    FOREIGN KEY (fk_Cidade_ID_Cidade) 

    REFERENCES Cidade (ID_Cidade) 

    ON DELETE RESTRICT; 

  

ALTER TABLE Estabelecimento ADD CONSTRAINT FK_Estabelecimento_2 

    FOREIGN KEY (fk_Cidade_ID_Cidade) 

    REFERENCES Cidade (ID_Cidade) 

    ON DELETE RESTRICT; 

  

ALTER TABLE Produtos_Pedidos ADD CONSTRAINT FK_Produtos_Pedidos_3 

    FOREIGN KEY (fk_Pedido_ID_Pedido) 

    REFERENCES Pedido (ID_Pedido); 

  

ALTER TABLE Nicho_Produto ADD CONSTRAINT FK_Nicho_Produto_2 

    FOREIGN KEY (fk_Produtos_ID_Produtos) 

    REFERENCES Produtos (ID_Produtos); 

  

ALTER TABLE Nicho_Produto ADD CONSTRAINT FK_Nicho_Produto_3 

    FOREIGN KEY (fk_Nicho_ID_Nicho) 

    REFERENCES Nicho (ID_Nicho); 

  

ALTER TABLE Estabelecimento_Produto ADD CONSTRAINT FK_Estabelecimento_Produto_2 

    FOREIGN KEY (fk_Estabelecimento_ID_Estabelecimento) 

    REFERENCES Estabelecimento (ID_Estabelecimento); 

  

ALTER TABLE Estabelecimento_Produto ADD CONSTRAINT FK_Estabelecimento_Produto_3 

    FOREIGN KEY (fk_Produtos_ID_Produtos) 

    REFERENCES Produtos (ID_Produtos);
    
