create table utilisateur(
    id char(9) primary key,
    username varchar(40) not null,
    password varchar(40) unique not null
);

create sequence utilisateur_seq 
    start with 1
    increment by 1
    minvalue 1;

insert into utilisateur values
('USR' || RIGHT('000000' || nextval('utilisateur_seq'), 6),'andry','andry'),
('USR' || RIGHT('000000' || nextval('utilisateur_seq'), 6),'ravo','ravo'),
('USR' || RIGHT('000000' || nextval('utilisateur_seq'), 6),'rija','rija');

create table epreuve(
    id char(9) primary key,
    nom_epreuve varchar(50) not null,
    code_epreuve varchar(5) not null,
    unique(nom_epreuve,code_epreuve)
);

create sequence epreuve_seq 
    start with 1
    increment by 1
    minvalue 1;

insert into epreuve values
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'DS1','DS1'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'DS2','DS2'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'Examen Trimestriel I','ExI'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'DS3','DS3'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'DS4','DS4'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'Examen Trimestriel II','ExII'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'DS5','DS5'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'DS6','DS6'),
('EPR' || RIGHT('000000' || nextval('epreuve_seq'), 6),'Examen Trimestriel III','ExIII');

create table classe(
    id char(9) primary key,
    nom_classe varchar(30) not null,
    code_classe varchar(10) not null,
    unique(nom_classe,code_classe)
);

create sequence classe_seq 
    start with 1
    increment by 1
    minvalue 1;

insert into classe values
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Petite Section','PS'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Moyenne Section','MS'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Grande Section','GS'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'11e','CP1'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'10e','CP2'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'9e','CE'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'8e','CM1'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'7e','CM2'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'6e','6e'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'5e','5e'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'4e','4e'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'3e','3e'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'2nd','2nd'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'1ère_S','1ère_S'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'1ère_L','1ère_L'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Terminale_A','Tle_A'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Terminale_C','Tle_C'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Terminale_D','Tle_D'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'Ière_année_G2','G2_I'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'IIème_année_G2','G2_II'),
('CLS' || RIGHT('000000' || nextval('classe_seq'), 6),'IIIème_année_G2','G2_III');

create table matiere(
    id char(9) primary key,
    nom_matiere varchar(50) not null,
    code_matiere varchar(5) not null,
    unique(nom_matiere,code_matiere)
);

create sequence matiere_seq 
    start with 1
    increment by 1
    minvalue 1;

insert into matiere values
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Mathématique','MATH'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Physique-Chimie','PC'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Francais','FRS'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Science de la vie et de la terre','SVT'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Histoire-Géographie','HG'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Education Civique','EC'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Education Physique et Sportive','EPS'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Anglais','ANG'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Espagnol','ESP'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Malagasy','MLG'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Philosophie','PHILO'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'Coloriage','CLR');

create table eleve(
    id char(9) primary key,
    nom varchar(30) not null,
    prenom varchar(30) not null,
    dtn date check (dtn <= NOW())
);

create sequence eleve_seq 
    start with 1
    increment by 1
    minvalue 1;

INSERT INTO eleve( id, nom, prenom, dtn ) VALUES 
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMIADANA', 'Joronavalona', '2006-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RATSIMBAZAFY', 'Mialy', '2007-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAKOTOMANANA', 'Nantenaina', '2008-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANTSOA', 'Solofa', '2009-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMAHARO', 'Herilala', '2010-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RASOLOMANANA', 'Fidisoa', '2011-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAKOTOSON', 'Tiana', '2012-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANDRASANA', 'Nantenaina', '2013-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMANANA', 'Solofa', '2014-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RASOLOFOZAFY', 'Mialy', '2015-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANTSOA', 'Nantenaina', '2016-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMAHARO', 'Herilala', '2017-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RASOLOMANANA', 'Fidisoa', '2018-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAKOTOSON', 'Tiana', '2019-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANDRASANA', 'Nantenaina', '2020-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMANANA', 'Solofa', '2021-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RASOLOFOZAFY', 'Mialy', '2022-12-01'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANTSOA', 'Nantenaina', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMIADANA', 'Joronavalona', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RATSIMBAZAFY', 'Mialy', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAKOTOMANANA', 'Nantenaina', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANTSOA', 'Solofa', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMAHARO', 'Herilala', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RASOLOMANANA', 'Fidisoa', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAKOTOSON', 'Tiana', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANDRASANA', 'Nantenaina', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMANANA', 'Solofa', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RASOLOFOZAFY', 'Mialy', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RAMANANTSOA', 'Nantenaina', '2023-09-14'),
('ELV' || RIGHT('000000' || nextval('eleve_seq'), 6), 'RANDRIAMIADANA', 'Joronavalona', '2023-09-14');


