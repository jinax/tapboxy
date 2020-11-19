CREATE DATABASE IF NOT EXISTS tapboxydb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE TABLE Usuarios(
    UsuarioID int NOT NULL AUTO_INCREMENT,
    Nombre varchar(255) NOT NULL UNIQUE,
    Email varchar(255) NOT NULL,
    Contrasena varchar(255) NOT NULL,
    Rol varchar(10) DEFAULT 'Usuario',
    CONSTRAINT PK_UsuarioID PRIMARY KEY (UsuarioID)
);

CREATE TABLE Cajas(
    CajaID int NOT NULL AUTO_INCREMENT,
    UsuarioID int NOT NULL,
    CajaNombre varchar(255) NOT NULL UNIQUE,
    Etiqueta varchar(255),
    Tipo varchar(10) DEFAULT 'Privada',
    CONSTRAINT PK_CajaID PRIMARY KEY (CajaID),
    CONSTRAINT FK_CajaUsuario FOREIGN KEY (UsuarioID) 
        REFERENCES Usuarios(UsuarioID) 
        ON DELETE CASCADE
);

CREATE TABLE Audios(
    AudioID int NOT NULL AUTO_INCREMENT,
    CajaID int,
    AudioNombre varchar(255) NOT NULL UNIQUE,
    Direccion varchar(255) NOT NULL,
    CONSTRAINT PK_AudioID PRIMARY KEY (AudioID),
    CONSTRAINT FK_AudioCaja FOREIGN KEY (CajaID) 
        REFERENCES Cajas(CajaID)
        ON DELETE CASCADE
);

