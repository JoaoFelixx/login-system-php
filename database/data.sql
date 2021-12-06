CREATE DATABASE teste;
USE teste;

CREATE TABLE usuarios(
  usuario_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  usuario_nome VARCHAR(255) NOT NULL,
  usuario_pass VARCHAR(255) NOT NULL,
  usuario_email VARCHAR(255) NOT NULL
);

CREATE DATABASE system_login;

USE system_login;

CREATE TABLE users (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  nm_name VARCHAR(80) NOT NULL, 
  cd_password VARCHAR(255) NOT NULL,
  em_email VARCHAR(80) NOT NULL
);