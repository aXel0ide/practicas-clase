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

/* AMPLIACIÓN DE VIDEOJUEGOS */

create table plataformas_videojuego(
    id int auto_increment primary key,
    nombre varchar(80) not null,
    descripcion varchar(255)
);

create table generos_videojuego(
    id int auto_increment primary key,
    nombre varchar(80) not null,
    descripcion varchar(255)
);

create table videojuegos(
    producto_id int primary key,
    plataforma_id int not null,
    genero_id int not null,
    pegi int,
    desarrolladora varchar(100),
    anio_lanzamiento year,
    formato varchar(60),
    multijugador tinyint(1) default 0,
    foreign key (producto_id) references productos(id) on delete cascade,
    foreign key (plataforma_id) references plataformas_videojuego(id),
    foreign key (genero_id) references generos_videojuego(id)
);

create table novedades(
    id int auto_increment primary key,
    producto_id int null,
    titulo varchar(120) not null,
    subtitulo varchar(255),
    imagen_banner varchar(150),
    texto_boton varchar(60) default 'Ver producto',
    activo tinyint(1) default 1,
    orden int default 0,
    fecha_inicio datetime,
    foreign key (producto_id) references productos(id) on delete set null
);

/* DATOS INICIALES PARA VIDEOJUEGOS */

insert into plataformas_videojuego(nombre, descripcion) values
('PC', 'Ordenador personal'),
('Nintendo Switch', 'Consola híbrida de Nintendo'),
('PlayStation 5', 'Consola de Sony'),
('Xbox Series', 'Consola de Microsoft'),
('Retro', 'Consolas clásicas y recopilatorios');

insert into generos_videojuego(nombre, descripcion) values
('Aventura', 'Juegos de exploración e historia'),
('Acción', 'Juegos centrados en combates o reflejos'),
('RPG', 'Juegos de rol y progresión de personaje'),
('Plataformas', 'Juegos de saltos y niveles'),
('Estrategia', 'Juegos de planificación y gestión');

/* GÉNEROS ADICIONALES NECESARIOS */
insert into generos_videojuego(nombre, descripcion) values
('Lucha', 'Juegos centrados en combates entre personajes'),
('Supervivencia', 'Juegos de supervivencia, construcción y gestión de recursos');

/* NUEVAS EDITORIALES PARA LOS VIDEOJUEGOS */
insert into editoriales (nombre, pais, web, tipo) values
('CD Projekt', 'Polonia', 'https://www.cdprojekt.com', 'Videojuegos'),
('Newnight', 'Canadá', 'https://endnightgames.com', 'Videojuegos'),
('Nintendo', 'Japón', 'https://www.nintendo.com', 'Videojuegos');

/* NUEVAS EDITORIALES */
insert into editoriales(nombre, pais, web, tipo) values
('Sony Interactive Entertainment', 'Estados Unidos', 'https://www.playstation.com', 'Videojuegos'),
('Xbox Game Studios', 'Estados Unidos', 'https://www.xbox.com', 'Videojuegos');

/* PARA EVITAR DEPENDER DE NÚMEROS DE ID ESCRITOS A MANO, SE USAN VARIABLES SQL QUE BUSCAN LOS ID POR NOMBRE */

/* VARIABLES DE CATEGORÍA Y ESTADO */
set @cat_videojuego = (select id from categorias where nombre = 'Videojuego' limit 1);
set @estado_nuevo = (select id from estados_producto where nombre = 'Nuevo' limit 1);
set @estado_usado = (select id from estados_producto where nombre = 'Usado' limit 1);

/* VARIABLES DE EDITORIALES */
set @edit_cd_projekt = (select id from editoriales where nombre = 'CD Projekt' limit 1);
set @edit_newnight = (select id from editoriales where nombre = 'Newnight' limit 1);
set @edit_nintendo = (select id from editoriales where nombre = 'Nintendo' limit 1);

/* OBTENER NUEVAS EDITORIALES */
set @edit_sony = (select id from editoriales where nombre = 'Sony Interactive Entertainment' limit 1);
set @edit_xbox = (select id from editoriales where nombre = 'Xbox Game Studios' limit 1);
set @edit_nintendo = (select id from editoriales where nombre = 'Nintendo' limit 1);

/* VARIABLES DE PLATAFORMAS */
set @plat_pc = (select id from plataformas_videojuego where nombre = 'PC' limit 1);
set @plat_switch = (select id from plataformas_videojuego where nombre = 'Nintendo Switch' limit 1);

/* OBTENER LOS ID DE LAS PLATAFORMAS */
set @plat_ps5 = (select id from plataformas_videojuego where nombre = 'PlayStation 5' limit 1);
set @plat_xbox = (select id from plataformas_videojuego where nombre = 'Xbox Series' limit 1);
set @plat_retro = (select id from plataformas_videojuego where nombre = 'Retro' limit 1);

/* VARIABLES DE GÉNEROS */
set @genero_rpg = (select id from generos_videojuego where nombre = 'RPG' limit 1);
set @genero_aventura = ( select id from generos_videojuego where nombre = 'Aventura' limit 1);
set @genero_lucha = ( select id from generos_videojuego where nombre = 'Lucha' limit 1);
set @genero_supervivencia = ( select id from generos_videojuego where nombre = 'Supervivencia' limit 1);

