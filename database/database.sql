
CREATE DATABASE tienda_videojuegos;
USE tienda_videojuegos;


CREATE TABLE usuarios
(
	id int(255) auto_increment not null,
	nombre varchar (100) not null,
	apellidos varchar (255),
	email varchar (255)unique not null,
	password varchar(255) not null,
	rol varchar(20),
	imagen varchar(255)
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email),
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', null);

CREATE TABLE categorias(
id              int(255) auto_increment not null,
nombre          varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

Insert into categorias values(null,'Supervivencia');
Insert into categorias values(null,'Aventura');
Insert into categorias values(null,'Sandbox');
Insert into categorias values(null,'Crafting');

CREATE TABLE juegos
(
	id int(255) auto_increment not null,
	categoria_id int not null,
	nombre varchar(100) not null,
	descripcion text,
	precio float(100,2) not null,
	oferta varchar (2),
	fecha date not null,
	imagen varchar (255),
CONSTRAINT pk_categorias PRIMARY KEY(id),
CONSTRAINT fk_juegos_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;


CREATE TABLE pedidos
(
	id int(255) auto_increment not null,
	usuario_id int(255) not null,	
	coste float(200,2) not null,
	pais varchar (40) not null,
	estado varchar (20) not null,
	status varchar (255),
	fecha date,
	hora time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_pedidos
(
	id int(255) auto_increment not null,
	pedido_id int not null,	
	juegos_id int not null,
	unidades int(255) not null,
CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_linea_juegos FOREIGN KEY(juegos_id) REFERENCES juegos(id)
)ENGINE=InnoDb;