create table classe_eleve(
    id_classe char(9) references classe(id),
    id_eleve char(9) references eleve(id),
    unique(id_eleve,id_classe)
);

INSERT INTO classe_eleve( id_classe,id_eleve ) VALUES 
( 'CLS000001', 'ELV000001'),
( 'CLS000001', 'ELV000002'),
( 'CLS000001', 'ELV000003'),
( 'CLS000001', 'ELV000004'),
( 'CLS000001', 'ELV000005'),
( 'CLS000002', 'ELV000006'),
( 'CLS000002', 'ELV000007'),
( 'CLS000002', 'ELV000008'),
( 'CLS000002', 'ELV000009'),
( 'CLS000002', 'ELV000010'),
( 'CLS000003', 'ELV000011'),
( 'CLS000003', 'ELV000012'),
( 'CLS000003', 'ELV000013'),
( 'CLS000003', 'ELV000014'),
( 'CLS000003', 'ELV000015'),
( 'CLS000004', 'ELV000016'),
( 'CLS000004', 'ELV000017'),
( 'CLS000004', 'ELV000018'),
( 'CLS000004', 'ELV000019'),
( 'CLS000004', 'ELV000020'),
( 'CLS000005', 'ELV000021'),
( 'CLS000005', 'ELV000022'),
( 'CLS000005', 'ELV000023'),
( 'CLS000005', 'ELV000024'),
( 'CLS000005', 'ELV000025'),
( 'CLS000006', 'ELV000026'),
( 'CLS000006', 'ELV000027'),
( 'CLS000006', 'ELV000028'),
( 'CLS000006', 'ELV000029'),
( 'CLS000006', 'ELV000030');

create table classe_matiere_coefficient(
    id_classe char(9) references classe(id) not null,
    id_matiere char(9) references matiere(id) not null,
    coefficient int not null check(coefficient >= 1),
    unique(id_classe,id_matiere)
);

