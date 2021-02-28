CREATE DATABASE teste;
USE teste;

CREATE TABLE usuarios(
  usuario_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  usuario_nome VARCHAR(255) NOT NULL,
  usuario_pass VARCHAR(255) NOT NULL,
  usuario_email VARCHAR(255) NOT NULL


);