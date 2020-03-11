CREATE DATABASE ATIVIDADE1;

USE ATIVIDADE1;
use AtividadeGado;

CREATE TABLE veterinario (
id int auto_increment,
nome varchar(45),
crmv varchar(45),
telefone varchar(15),
PRIMARY KEY (id)
);
 delete from veterinario 
 where id = 2;
drop table veterinario;
select* from veterinario;
CREATE TABLE gado_has_veterinario (
gado_codigo int auto_increment,
veterinario_codigo int,
ultimaConsulta date,
tratamento varchar(45),
PRIMARY KEY (gado_codigo),
FOREIGN KEY (veterinario_codigo) REFERENCES veterinario(codigo)
);
drop table gado_has_veterinario;

CREATE TABLE gado(
codigo int auto_increment,
nome varchar(45),
idade int,
peso decimal(5,2),
raca_codigo int,
criador_codigo int,
PRIMARY KEY (codigo)
);

CREATE TABLE raca(
codigo int auto_increment,
nome varchar(45),
PRIMARY KEY (codigo)
);

CREATE TABLE criador(
codigo int auto_increment,
nome varchar(45),
nomePropriedade varchar(45),
PRIMARY KEY (codigo)
);
