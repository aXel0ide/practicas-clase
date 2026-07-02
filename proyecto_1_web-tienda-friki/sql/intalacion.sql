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

/* INSERTAR DATOS INICIALES OBLIGATORIOS */
insert into categorias (nombre, descripcion) values
('Comic', 'Comics europeos, españoles y americanos.'),
('Manga', 'Manga y novelas gráficas japonesas.'),
('Figura', 'Figura y coleccionismo'),
('Pelicula', 'Películas en DVD, Blue-Ray o formato similar.'),
('Serie', 'Series de televisión relacionadas con la cultura friki.'),
('Videojuego', 'Videojuegos basados en cómics, cine o personajes'),
('Merchandaising', 'Camisetas, tazas, pósters y otros productos.');

insert into estados_producto (nombre, descripcion) values
('Nuevo', 'Producto nuevo.'),
('Usado', 'Producto de segunda mano en buen estado.'),
('Reserva', 'Producto disponible para reservar.'),
('Descatalogado', 'Producto no disponible actualmente.');

insert into editoriales (nombre, pais, web, tipo) values
('ECC Ediciones', 'España', 'https://www.eccediciones.com', 'Editorial'),
('Panini Comics', 'Italia', 'https://www.panini.es', 'Editorial'),
('Norma Editorial', 'España', 'https://www.normaeditorial.com', 'Editorial'),
('Hasbro', 'Estados Unidos', 'https://shop.hasbro.com', 'Fabricante'),
('Warner Bros', 'Estados Unidos', 'https://www.warnerbros.com', 'Distribuidora'),
('Microids', 'Francia', 'https://microids.com', 'Videojuegos');

insert into productos (nombre, descripcion, precio, stock, imagen, destacado, categoria_id, editorial_id, estado_id) values
('Batman: Año Uno', 'Comic de Batman recomendado para empezar con el personaje.', 16.95, 8, 'batman_anio_uno.jpg', 1, 1, 1, 1),
('Astérix el Galo', 'Aventura clásica de Astérix y Obélix.', 12.95, 10, 'asterix_galo.jpg', 1, 1, 3, 1),
('Blacksad Integral', 'Edición integral de la serie Blacksad', 34.95, 5, 'blacksad_integral.jpg', 1, 1, 3, 1),
('Figura Spider-Man', 'Figura articulada de Spider-Man para coleccionistas.', 24.95, 6, 'figura_spiderman.jpg', 1, 3, 4, 1),
('V de Vendetta Blue-Ray', 'Película basada en la novela gráfica V de Vendetta.', 9.95, 4, 'v_vendetta.jpg', 0, 4, 5, 2),
('The Walking Dead Temporada 1', 'Primera temporada de la serie en formato físico.', 14.95, 7, 'walking_dead_t1.jpg', 0, 5, 5, 1),
('Blacksad: Under the Skin', 'Videojuego de investigación basado en Blacksad.', 19.95, 7, 'blacksad_juego.jpg', 0, 6, 6, 1),
('Camiseta Superlópez', 'Camiseta inspirada en el personaje Superlópez.', 11.95, 12, 'camiseta_superlopez.jpg', 0, 7, 2, 1);
