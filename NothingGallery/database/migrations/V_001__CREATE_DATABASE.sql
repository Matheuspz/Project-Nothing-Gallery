CREATE TABLE IF NOT EXISTS Categoria(
    idCategoria INT UNIQUE NOT NULL AUTO_INCREMENT,
    nome        VARCHAR(255) UNIQUE,
    CONSTRAINT  PK_Categoria PRIMARY KEY(idCategoria)
);

CREATE TABLE IF NOT EXISTS Quadros(
    idQuadros       INT UNIQUE NOT NULL AUTO_INCREMENT,
    idCategoria     INT NOT NULL,
    nome            VARCHAR(255) UNIQUE,
    descricao       VARCHAR(255),
    preco           DECIMAL(10,2),
    imagemDiretorio VARCHAR(255) UNIQUE,
    CONSTRAINT      PK_Quadros PRIMARY KEY(idQuadros),
    CONSTRAINT      FK_Categoria_Quadros FOREIGN KEY(idCategoria) REFERENCES Categoria(idCategoria)
);

CREATE TABLE IF NOT EXISTS TipoUsuario(
    idTipoUsuario INT UNIQUE NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(255) UNIQUE,
    CONSTRAINT    PK_TipoUsuario PRIMARY KEY(idTipoUsuario)
);

CREATE TABLE IF NOT EXISTS Usuario(
    idUsuario     INT UNIQUE NOT NULL AUTO_INCREMENT,
    idTipoUsuario INT NOT NULL,
    nome          VARCHAR(255),
    sobrenome     VARCHAR(255),
    email         VARCHAR(255) UNIQUE,
    senha         VARCHAR(255),
    CONSTRAINT    PK_Usuario PRIMARY KEY(idUsuario),
    CONSTRAINT    FK_TipoUsuario_Usuario FOREIGN KEY(idTipoUsuario) REFERENCES TipoUsuario(idTipoUsuario)
);

CREATE TABLE IF NOT EXISTS Vendas(
    idVendas   INT UNIQUE NOT NULL AUTO_INCREMENT,
    idUsuario  INT NOT NULL,
    data       DATE NOT NULL,
    precoTotal DECIMAL(10,2),
    CONSTRAINT PK_Vendas PRIMARY KEY(idVendas),
    CONSTRAINT FK_Usuario_Vendas FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE IF NOT EXISTS Vendas_Quadros(
    idVendas INT NOT NULL,
    idQuadro INT NOT NULL,
    quantidade INT NOT NULL,
    precoUnitario DECIMAL(10,2) NOT NULL,
    CONSTRAINT PK_Vendas_Quadros PRIMARY KEY(idVendas,idQuadro),
    CONSTRAINT FK_Vendas_Vendas_Quadros FOREIGN KEY(idVendas) REFERENCES Vendas(idVendas),
    CONSTRAINT FK_Quadros_Vendas_Quadros FOREIGN KEY(idQuadro) REFERENCES Quadros(idQuadros)
)