/* OBTENER LOS ID DE LOS GÉNEROS NO UTILIZADOS */
set @genero_plataformas = (select id from generos_videojuego where nombre = 'Plataformas' limit 1);
set @genero_accion = (select id from generos_videojuego where nombre = 'Acción' limit 1);
set @genero_estrategia = (select id from generos_videojuego where nombre = 'Estrategia' limit 1);

/* INSERTAR LOS PRODUCTOS */

insert into productos(nombre, descripcion, precio, stock, imagen, destacado, categoria_id, editorial_id, estado_id) values
('Cyberpunk 2077', 'RPG de mundo abierto ambientado en la futurista Night City.', 29.99, 12, 'cyberpunk_2077.jpg', 1, @cat_videojuego, @edit_cd_projekt, @estado_nuevo),
('Sons of the Forest', 'Juego de supervivencia y terror en una isla llena de caníbales.', 10.87, 7, 'sons_forest.jpg', 1, @cat_videojuego, @edit_newnight, @estado_nuevo),
('Super Smash Bros. Ultimate', 'Juego de lucha protagonizado por personajes de numerosas sagas.', 45.99, 5, 'smash_bros_ultimate.jpg', 0, @cat_videojuego, @edit_nintendo, @estado_nuevo),
('The Legend of Zelda: Tears of the Kingdom', 'Aventura de mundo abierto por los cielos y las tierras de Hyrule.', 59.99, 8, 'legend_zelda_tears.jpg', 1, @cat_videojuego, @edit_nintendo, @estado_nuevo),
('Ratchet & Clank: Rift Apart', 'Aventura de plataformas a través de distintas dimensiones.', 39.99, 6, 'ratchet_clank_rift_apart.jpg', 1, @cat_videojuego, @edit_sony, @estado_nuevo),
('Halo Infinite', 'Shooter de ciencia ficción protagonizado por el Jefe Maestro.', 29.99, 8, 'halo_infinite.jpg', 1, @cat_videojuego, @edit_xbox, @estado_nuevo),
('Advance Wars', 'Juego de estrategia por turnos con combates militares.', 24.99, 4, 'advance_wars.jpg', 0, @cat_videojuego, @edit_nintendo, @estado_usado);

/* GUARDAR LOS ID DE LOS PRODUCTOS INSERTADOS */
set @prdo_black_sad = (select id from productos where nombre = 'Blacksad Integral' limit 1);
set @prod_cyber = (select id from productos where nombre = 'Cyberpunk 2077' limit 1);
set @prod_sons_forest = (select id from productos where nombre = 'Sons of the Forest'limit 1);
set @prod_smash = (select id from productos where nombre = 'Super Smash Bros. Ultimate'limit 1);
set @prod_zelda_tears = (select id from productos where nombre = 'The Legend of Zelda: Tears of the Kingdom' limit 1);
set @prod_ratchet = (select id from productos where nombre = 'Ratchet & Clank: Rift Apart' limit 1);
set @prod_halo = (select id from productos where nombre = 'Halo Infinite' limit 1);
set @prod_advance_wars = (select id from productos where nombre = 'Advance Wars' limit 1);

/* INFORMACIÓN ESPECÍFICA DE LOS VIDEOJUEGOS */
insert into videojuegos(producto_id, plataforma_id, genero_id, pegi, desarrolladora, anio_lanzamiento, formato, multijugador) values
(@prod_cyber, @plat_pc, @genero_rpg, 18, 'CD Projekt Red', 2020, 'Digital', 0),
(@prod_sons_forest, @plat_pc, @genero_supervivencia, 18, 'Endnight Games', 2024, 'Digital', 1),
(@prod_smash, @plat_switch, @genero_lucha, 12, 'Bandai Namco Studios y Sora Ltd.', 2018, 'Físico', 1),
(@prod_zelda_tears, @plat_switch, @genero_aventura, 12, 'Nintendo EPD', 2023, 'Físico', 0),
(@prod_ratchet, @plat_ps5, @genero_plataformas, 7, 'Insomniac Games', 2021, 'Físico', 0),
(@prod_halo, @plat_xbox, @genero_accion, 16, '343 Industries', 2021, 'Físico', 1),
(@prod_advance_wars, @plat_retro, @genero_estrategia, 7, 'Intelligent Systems', 2001, 'Físico', 1);

/* DATOS PARA NOVEDADES */
insert into novedades (producto_id, titulo, subtitulo, imagen_banner, texto_boton, activo, orden, fecha_inicio) values
(@prdo_black_sad, 'Especial videojuegos frikis', 'Nuevos títulos de aventura, cómic y cultura retro.',
'banner_videojuegos.jpg', 'Ver videojuego', 1, 1, curdate()),
(null, 'Semana del cómic europeo', 'Astérix, Blacksad, Tintín y clásicos imprescindibles.', 'banner_comics.jpg',
'Ver novedades', 1, 2, curdate()),
(null, 'Merchandaising para coleccionistas.', 'Camisetas, figuras, pósters y productos exclusivos.',
'banner_merchandaising.jpg', 'Ver colección', 1, 3, curdate());