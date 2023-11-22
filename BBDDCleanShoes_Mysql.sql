-- Active: 1699163173889@@localhost@3306

CREATE DATABASE CleanShoes DEFAULT CHARACTER SET = 'utf8mb4';

USE CleanShoes;

CREATE TABLE
    Usuario(
        id_Usuario int AUTO_INCREMENT not null primary key,
        usuario varchar(20) not null,
        password varchar(20) not null,
        rol varchar(50),
        estado varchar(20) not null,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE
    Persona(
        id_Persona int AUTO_INCREMENT not null primary key,
        nombres varchar(50) not null,
        apellidos varchar(50) not null,
        dni varchar(12) not null,
        correo varchar(50) not null,
        celular varchar(15) not null,
        fecha_nac date not null
    );

CREATE TABLE
    Cliente(
        id_Cliente int AUTO_INCREMENT not null primary key,
        id_Persona int not null,
        id_Usuario int not null,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
        foreign key (id_Persona) references Persona(id_Persona),
        foreign key (id_Usuario) references Usuario(id_Usuario)
    );

CREATE TABLE
    Direccion_Envio(
        id_Direccion_Envio int AUTO_INCREMENT not null primary key,
        id_Cliente int not null,
        departamente varchar(50) not null,
        provincia varchar(50) not null,
        distrito varchar(50) not null,
        direccion varchar(100) not null,
        referencia varchar(100),
        estado varchar(20),
        foreign key (id_Cliente) references Cliente(id_Cliente)
    );

CREATE TABLE
    Trabajador(
        id_Trabajador int AUTO_INCREMENT not null primary key,
        id_Persona int not null,
        id_Usuario int not null,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
        estado varchar(20),
        foreign key (id_Persona) references Persona(id_Persona),
        foreign key (id_Usuario) references Usuario(id_Usuario)
    );

CREATE TABLE
    Servicio(
        id_Servicio int AUTO_INCREMENT not null primary key,
        nombre varchar(50),
        precio float,
        descripcion varchar(50),
        tiempo_estimado_entrega int,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
        estado varchar(20)
    );

CREATE TABLE
    Orden(
        id_Orden int AUTO_INCREMENT not null primary key,
        id_Cliente int not null,
        total float,
        tipoDespacho varchar(50),
        tipoPago varchar(50),
        tiempoTotalEntrega int,
        estado_pago varchar(20),
        /*POR DEFECTO NO*/
        estado_orden varchar(20),
        /*POR DEFECTO NO*/
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
        fecha_actualización date,
        foreign key (id_Cliente) references Cliente(id_Cliente)
    );

CREATE TABLE
    Detalle_Servicio(
        id_DetalleServicio int AUTO_INCREMENT not null primary key,
        id_Servicio int not null,
        id_Orden int not null,
        cantidad int not null,
        subTotal float,
        foreign key (id_Servicio) references Servicio(id_Servicio),
        foreign key (id_Orden) references Orden (id_Orden)
    );

CREATE TABLE
    Boleta(
        id_Boleta int AUTO_INCREMENT not null primary key,
        id_Orden int not null,
        igv float,
        total float,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
        estado varchar(50),
        foreign key (id_Orden) references Orden(id_Orden)
    );