INSERT INTO classe_matiere_coefficient(id_classe, id_matiere, coefficient) VALUES
('CLS000001', 'MAT000001', 3),
('CLS000001', 'MAT000002', 4),
('CLS000001', 'MAT000003', 2),
('CLS000001', 'MAT000004', 5),
('CLS000001', 'MAT000005', 3),
('CLS000001', 'MAT000006', 2),
('CLS000001', 'MAT000007', 4),
('CLS000001', 'MAT000008', 3),
('CLS000001', 'MAT000009', 5),
('CLS000001', 'MAT000010', 1),
('CLS000001', 'MAT000011', 4),
('CLS000001', 'MAT000012', 2),
('CLS000002', 'MAT000001', 2),
('CLS000002', 'MAT000002', 3),
('CLS000002', 'MAT000003', 5),
('CLS000002', 'MAT000004', 4),
('CLS000002', 'MAT000005', 3),
('CLS000002', 'MAT000006', 2),
('CLS000002', 'MAT000007', 5),
('CLS000002', 'MAT000008', 4),
('CLS000002', 'MAT000009', 3),
('CLS000002', 'MAT000010', 2),
('CLS000002', 'MAT000011', 1),
('CLS000002', 'MAT000012', 4),
('CLS000003', 'MAT000001', 5),
('CLS000003', 'MAT000002', 3),
('CLS000003', 'MAT000003', 2),
('CLS000003', 'MAT000004', 4),
('CLS000003', 'MAT000005', 1),
('CLS000003', 'MAT000006', 3),
('CLS000003', 'MAT000007', 5),
('CLS000003', 'MAT000008', 4),
('CLS000003', 'MAT000009', 2),
('CLS000003', 'MAT000010', 5),
('CLS000003', 'MAT000011', 3),
('CLS000003', 'MAT000012', 4),
('CLS000004', 'MAT000001', 3),
('CLS000004', 'MAT000002', 5),
('CLS000004', 'MAT000003', 2),
('CLS000004', 'MAT000004', 1),
('CLS000004', 'MAT000005', 4),
('CLS000004', 'MAT000006', 3),
('CLS000004', 'MAT000007', 5),
('CLS000004', 'MAT000008', 4),
('CLS000004', 'MAT000009', 2),
('CLS000004', 'MAT000010', 3),
('CLS000004', 'MAT000011', 1),
('CLS000004', 'MAT000012', 5),
('CLS000005', 'MAT000001', 4),
('CLS000005', 'MAT000002', 2),
('CLS000005', 'MAT000003', 3),
('CLS000005', 'MAT000004', 5),
('CLS000005', 'MAT000005', 1),
('CLS000005', 'MAT000006', 4),
('CLS000005', 'MAT000007', 2),
('CLS000005', 'MAT000008', 5),
('CLS000005', 'MAT000009', 3),
('CLS000005', 'MAT000010', 1),
('CLS000005', 'MAT000011', 2),
('CLS000005', 'MAT000012', 4),
('CLS000006', 'MAT000001', 5),
('CLS000006', 'MAT000002', 3),
('CLS000006', 'MAT000003', 4),
('CLS000006', 'MAT000004', 2),
('CLS000006', 'MAT000005', 1),
('CLS000006', 'MAT000006', 5),
('CLS000006', 'MAT000007', 3),
('CLS000006', 'MAT000008', 4),
('CLS000006', 'MAT000009', 5),
('CLS000006', 'MAT000010', 2),
('CLS000006', 'MAT000011', 3),
('CLS000006', 'MAT000012', 4);


CREATE TABLE classe_epreuve (
    id_classe CHAR(9) REFERENCES classe(id) NOT NULL,
    id_epreuve CHAR(9) REFERENCES epreuve(id) NOT NULL,
    UNIQUE(id_classe, id_epreuve)
);

INSERT INTO classe_epreuve (id_classe, id_epreuve) VALUES
('CLS000001', 'EPR000001'),
('CLS000001', 'EPR000002'),
('CLS000001', 'EPR000003'),
('CLS000001', 'EPR000004'),
('CLS000001', 'EPR000005'),
('CLS000001', 'EPR000006'),
('CLS000001', 'EPR000007'),
('CLS000001', 'EPR000008'),
('CLS000001', 'EPR000009'),
('CLS000002', 'EPR000001'),
('CLS000002', 'EPR000002'),
('CLS000002', 'EPR000003'),
('CLS000002', 'EPR000004'),
('CLS000002', 'EPR000005'),
('CLS000002', 'EPR000006'),
('CLS000002', 'EPR000007'),
('CLS000002', 'EPR000008'),
('CLS000002', 'EPR000009'),
('CLS000003', 'EPR000001'),
('CLS000003', 'EPR000002'),
('CLS000003', 'EPR000003'),
('CLS000003', 'EPR000004'),
('CLS000003', 'EPR000005'),
('CLS000003', 'EPR000006'),
('CLS000003', 'EPR000007'),
('CLS000003', 'EPR000008'),
('CLS000003', 'EPR000009'),
('CLS000004', 'EPR000001'),
('CLS000004', 'EPR000002'),
('CLS000004', 'EPR000003'),
('CLS000004', 'EPR000004'),
('CLS000004', 'EPR000005'),
('CLS000004', 'EPR000006'),
('CLS000004', 'EPR000007'),
('CLS000004', 'EPR000008'),
('CLS000004', 'EPR000009'),
('CLS000005', 'EPR000001'),
('CLS000005', 'EPR000002'),
('CLS000005', 'EPR000003'),
('CLS000005', 'EPR000004'),
('CLS000005', 'EPR000005'),
('CLS000005', 'EPR000006'),
('CLS000005', 'EPR000007'),
('CLS000005', 'EPR000008'),
('CLS000005', 'EPR000009'),
('CLS000006', 'EPR000001'),
('CLS000006', 'EPR000002'),
('CLS000006', 'EPR000003'),
('CLS000006', 'EPR000004'),
('CLS000006', 'EPR000005'),
('CLS000006', 'EPR000006'),
('CLS000006', 'EPR000007'),
('CLS000006', 'EPR000008'),
('CLS000006', 'EPR000009');

