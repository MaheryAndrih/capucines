DROP DATABASE IF EXISTS capucine;
CREATE DATABASE capucine;
CREATE ROLE capucine LOGIN PASSWORD 'capucine';
ALTER DATABASE capucine OWNER to capucine;
\c capucine

CREATE TABLE User (
    id serial PRIMARY KEY,
    username varchar(35),
    mdp varchar(35)
);
insert into User(username,mdp) values ('rija','rija');

CREATE TABLE Evaluation (
    id serial,
    valeur text,
    PRIMARY KEY (id)
);
insert into Evaluation(valeur) values ('DS1');
insert into Evaluation(valeur) values ('DS2');
insert into Evaluation(valeur) values ('Examen Trimestriel I');
insert into Evaluation(valeur) values ('DS3');
insert into Evaluation(valeur) values ('DS4');
insert into Evaluation(valeur) values ('Examen Trimestriel II');
insert into Evaluation(valeur) values ('DS5');
insert into Evaluation(valeur) values ('DS6');
insert into Evaluation(valeur) values ('Examen Trimestriel III');

CREATE TABLE Classe (
    id serial,
    classe text,
    PRIMARY KEY (id)
);
insert into Classe(classe) values ('Petite section');
insert into Classe(classe) values ('Moyenne section');
insert into Classe(classe) values ('Grande section');
insert into Classe(classe) values ('11');
insert into Classe(classe) values ('10');
insert into Classe(classe) values ('9');
insert into Classe(classe) values ('8');
insert into Classe(classe) values ('7');
insert into Classe(classe) values ('6');
insert into Classe(classe) values ('5');
insert into Classe(classe) values ('4');
insert into Classe(classe) values ('3');
insert into Classe(classe) values ('2');
insert into Classe(classe) values ('1er S');
insert into Classe(classe) values ('1er L');
insert into Classe(classe) values ('1er L');
insert into Classe(classe) values ('Tle A');
insert into Classe(classe) values ('Tle C');
insert into Classe(classe) values ('Tle D');

CREATE TABLE Matiere (
    id serial,
    matiere text,
    PRIMARY KEY (id)
);
insert into Matiere(matiere) values ('Mathématique');
insert into Matiere(matiere) values ('Français');
insert into Matiere(matiere) values ('Malagasy');
insert into Matiere(matiere) values ('Histoire & Géographie');
insert into Matiere(matiere) values ('SVT');
insert into Matiere(matiere) values ('Education civique');
insert into Matiere(matiere) values ('Coloriage');
insert into Matiere(matiere) values ('EPS');

CREATE TABLE Matiere_coefficient (
    id_matiere int not null references Matiere(id),
    id_classe int not null references Classe(id),
    coefficient int not null check(coefficient>0)
);

CREATE TABLE Eleve (
    id serial PRIMARY KEY,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    matricule int not null
);

CREATE TABLE Eleve_classe (
    id serial,
    année_scolaire varchar(11),
    id_eleve int not null references Eleve(id),
    id_classe int not null references Classe(id),
    PRIMARY KEY (id)
);

CREATE TABLE Note (
    id serial PRIMARY KEY,
    année_scolaire varchar(11),
    id_eleve int not null references Eleve(id),
    id_evaluation int not null references Evaluation(id),
    id_classe int not null references Classe(id),
    id_matiere int not null references Matiere(id),
    valeur int not null check(valeur >=0 and valeur<=20)
);