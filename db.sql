-- Base de datos de el sistema de la tipografía
-- Creación de la base de datos
CREATE DATABASE tipografia;
USE tipografia;
SET NAMES UTF8;
-- COMMENT ON DATABASE tipografia IS 'Base de datos encargada de llevar la información del sistema de la tipografia';

-- Tabla: Dirección
CREATE TABLE direcciones(
  id int not null auto_increment primary key COMMENT 'Id único y llave primaria',
  municipio varchar(20) not null COMMENT 'Primero: Municipio',
  ciudad varchar(20) not null COMMENT 'Segundo: Ciudad',
  parroquia varchar(20) not null COMMENT 'Tercero: Parroquia',
  calle varchar(20) not null COMMENT 'Cuarto: calle',
  numero varchar(10) not null COMMENT 'Quinto: Número de casa'
  zona_postal tinyint() not null COMMENT 'Sexto: Zona postal',
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Guarda la dirección de los clientes, trabajadores y proveedores'

-- Tabla: Personas
CREATE TABLE personas(
  id int not null auto_increment primary key COMMENT 'Id único y llave primaria',
  identificacion varchar(13) not null COMMENT 'Cedula o Rif de la persona',
  identificar varchar(10) not null COMMENT 'Tipo de identificacion {cedula, rif, pasaporte}',
  primer_nombre varchar(15) not null COMMENT 'Primer nombre de la persona',
  segundo_nombre varchar(15) COMMENT 'Segundo nombre de la persona',
  primer_apellido varchar(15) not null COMMENT 'Primer apellido de la persona',
  segundo_apellido varchar(15) COMMENT 'Segundo apellido de la persona',
  direccion int not null COMMENT 'Foreanea de dirección'
  sexo boolean not null COMMENT '0 => Mujer, 1 => Hombre',
  tipo varchar(10) not null COMMENT 'Trabajador o Cliente',
  CONSTRAINT persona_direccion FOREIGN KEY (direccion) REFERENCES direcciones (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Datos de todas las personas del sistema ya sean clientes o trabajadores';

-- Tabla: Proveedores
CREATE TABLE proveedores(
  id int not null auto_increment primary key COMMENT 'Id único y llave primaria',
  rif varchar(13) not null COMMENT 'Rif del proveedor o empresa distribuidora',
  razon_social varchar(100) COMMENT 'Nombre del proveedor o empresa',
  direccion int not null COMMENT 'Foranea de dirección',
  CONSTRAINT persona_direccion FOREIGN KEY (direccion) REFERENCES direcciones (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Datos de los proveedores o empresas proveedora';

-- Tabla: Contacto
CREATE TABLE personas_contacto(
  id int not null auto_increment primary key
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla puente entre la tabla personas/proveedores y contactos';
