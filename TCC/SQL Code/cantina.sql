create database cantina;
use cantina;

-- Criação da tabela produtos
CREATE TABLE tblProdutos (
    idProduto INT AUTO_INCREMENT PRIMARY KEY,
    nomeProduto VARCHAR(255) NOT NULL,
    descricaoProduto varchar(500),
    precoProduto DECIMAL(10,2) NOT NULL,
    quantidadeProduto INT NOT NULL
);

-- Criação da tabela tblUsuario	 	
CREATE TABLE tblUsuario(	
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nomeUsuario VARCHAR(150) NOT NULL,
    sobrenomeUsuario VARCHAR(150) NOT NULL,
    emailUsuario VARCHAR(200) NOT NULL,
    senhaUsuario VARCHAR(150) NOT NULL,
    dataUsuario DATETIME NOT NULL
);

-- Criação da tabela tblDadosCompra
CREATE TABLE tblDadosCompra (
    idCompra INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomeCompra VARCHAR(30) NOT NULL,
    dataCompra DATE NOT NULL,
    horarioCompra TIME NOT NULL,
    precoCompra DOUBLE NOT NULL,
    vencimentoCompra DATE NOT NULL,
    idUsuario INT NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES tblUsuario(idUsuario)
);

-- Criação da tabela tblDadosCompraProdutos
CREATE TABLE tblDadosCompraProdutos (
    idDetalheCompra INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    idCompra INT NOT NULL,
    idProduto INT NOT NULL,
    quantidadeComprada INT NOT NULL,
    FOREIGN KEY (idCompra) REFERENCES tblDadosCompra(idCompra),
    FOREIGN KEY (idProduto) REFERENCES tblProdutos(idProduto)
);	


select*from tblUsuario;

select*from tblDadosCompra;

drop database cantina;