create table note(
    id char(9) primary key,
    id_classe char(9) references classe(id) not null,
    id_eleve char(9) references eleve(id) not null,
    id_epreuve char(9) references epreuve(id) not null,
    id_matiere char(9) references matiere(id) not null,
    note double precision check (note >=0 and note <= 20),
    unique(id_classe,id_eleve,id_epreuve,id_matiere)
);

create sequence note_seq
    start with 1
    increment by 1
    minvalue 1;

INSERT INTO note (id, id_classe, id_eleve, id_epreuve, id_matiere, note) VALUES
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000001', 'EPR000001', 'MAT000001', 15.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000001', 'EPR000002', 'MAT000002', 16.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000002', 'EPR000003', 'MAT000003', 12.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000003', 'EPR000004', 'MAT000004', 18.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000004', 'EPR000005', 'MAT000005', 14.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000005', 'EPR000006', 'MAT000006', 13.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000002', 'ELV000006', 'EPR000001', 'MAT000007', 10.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000002', 'ELV000007', 'EPR000002', 'MAT000008', 17.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000002', 'ELV000008', 'EPR000003', 'MAT000009', 19.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000002', 'ELV000009', 'EPR000004', 'MAT000010', 16.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000002', 'ELV000010', 'EPR000005', 'MAT000011', 13.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000003', 'ELV000011', 'EPR000001', 'MAT000012', 9.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000003', 'ELV000012', 'EPR000002', 'MAT000001', 8.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000003', 'ELV000013', 'EPR000003', 'MAT000002', 14.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000003', 'ELV000014', 'EPR000004', 'MAT000003', 19.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000003', 'ELV000015', 'EPR000005', 'MAT000004', 17.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000004', 'ELV000016', 'EPR000006', 'MAT000005', 10.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000004', 'ELV000017', 'EPR000007', 'MAT000006', 11.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000004', 'ELV000018', 'EPR000008', 'MAT000007', 12.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000004', 'ELV000019', 'EPR000009', 'MAT000008', 17.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000004', 'ELV000020', 'EPR000001', 'MAT000009', 9.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000005', 'ELV000021', 'EPR000002', 'MAT000010', 10.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000005', 'ELV000022', 'EPR000003', 'MAT000011', 14.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000005', 'ELV000023', 'EPR000004', 'MAT000012', 18.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000005', 'ELV000024', 'EPR000005', 'MAT000001', 16.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000005', 'ELV000025', 'EPR000006', 'MAT000002', 11.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000006', 'ELV000026', 'EPR000007', 'MAT000003', 13.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000006', 'ELV000027', 'EPR000008', 'MAT000004', 15.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000006', 'ELV000028', 'EPR000009', 'MAT000005', 18.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000006', 'ELV000029', 'EPR000001', 'MAT000006', 16.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000006', 'ELV000030', 'EPR000002', 'MAT000007', 19.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000001', 'ELV000001', 'EPR000003', 'MAT000002', 14.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000002', 'ELV000008', 'EPR000004', 'MAT000011', 17.5),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000003', 'ELV000014', 'EPR000005', 'MAT000009', 18.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000004', 'ELV000018', 'EPR000006', 'MAT000010', 16.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000005', 'ELV000023', 'EPR000007', 'MAT000012', 19.0),
('NTE' || RIGHT('000000' || nextval('note_seq'), 6), 'CLS000006', 'ELV000030', 'EPR000009', 'MAT000003', 13.0);





