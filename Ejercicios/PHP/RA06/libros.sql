-- ============================================================
-- RA06 - Base de datos Libros
-- Autor: Carlos Vico
-- ============================================================

CREATE DATABASE IF NOT EXISTS libros
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE libros;

-- Tabla autores (plural, snake_case según convención)
CREATE TABLE IF NOT EXISTS autores (
    id            INT          NOT NULL,
    nombre        VARCHAR(15)  NOT NULL,
    apellidos     VARCHAR(25)  NOT NULL,
    nacionalidad  VARCHAR(10)  NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Tabla libros
CREATE TABLE IF NOT EXISTS libros (
    id             INT         NOT NULL,
    titulo         VARCHAR(50) NOT NULL,
    f_publicacion  VARCHAR(10) NOT NULL,
    id_autor       INT         NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_libro_autor
        FOREIGN KEY (id_autor) REFERENCES autores(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Datos de autores
INSERT INTO autores (id, nombre, apellidos, nacionalidad) VALUES
    (0, 'J. R. R.', 'Tolkien', 'Inglaterra'),
    (1, 'Isaac',    'Asimov',  'Rusia');

-- Datos de libros
INSERT INTO libros (id, titulo, f_publicacion, id_autor) VALUES
    (0, 'El Hobbit',                 '21/09/1937', 0),
    (1, 'La Comunidad del Anillo',   '29/07/1954', 0),
    (2, 'Las dos torres',            '11/11/1954', 0),
    (3, 'El retorno del Rey',        '20/10/1955', 0),
    (4, 'Un guijarro en el cielo',   '19/01/1950', 1),
    (5, 'Fundación',                 '01/06/1951', 1),
    (6, 'Yo, robot',                 '02/12/1950', 1);
