/* La base de datos se llamará web_tienda_friki. Se crearán 5 tablas. */

create database if not exists web_tienda_friki
character set utf8mb4 collate utf8mb4_spanish_ci;

use web_tienda_friki;


/* DESACTIVA TEMPORALMENTE LAS COMPROBACIONES DE CLAVES AJENAS */
set foreign_key_checks = 0;
/* ELIMINA LAS TABLAS SI EXISTIESEN PARA LUEGO CONSTRUIRLAS DESDE 0 */
drop table if exists consultas;
drop table if exists productos;
drop table if exists estados_producto;
drop table if exists editoriales;
drop table if exists categorias;
/* VUELVE A ACTIVAR LAS COMPROBACIONES DE CLAVES AJENAS */
set foreign_key_checks = 1;

/* CREACIÓN DE TABLAS */
create table categorias (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    descripcion varchar(255)
);

create table editoriales (
    id int auto_increment primary key,
    nombre varchar(100) not null,
    pais varchar(60),
    web varchar(150),
    tipo varchar(60)
);

create table estados_producto (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    descripcion varchar(255)
);

create table productos (
    id int auto_increment primary key,
    nombre varchar(120) not null,
    descripcion text,
    precio decimal(8, 2) not null,
    stock int not null default 0,
    imagen varchar(150),
    destacado tinyint(1) not null default 0,
    categoria_id int not null,
    editorial_id int not null,
    estado_id int not null,
    foreign key (categoria_id) references categorias(id),
    foreign key (editorial_id) references editoriales(id),
    foreign key (estado_id) references estados_producto(id)
);

create table consultas (
    id int auto_increment primary key,
    nombre_cliente varchar(100) not null,
    email varchar(120) not null,
    producto_id int null,
    mensaje text not null,
    fecha datetime not null default current_timestamp,
    foreign key (producto_id) references productos(id)
    /* SI EN LA TABLA PRODUCTOS SE BORRA EL ID DE UNO QUE ESTÁ EN CONSULTAS, SE DEJA EL VALOR DE PRODUCTO_ID EN NULL */
    on delete set null
);