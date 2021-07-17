
use proyecto_andes;

CREATE TABLE IF NOT EXISTS cities (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cod varchar(200) NOT NULL,
  name varchar(200) NOT NULL);

INSERT INTO cities (cod, name) VALUES
('001', 'Bogota'),
('002', 'Medellin'),
('003', 'Bucaramanga');

CREATE TABLE IF NOT EXISTS client (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  codigo varchar(200) NOT NULL,
  nombre varchar(200) NOT NULL,
  ciudad varchar(200) NOT NULL);

INSERT INTO client (codigo, nombre, ciudad) VALUES
('001', 'Cliente 1', 'Bogota'),
('002', 'Cliente 2', 'Medellin'),
('003', 'Cliente 3', 'Bucaramanga'),
('005', 'Cliente 5', 'Prueba '),
('004', 'Cliente 4', 'Bucaramanga'),
('Prueba ', 'Prueba ', 'Medellin'),
('Prueba ', 'Prueba ', 'Bogota');

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(200) NOT NULL,
  pass varchar(200) NOT NULL,
  email varchar(200) NOT NULL);

INSERT INTO users (name, pass, email) VALUES
('Prueba 1', '1234567', 'prueba1@prueba.com'),
('Prueba 2', '5678', 'prueba2@prueba.com'),
('Prueba 3', 'pass', 'parueba3@prueba.com');

