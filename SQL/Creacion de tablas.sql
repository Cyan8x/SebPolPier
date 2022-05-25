-- borra la bd si existe
DROP DATABASE IF EXISTS sebpolpier;
-- creamos la bd
CREATE DATABASE sebpolpier;
-- activamos la bd
USE sebpolpier;

create table usuarios(
	id_user int auto_increment not null,
    email varchar (100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null unique,
    nombres varchar (100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null,
    apellidos varchar (100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null,
    contraseña varchar (255) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null,
    adminis bit not null,
	primary key (id_user)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table marcas(
	cod_marca varchar(50) not null,
    marca varchar (100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null unique,
    primary key (cod_marca)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table categorias(
	cod_categoria varchar(50) not null,
    categoria varchar (100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null unique,
    primary key (cod_categoria)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table proveedores(
	cod_prov varchar(50) not null,
    proveedor varchar (100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null unique,
    telefono int not null,
    primary key (cod_prov)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table productos (
	cod_producto varchar(50) not null,
	cod_marca varchar(50) not null,
	cod_categoria varchar(50) not null,
	cod_prov varchar(50) not null,
	cod_orig_prod varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null unique,
	imagen varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null,
	nombre varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null,
	stock int not null,
	precio float not null, /* precio en dolares */
	primary key (cod_producto),
	foreign key (cod_marca) references marcas(cod_marca),
	foreign key (cod_categoria) references categorias(cod_categoria),
    foreign key (cod_prov) references proveedores(cod_prov)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table ventas(
	id_venta int auto_increment not null,
    id_user int not null,
    montoFinal float not null, /* monto final en dolares */
    fecha_compra datetime not null,
    estado varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci not null,
    primary key (id_venta),
	foreign key (id_user) references usuarios(id_user)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table det_venta(
	id_detVent int auto_increment not null,
    id_venta int not null,
    cod_producto varchar(50) not null,
    cantidad int not null,
    subtotal float not null, /* subtotal en dolares */
    primary key (id_detVent),
    foreign key (id_venta) references ventas(id_venta),
	foreign key (cod_producto) references productos(cod_producto)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

