drop table utilisateur;
drop sequence utilisateur_seq;
drop table epreuve cascade;
drop sequence epreuve_seq;
drop table classe cascade;
drop sequence classe_seq;
drop table matiere cascade;
drop sequence matiere_seq;
drop table eleve cascade;
drop sequence eleve_seq;
drop table note;
drop sequence note_seq;
delete from classe_matiere_coefficient cascade;
drop table appreciation cascade;
drop table appreciation_seq;


create table utilisateur(
    id_utilisateur char(9) primary key,
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
    id_epreuve char(9) primary key,
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
    id_classe char(9) primary key,
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

UPDATE classe SET nom_classe = '11Þme' WHERE id_classe = 'CLS000004';
UPDATE classe SET nom_classe = '10Þme' WHERE id_classe = 'CLS000005';
UPDATE classe SET nom_classe = '9Þme' WHERE id_classe = 'CLS000006';
UPDATE classe SET nom_classe = '8Þme' WHERE id_classe = 'CLS000007';
UPDATE classe SET nom_classe = '7Þme' WHERE id_classe = 'CLS000008';
UPDATE classe SET nom_classe = '6Þme' WHERE id_classe = 'CLS000009';
UPDATE classe SET nom_classe = '5Þme' WHERE id_classe = 'CLS000010';
UPDATE classe SET nom_classe = '4Þme' WHERE id_classe = 'CLS000011';
UPDATE classe SET nom_classe = '3Þme' WHERE id_classe = 'CLS000012';
UPDATE classe SET nom_classe = '1Þre_S' WHERE id_classe = 'CLS000014';
UPDATE classe SET nom_classe = '1Þre_L' WHERE id_classe = 'CLS000015';
UPDATE classe SET nom_classe = '1AG2' WHERE id_classe = 'CLS000019';
UPDATE classe SET nom_classe = '2AG2' WHERE id_classe = 'CLS000020';
UPDATE classe SET nom_classe = '3AG2' WHERE id_classe = 'CLS000021';
UPDATE classe SET nom_classe = '12Þme' WHERE id_classe = 'CLS000003';

UPDATE matiere SET nom_matiere = 'Franþais' WHERE code_matiere = 'FRS';
UPDATE appreciation SET appreciation = 'TrÞs Bien' WHERE fin = 20;

create table matiere(
    id_matiere char(9) primary key,
    nom_matiere varchar(50) not null,
    code_matiere varchar(5) not null,
    unique(nom_matiere,code_matiere)
);

ALTER TABLE matiere ALTER COLUMN code_matiere TYPE VARCHAR(15);

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

INSERT INTO MATIERE VALUES
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'MORALE','MOR'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'LANGAGE','LANG'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'RECITATION','RCT'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'PRE-LECTURE','PRL'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'LECTURE','LECT'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'ECRITURE','ECR'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'COPIE','COP'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'DICTEE','DCT'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'EVEIL','EVL'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'ACM','ACM'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'APSE','APSE'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'INFO','INF');

INSERT INTO MATIERE VALUES
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'EXPRESSION ORALE/LECTURE','EXP'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'DIKASORATRA/SORATONONINA','DIKS'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'FANAZARANA HITENY/VAKITENY','VAK'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'PROBLEMES','PB'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'CHANT/RECITATION','CHN'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'TFM','TFM'),
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'DESSIN/ACM','DES');


INSERT INTO MATIERE VALUES
('MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),'DICTEE/ECRITURE','DCTECR');

create table eleve(
    matricule serial primary key,
    nom varchar(30) not null,
    prenom varchar(30) not null,
    dtn date check (dtn <= NOW()) not null,
    genre char(1) check(genre = 'M' or genre = 'F') not null,
    nom_pere varchar(200),
    profession_pere varchar(100),
    numero_pere varchar(14),
    nom_mere varchar(200),
    profession_mere varchar(100),
    numero_mere varchar(14)
);

ALTER TABLE eleve ADD COLUMN image VARCHAR;

create table classe_eleve(
    id_classe char(9) references classe(id_classe),
    matricule int references eleve(matricule),
    numero int,
    unique(matricule)
);

create table classe_matiere_coefficient(
    rang int not null,
    id_classe char(9) references classe(id_classe) not null,
    id_matiere char(9) references matiere(id_matiere) not null,
    coefficient double precision not null check(coefficient >= 0.5),
    unique(id_classe,id_matiere,rang)
);

CREATE TABLE classe_epreuve (
    id_classe CHAR(9) REFERENCES classe(id_classe) NOT NULL,
    id_epreuve CHAR(9) REFERENCES epreuve(id_epreuve) NOT NULL,
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
('CLS000006', 'EPR000009'),
('CLS000007', 'EPR000001'),
('CLS000007', 'EPR000002'),
('CLS000007', 'EPR000003'),
('CLS000007', 'EPR000004'),
('CLS000007', 'EPR000005'),
('CLS000007', 'EPR000006'),
('CLS000007', 'EPR000007'),
('CLS000007', 'EPR000008'),
('CLS000007', 'EPR000009'),
('CLS000008', 'EPR000001'),
('CLS000008', 'EPR000002'),
('CLS000008', 'EPR000003'),
('CLS000008', 'EPR000004'),
('CLS000008', 'EPR000005'),
('CLS000008', 'EPR000006'),
('CLS000008', 'EPR000007'),
('CLS000008', 'EPR000008'),
('CLS000008', 'EPR000009'),
('CLS000009', 'EPR000001'),
('CLS000009', 'EPR000002'),
('CLS000009', 'EPR000003'),
('CLS000009', 'EPR000004'),
('CLS000009', 'EPR000005'),
('CLS000009', 'EPR000006'),
('CLS000009', 'EPR000007'),
('CLS000009', 'EPR000008'),
('CLS000009', 'EPR000009'),
('CLS000010', 'EPR000001'),
('CLS000010', 'EPR000002'),
('CLS000010', 'EPR000003'),
('CLS000010', 'EPR000004'),
('CLS000010', 'EPR000005'),
('CLS000010', 'EPR000006'),
('CLS000010', 'EPR000007'),
('CLS000010', 'EPR000008'),
('CLS000010', 'EPR000009'),
('CLS000011', 'EPR000001'),
('CLS000011', 'EPR000002'),
('CLS000011', 'EPR000003'),
('CLS000011', 'EPR000004'),
('CLS000011', 'EPR000005'),
('CLS000011', 'EPR000006'),
('CLS000011', 'EPR000007'),
('CLS000011', 'EPR000008'),
('CLS000011', 'EPR000009'),
('CLS000012', 'EPR000001'),
('CLS000012', 'EPR000002'),
('CLS000012', 'EPR000003'),
('CLS000012', 'EPR000004'),
('CLS000012', 'EPR000005'),
('CLS000012', 'EPR000006'),
('CLS000012', 'EPR000007'),
('CLS000012', 'EPR000008'),
('CLS000012', 'EPR000009'),
('CLS000013', 'EPR000001'),
('CLS000013', 'EPR000002'),
('CLS000013', 'EPR000003'),
('CLS000013', 'EPR000004'),
('CLS000013', 'EPR000005'),
('CLS000013', 'EPR000006'),
('CLS000013', 'EPR000007'),
('CLS000013', 'EPR000008'),
('CLS000013', 'EPR000009'),
('CLS000014', 'EPR000001'),
('CLS000014', 'EPR000002'),
('CLS000014', 'EPR000003'),
('CLS000014', 'EPR000004'),
('CLS000014', 'EPR000005'),
('CLS000014', 'EPR000006'),
('CLS000014', 'EPR000007'),
('CLS000014', 'EPR000008'),
('CLS000014', 'EPR000009'),
('CLS000015', 'EPR000001'),
('CLS000015', 'EPR000002'),
('CLS000015', 'EPR000003'),
('CLS000015', 'EPR000004'),
('CLS000015', 'EPR000005'),
('CLS000015', 'EPR000006'),
('CLS000015', 'EPR000007'),
('CLS000015', 'EPR000008'),
('CLS000015', 'EPR000009'),
('CLS000016', 'EPR000001'),
('CLS000016', 'EPR000002'),
('CLS000016', 'EPR000003'),
('CLS000016', 'EPR000004'),
('CLS000016', 'EPR000005'),
('CLS000016', 'EPR000006'),
('CLS000016', 'EPR000007'),
('CLS000016', 'EPR000008'),
('CLS000016', 'EPR000009'),
('CLS000017', 'EPR000001'),
('CLS000017', 'EPR000002'),
('CLS000017', 'EPR000003'),
('CLS000017', 'EPR000004'),
('CLS000017', 'EPR000005'),
('CLS000017', 'EPR000006'),
('CLS000017', 'EPR000007'),
('CLS000017', 'EPR000008'),
('CLS000017', 'EPR000009'),
('CLS000018', 'EPR000001'),
('CLS000018', 'EPR000002'),
('CLS000018', 'EPR000003'),
('CLS000018', 'EPR000004'),
('CLS000018', 'EPR000005'),
('CLS000018', 'EPR000006'),
('CLS000018', 'EPR000007'),
('CLS000018', 'EPR000008'),
('CLS000018', 'EPR000009'),
('CLS000019', 'EPR000001'),
('CLS000019', 'EPR000002'),
('CLS000019', 'EPR000003'),
('CLS000019', 'EPR000004'),
('CLS000019', 'EPR000005'),
('CLS000019', 'EPR000006'),
('CLS000019', 'EPR000007'),
('CLS000019', 'EPR000008'),
('CLS000019', 'EPR000009'),
('CLS000020', 'EPR000001'),
('CLS000020', 'EPR000002'),
('CLS000020', 'EPR000003'),
('CLS000020', 'EPR000004'),
('CLS000020', 'EPR000005'),
('CLS000020', 'EPR000006'),
('CLS000020', 'EPR000007'),
('CLS000020', 'EPR000008'),
('CLS000020', 'EPR000009'),
('CLS000021', 'EPR000001'),
('CLS000021', 'EPR000002'),
('CLS000021', 'EPR000003'),
('CLS000021', 'EPR000004'),
('CLS000021', 'EPR000005'),
('CLS000021', 'EPR000006'),
('CLS000021', 'EPR000007'),
('CLS000021', 'EPR000008'),
('CLS000021', 'EPR000009');

create table appreciation(
    id_apprectiation char(9) primary key,
    debut int not null,
    fin int not null,
    appreciation varchar(40) not null,
    unique(debut,fin)
);

create sequence appreciation_seq
    start with 1
    increment by 1
    minvalue 1;

INSERT INTO appreciation VALUES
('APR' || RIGHT('000000' || nextval('appreciation_seq'), 6),0,10,'Passable'),
('APR' || RIGHT('000000' || nextval('appreciation_seq'), 6),10,12,'Passable'),
('APR' || RIGHT('000000' || nextval('appreciation_seq'), 6),12,14,'Assez bien'),
('APR' || RIGHT('000000' || nextval('appreciation_seq'), 6),14,16,'Bien'),
('APR' || RIGHT('000000' || nextval('appreciation_seq'), 6),16,20,'Trés bien');

create table note(
    id_note char(9) primary key,
    id_classe char(9) references classe(id_classe) not null,
    matricule int references eleve(matricule) not null,
    id_epreuve char(9) references epreuve(id_epreuve) not null,
    id_matiere char(9) references matiere(id_matiere) not null,
    note double precision check (note >=0 and note <= 20),
    unique(id_classe,matricule,id_epreuve,id_matiere)
);

create sequence note_seq
    start with 1
    increment by 1
    minvalue 1;

create table sanction (
    id_sanction char(9) primary key,
    matricule int references eleve(matricule),
    motif varchar(100),
    date_sanction date DEFAULT now()
);

create sequence sanction_seq
    start with 1
    increment by 1
    minvalue 1;

CREATE or REPLACE View v_note_classe as
    select 
    classe_matiere_coefficient.id_classe, classe_matiere_coefficient.id_matiere,classe_matiere_coefficient.coefficient,
    classe_epreuve.id_epreuve,
    eleve.matricule, eleve.nom, eleve.prenom,
    COALESCE(note.note,0) as note,
    classe_eleve.numero
    from classe_matiere_coefficient
    left join classe_epreuve on classe_epreuve.id_classe=classe_matiere_coefficient.id_classe
    left join classe_eleve on classe_eleve.id_classe=classe_matiere_coefficient.id_classe
    left join eleve on eleve.matricule=classe_eleve.matricule
    left join note on note.id_classe=classe_matiere_coefficient.id_classe 
        and note.id_matiere=classe_matiere_coefficient.id_matiere 
        and note.matricule=eleve.matricule
        and note.id_epreuve=classe_epreuve.id_epreuve;

ALTER TABLE classe_eleve ADD COLUMN passant BOOLEAN NOT NULL DEFAULT 't';
ALTER TABLE classe_eleve DROP COLUMN passant ;
ALTER TABLE classe_eleve ADD COLUMN statut BOOLEAN NOT NULL DEFAULT 't';


CREATE or REPLACE View v_eleve as
    select eleve.*,COALESCE(classe_eleve.id_classe,'NULL') as id_classe,COALESCE(classe.nom_classe,'NON-CLASSEE') as nom_classe, classe_eleve.numero,
    classe_eleve.statut from classe_eleve full join eleve on classe_eleve.matricule=eleve.matricule
    left join classe on classe_eleve.id_classe=classe.id_classe;

CREATE or REPLACE v_bulletin as 
    select v_note_classe.*,
    note*coefficient as m,
    sum(note*coefficient)
    from v_note_classe
    GROUP BY v_note_classe.id_classe,v_note_classe.id_matiere,v_note_classe.coefficient,v_note_classe.id_epreuve,
    v_note_classe.id,v_note_classe.nom,v_note_classe.prenom,v_note_classe.note;

CREATE or REPLACE View v_classe_matiere_coefficient as 
    select  
        cm.id_classe,
        cm.id_matiere,
        m.nom_matiere,
        m.code_matiere,
        cm.coefficient,
        cm.rang
    from classe_matiere_coefficient as cm
        join matiere as m on
            m.id_matiere = cm.id_matiere;

CREATE or REPLACE View v_epreuve as 
    select  
        ce.id_classe,
        c.code_classe,
        ce.id_epreuve,
        e.code_epreuve
    from classe_epreuve as ce
        join classe as c on
            ce.id_classe = c.id_classe
        join epreuve as e on 
            ce.id_epreuve = e.id_epreuve;


CREATE TABLE import_note (
    id serial primary key,
    code_epreuve varchar not null,
    code_classe varchar not null,
    code_matiere varchar not null,
    matricule varchar not null,
    nom varchar not null,
    prenom varchar not null,
    note varchar not null,
    unique(code_epreuve,code_classe,code_matiere,matricule)
);


CREATE OR REPLACE FUNCTION delete_import_note()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE  from import_note;
END;
$$;

CREATE OR REPLACE FUNCTION insert_unique_note()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO note (id_note,id_classe,matricule,id_epreuve,id_matiere,note)
    SELECT DISTINCT
        'NTE' || RIGHT('000000' || nextval('note_seq'), 6),
        c.id_classe,
        CAST(i.matricule as INT),
        e.id_epreuve,
        m.id_matiere,
        CAST(i.note as DOUBLE PRECISION)
    FROM import_note AS i
        JOIN classe AS c    
            ON c.code_classe = i.code_classe
        JOIN epreuve AS e 
            ON e.code_epreuve = i.code_epreuve
        JOIN matiere AS m 
            ON m.code_matiere = i.code_matiere
    ON CONFLICT DO NOTHING;
END
$$; 

CREATE OR REPLACE FUNCTION delete_note_existant(id_epreuve_input VARCHAR,id_classe_input VARCHAR,id_matiere_input VARCHAR)
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE FROM note 
        where id_epreuve = id_epreuve_input 
        and id_classe = id_classe_input
        and id_matiere = id_matiere_input;
END
$$;

CREATE TABLE import_coefficient (
    id serial primary key,
    code_classe varchar not null,
    code_matiere varchar not null unique,
    coefficient varchar not null
);

ALTER TABLE import_coefficient ADD COLUMN rang VARCHAR;
ALTER TABLE import_coefficient ADD COLUMN nom_matiere VARCHAR;

CREATE OR REPLACE FUNCTION delete_import_coefficient()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE  from import_coefficient;
END;
$$;

CREATE OR REPLACE FUNCTION insert_unique_matiere()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO matiere(id_matiere,nom_matiere,code_matiere)
    SELECT DISTINCT
        'MAT' || RIGHT('000000' || nextval('matiere_seq'), 6),
        i.nom_matiere,
        i.code_matiere
    FROM import_coefficient AS i
    ON CONFLICT DO NOTHING;
END
$$;

CREATE OR REPLACE FUNCTION insert_unique_coefficient()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO classe_matiere_coefficient(id_classe,id_matiere,coefficient,rang)
    SELECT
        c.id_classe,
        m.id_matiere,
        CAST(i.coefficient as DOUBLE PRECISION),
        CAST(i.rang as INT)
    FROM import_coefficient AS i
        JOIN classe AS c    
            ON c.code_classe = i.code_classe
        JOIN matiere AS m 
            ON m.code_matiere = i.code_matiere
    ON CONFLICT DO NOTHING;
END
$$; 

CREATE OR REPLACE FUNCTION delete_coefficient_existant(id_classe_input VARCHAR)
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE FROM classe_matiere_coefficient 
        where id_classe = id_classe_input;
END
$$;

CREATE TABLE import_eleve_temporaire(
    id serial primary key,
    numero varchar not null,
    noms varchar not null,
    prenoms varchar not null,
    genre varchar(1) not null,
    dtn varchar not null,
    matricule varchar not null
);

CREATE OR REPLACE FUNCTION insert_unique_eleve()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO eleve (matricule,nom,prenom,genre,dtn,image)
    SELECT DISTINCT
        CAST(i.matricule AS INT),
        i.noms,
        i.prenoms,
        i.genre,
        CAST(i.dtn as DATE),
        i.matricule||'.jpg'
    FROM import_eleve_temporaire AS i
    ON CONFLICT DO NOTHING;
END
$$;

CREATE OR REPLACE FUNCTION delete_import_eleve_temporaire()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE FROM import_eleve_temporaire;
END
$$;

CREATE OR REPLACE FUNCTION insert_unique_eleve_classe(id_classe_input VARCHAR)
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO classe_eleve (id_classe,matricule,numero)
    SELECT DISTINCT
        id_classe_input,
        e.matricule,
        CAST(i.numero as INT)
    FROM import_eleve_temporaire AS i
        JOIN eleve as e 
            ON e.matricule = CAST(i.matricule as INT);
END
$$;

update epreuve set code_epreuve='EXI' where id_epreuve = 'EPR000003'; 
update epreuve set code_epreuve='EXII' where id_epreuve = 'EPR000006'; 
update epreuve set code_epreuve='EXIII' where id_epreuve = 'EPR000009'; 

update classe set code_classe='11e' where id_classe = 'CLS000004'; 
update classe set code_classe='10e' where id_classe = 'CLS000005'; 
update classe set code_classe='9e' where id_classe = 'CLS000006'; 
update classe set code_classe='8e' where id_classe = 'CLS000007'; 
update classe set code_classe='7e' where id_classe = 'CLS000008'; 
update classe set code_classe='1eS' where id_classe = 'CLS000014'; 
update classe set code_classe='1eL' where id_classe = 'CLS000015';
update classe set code_classe='TleA' where id_classe = 'CLS000016'; 
update classe set code_classe='TleC' where id_classe = 'CLS000017'; 
update classe set code_classe='TleD' where id_classe = 'CLS000018';
update classe set code_classe='G2I' where id_classe = 'CLS000019'; 
update classe set code_classe='G2II' where id_classe = 'CLS000020'; 
update classe set code_classe='G2III' where id_classe = 'CLS000021'; 

ALTER TABLE eleve ALTER COLUMN nom TYPE VARCHAR(50);
ALTER TABLE eleve ALTER COLUMN prenom TYPE VARCHAR(50);

CREATE OR REPLACE FUNCTION get_moyenne_matiere(
    id_classe_input varchar, 
    id_matiere_input varchar, 
    id_epreuve_input varchar
)
RETURNS double precision
LANGUAGE plpgsql
AS $$
DECLARE
    moyenne_note double precision;
BEGIN
    SELECT AVG(note) 
    INTO moyenne_note
    FROM v_note_classe
    WHERE id_epreuve = id_epreuve_input 
      AND id_matiere = id_matiere_input 
      AND id_classe = id_classe_input;
    RETURN moyenne_note;
END
$$;

--11/10/2024;

update epreuve set nom_epreuve='PREMIER TRIMESTRE' where id_epreuve = 'EPR000003'; 
update epreuve set nom_epreuve='DEUXIEME TRIMESTRE' where id_epreuve = 'EPR000006'; 
update epreuve set nom_epreuve='TROISIEME TRIMESTRE' where id_epreuve = 'EPR000009';

update classe set nom_classe='12eme' where id_classe = 'CLS000003';
update classe set nom_classe='11eme' where id_classe = 'CLS000004';
update classe set nom_classe='10eme' where id_classe = 'CLS000005';
update classe set nom_classe='9eme' where id_classe = 'CLS000006';
update classe set nom_classe='8eme' where id_classe = 'CLS000007';
update classe set nom_classe='7eme' where id_classe = 'CLS000008';
update classe set nom_classe='6eme' where id_classe = 'CLS000009';
update classe set nom_classe='5eme' where id_classe = 'CLS000010';
update classe set nom_classe='4eme' where id_classe = 'CLS000011';
update classe set nom_classe='3eme' where id_classe = 'CLS000012';
update classe set nom_classe='1ere_S' where id_classe = 'CLS000014';
update classe set nom_classe='1ere_L' where id_classe = 'CLS000015';
update classe set nom_classe='Iere_G2' where id_classe = 'CLS000019';
update classe set nom_classe='IIeme_G2' where id_classe = 'CLS000020';
update classe set nom_classe='IIIeme_G2' where id_classe = 'CLS000021';





CREATE OR REPLACE FUNCTION calculer_moyenne(
    ds1 DOUBLE PRECISION,
    ds2 DOUBLE PRECISION,
    exam DOUBLE PRECISION
) RETURNS DOUBLE PRECISION AS $$
BEGIN
    RETURN 
        CASE 
            WHEN (ds1 > 0 OR ds2 > 0 OR exam > 0) THEN
                (COALESCE(ds1, 0) + COALESCE(ds2, 0) + COALESCE(exam, 0)) / 
                NULLIF(
                    (CASE WHEN ds1 > 0 THEN 1 ELSE 0 END) + 
                    (CASE WHEN ds2 > 0 THEN 1 ELSE 0 END) + 
                    (CASE WHEN exam > 0 THEN 1 ELSE 0 END), 
                0)
            ELSE 
                0 
        END;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_bulletin(
    p_id_epreuve VARCHAR,
    p_matricule INTEGER DEFAULT NULL
)
RETURNS TABLE (
    id_classe CHARACTER(9),
    id_matiere CHARACTER(9),
    nom_matiere VARCHAR,
    matricule INTEGER,
    nom VARCHAR,
    prenom VARCHAR,
    ds1 DOUBLE PRECISION,
    ds2 DOUBLE PRECISION,
    exam DOUBLE PRECISION,
    coefficient DOUBLE PRECISION,
    moyenne DOUBLE PRECISION,
    mc DOUBLE PRECISION
) AS $$
BEGIN
    IF p_id_epreuve = 'EPR000003' THEN
        RETURN QUERY
        SELECT 
            vc.id_classe, 
            vc.id_matiere,
            matiere.nom_matiere,
            vc.matricule, 
            vc.nom,       
            vc.prenom,    
            MAX(CASE WHEN vc.id_epreuve = 'EPR000001' THEN vc.note END) AS ds1,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000002' THEN vc.note END) AS ds2,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000003' THEN vc.note END) AS exam,
            classe_matiere_coefficient.coefficient,
            calculer_moyenne(
                MAX(CASE WHEN vc.id_epreuve = 'EPR000001' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000002' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000003' THEN vc.note END)
            ) AS moyenne,
            (calculer_moyenne(
                MAX(CASE WHEN vc.id_epreuve = 'EPR000001' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000002' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000003' THEN vc.note END)
            ) * classe_matiere_coefficient.coefficient) AS mc
        FROM 
            v_note_classe vc
        JOIN 
            classe_matiere_coefficient ON vc.id_classe = classe_matiere_coefficient.id_classe AND vc.id_matiere = classe_matiere_coefficient.id_matiere
        JOIN
            matiere ON vc.id_matiere=matiere.id_matiere
        WHERE 
            (p_matricule IS NULL OR vc.matricule = p_matricule)
        GROUP BY 
            vc.id_classe, vc.id_matiere, matiere.nom_matiere, vc.matricule, vc.nom, vc.prenom, classe_matiere_coefficient.coefficient, classe_matiere_coefficient.rang
        ORDER BY
            classe_matiere_coefficient.rang;

    ELSIF p_id_epreuve = 'EPR000006' THEN
        RETURN QUERY
        SELECT 
            vc.id_classe, 
            vc.id_matiere,
            matiere.nom_matiere,
            vc.matricule,
            vc.nom,
            vc.prenom,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000004' THEN vc.note END) AS ds1,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000005' THEN vc.note END) AS ds2,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000006' THEN vc.note END) AS exam,
            classe_matiere_coefficient.coefficient,
            calculer_moyenne(
                MAX(CASE WHEN vc.id_epreuve = 'EPR000004' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000005' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000006' THEN vc.note END)
            ) AS moyenne,
            (calculer_moyenne(
                MAX(CASE WHEN vc.id_epreuve = 'EPR000004' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000005' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000006' THEN vc.note END)
            ) * classe_matiere_coefficient.coefficient) AS mc
        FROM 
            v_note_classe vc
        JOIN 
            classe_matiere_coefficient ON vc.id_classe = classe_matiere_coefficient.id_classe AND vc.id_matiere = classe_matiere_coefficient.id_matiere
        JOIN
            matiere ON vc.id_matiere=matiere.id_matiere
        WHERE 
            (p_matricule IS NULL OR vc.matricule = p_matricule)
        GROUP BY 
            vc.id_classe, vc.id_matiere, matiere.nom_matiere, vc.matricule, vc.nom, vc.prenom, classe_matiere_coefficient.coefficient, classe_matiere_coefficient.rang
        ORDER BY
            classe_matiere_coefficient.rang;

    ELSIF p_id_epreuve = 'EPR000009' THEN
        RETURN QUERY
        SELECT 
            vc.id_classe, 
            vc.id_matiere,
            matiere.nom_matiere,
            vc.matricule,
            vc.nom,
            vc.prenom,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000007' THEN vc.note END) AS ds1,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000008' THEN vc.note END) AS ds2,
            MAX(CASE WHEN vc.id_epreuve = 'EPR000009' THEN vc.note END) AS exam,
            classe_matiere_coefficient.coefficient,
            calculer_moyenne(
                MAX(CASE WHEN vc.id_epreuve = 'EPR000007' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000008' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000009' THEN vc.note END)
            ) AS moyenne,
            (calculer_moyenne(
                MAX(CASE WHEN vc.id_epreuve = 'EPR000007' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000008' THEN vc.note END),
                MAX(CASE WHEN vc.id_epreuve = 'EPR000009' THEN vc.note END)
            ) * classe_matiere_coefficient.coefficient) AS mc
        FROM 
            v_note_classe vc
        JOIN 
            classe_matiere_coefficient ON vc.id_classe = classe_matiere_coefficient.id_classe AND vc.id_matiere = classe_matiere_coefficient.id_matiere
        JOIN
            matiere ON vc.id_matiere=matiere.id_matiere
        WHERE 
            (p_matricule IS NULL OR vc.matricule = p_matricule)
        GROUP BY 
            vc.id_classe, vc.id_matiere, matiere.nom_matiere, vc.matricule, vc.nom, vc.prenom, classe_matiere_coefficient.coefficient, classe_matiere_coefficient.rang
        ORDER BY
            classe_matiere_coefficient.rang;
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION delete_classe_eleve(id_classe_var CHAR(9))
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE  FROM classe_eleve WHERE id_classe = id_classe_var ;
END;
$$;

CREATE TABLE detail_epreuve(
    id_epreuve_mere CHAR(9) REFERENCES epreuve(id_epreuve),
    id_epreuve_fille CHAR(9) REFERENCES epreuve(id_epreuve),
    rang INT NOT NULL,
    UNIQUE (id_epreuve_mere,id_epreuve_fille,rang),
    UNIQUE(id_epreuve_fille)
);

INSERT INTO detail_epreuve VALUES
('EPR000003','EPR000001',1),
('EPR000003','EPR000002',2),
('EPR000003','EPR000003',3),
('EPR000006','EPR000004',1),
('EPR000006','EPR000005',2),
('EPR000006','EPR000006',3),
('EPR000009','EPR000007',1),
('EPR000009','EPR000008',2),
('EPR000009','EPR000009',3);
 
CREATE OR REPLACE VIEW v_note_mere AS
SELECT
    v.id_classe,
    v.matricule,
    v.id_matiere,
    c.rang as rang_matiere,
    c.coefficient,
    v.nom,
    v.prenom,
    v.numero,
    d.id_epreuve_mere,
    MAX(CASE WHEN d.rang = 1 THEN d.id_epreuve_fille END) AS id_epreuve_fille_1,
    MAX(CASE WHEN d.rang = 2 THEN d.id_epreuve_fille END) AS id_epreuve_fille_2,
    MAX(CASE WHEN d.rang = 3 THEN d.id_epreuve_fille END) AS id_epreuve_fille_3,
    MAX(CASE WHEN d.rang = 1 THEN v.note END) AS note_1,
    MAX(CASE WHEN d.rang = 2 THEN v.note END) AS note_2,
    MAX(CASE WHEN d.rang = 3 THEN v.note END) AS note_exam,
    CASE 
        WHEN 
            (MAX(CASE WHEN d.rang = 1 AND v.note > 0 THEN 1 ELSE 0 END) +
             MAX(CASE WHEN d.rang = 2 AND v.note > 0 THEN 1 ELSE 0 END) +
             MAX(CASE WHEN d.rang = 3 AND v.note > 0 THEN 1 ELSE 0 END)) > 0
        THEN 
            (
                COALESCE(NULLIF(MAX(CASE WHEN d.rang = 1 AND v.note > 0 THEN v.note END), 0), 0) +
                COALESCE(NULLIF(MAX(CASE WHEN d.rang = 2 AND v.note > 0 THEN v.note END), 0), 0) +
                COALESCE(NULLIF(MAX(CASE WHEN d.rang = 3 AND v.note > 0 THEN v.note END), 0), 0)
            ) / 
            NULLIF(
                MAX(CASE WHEN d.rang = 1 AND v.note > 0 THEN 1 ELSE 0 END) +
                MAX(CASE WHEN d.rang = 2 AND v.note > 0 THEN 1 ELSE 0 END) +
                MAX(CASE WHEN d.rang = 3 AND v.note > 0 THEN 1 ELSE 0 END),
                0
            )
        ELSE NULL
    END AS moyenne,
    CASE 
        WHEN 
            (MAX(CASE WHEN d.rang = 1 AND v.note > 0 THEN 1 ELSE 0 END) +
             MAX(CASE WHEN d.rang = 2 AND v.note > 0 THEN 1 ELSE 0 END) +
             MAX(CASE WHEN d.rang = 3 AND v.note > 0 THEN 1 ELSE 0 END)) > 0
        THEN 
            (
                COALESCE(NULLIF(MAX(CASE WHEN d.rang = 1 AND v.note > 0 THEN v.note END), 0), 0) +
                COALESCE(NULLIF(MAX(CASE WHEN d.rang = 2 AND v.note > 0 THEN v.note END), 0), 0) +
                COALESCE(NULLIF(MAX(CASE WHEN d.rang = 3 AND v.note > 0 THEN v.note END), 0), 0)
            ) / 
            NULLIF(
                MAX(CASE WHEN d.rang = 1 AND v.note > 0 THEN 1 ELSE 0 END) +
                MAX(CASE WHEN d.rang = 2 AND v.note > 0 THEN 1 ELSE 0 END) +
                MAX(CASE WHEN d.rang = 3 AND v.note > 0 THEN 1 ELSE 0 END),
                0
            ) * c.coefficient
        ELSE NULL
    END AS mc

FROM 
    v_note_classe v
JOIN 
    detail_epreuve d ON v.id_epreuve = d.id_epreuve_fille
JOIN 
    classe_matiere_coefficient c ON v.id_classe = c.id_classe
    AND v.id_matiere = c.id_matiere

GROUP BY 
    v.id_classe, v.matricule, v.id_matiere, v.nom, v.prenom, d.id_epreuve_mere, c.rang, c.coefficient,v.numero

ORDER BY 
    v.id_classe, v.matricule, v.id_matiere, d.id_epreuve_mere;

SELECT * FROM v_note_mere WHERE id_classe = 'CLS000003' AND id_matiere = 'MAT000010' AND id_epreuve_mere = 'EPR000003';


CREATE OR REPLACE FUNCTION f_rapport_matiere(
    id_classe_param VARCHAR,
    id_matiere_param VARCHAR,
    id_epreuve_mere_param VARCHAR
)
RETURNS TABLE (
    id_classe CHAR(9),
    matricule INTEGER,
    id_matiere CHAR(9),
    rang_matiere INTEGER,
    nom VARCHAR,
    prenom VARCHAR,
    numero INTEGER,
    id_epreuve_mere CHAR(9),
    note_1 DOUBLE PRECISION,
    note_2 DOUBLE PRECISION,
    note_exam DOUBLE PRECISION,
    coefficient DOUBLE PRECISION,
    moyenne DOUBLE PRECISION,
    mc DOUBLE PRECISION,
    rang BIGINT 
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT
        v.id_classe,
        v.matricule,
        v.id_matiere,
        v.rang_matiere,
        v.nom,
        v.prenom,
        v.numero,
        v.id_epreuve_mere,
        v.note_1,
        v.note_2,
        v.note_exam,
        v.coefficient,
        v.moyenne,
        v.mc,
        RANK() OVER (ORDER BY v.moyenne DESC) AS rang
    FROM v_note_mere v
    WHERE v.id_classe = id_classe_param
      AND v.id_matiere = id_matiere_param
      AND v.id_epreuve_mere = id_epreuve_mere_param;
END;
$$;


SELECT * FROM f_rapport_matiere('CLS000003','MAT000010','EPR000003') WHERE matricule = 1771;

CREATE OR REPLACE VIEW v_detail_epreuve AS
SELECT 
    de.id_epreuve_mere,
    de.id_epreuve_fille,
    de.rang,
    e.nom_epreuve AS nom_epreuve_fille,
    e.code_epreuve AS code_epreuve_fille
FROM
    detail_epreuve de
JOIN 
    epreuve e ON de.id_epreuve_fille = e.id_epreuve;



 CREATE or REPLACE VIEW v_rapport_etudiant_periode AS  SELECT v_note_mere.id_classe,                                                                     
     v_note_mere.matricule,                                                                                                                   
     v_note_mere.nom,                                                                                                                         
     v_note_mere.prenom,                                                                                                                      
     v_note_mere.numero,                                                                                                                      
     v_note_mere.id_epreuve_mere,                                                                                                             
     sum(v_note_mere.coefficient) AS total_coef,                                                                                              
     COALESCE(sum(v_note_mere.mc), (0)::double precision) AS total_note,                                                                      
     ((20)::double precision * sum(v_note_mere.coefficient)) AS point_max,                                                                    
     COALESCE((sum(v_note_mere.mc) / sum(v_note_mere.coefficient)), (0)::double precision) AS moyenne                                         
    FROM v_note_mere                                                                                                                          
   GROUP BY v_note_mere.numero, v_note_mere.id_classe, v_note_mere.id_epreuve_mere, v_note_mere.matricule, v_note_mere.nom, v_note_mere.prenom
   ORDER BY v_note_mere.matricule;

CREATE OR REPLACE FUNCTION f_rapport_etudiant_periode(
    id_classe_param VARCHAR,
    id_epreuve_mere_param VARCHAR
)
RETURNS TABLE (
    id_classe CHAR(9),
    id_epreuve_mere CHAR(9),
    nom VARCHAR,
    prenom VARCHAR,
    numero INTEGER,
    matricule INTEGER,    
    total_coef DOUBLE PRECISION,
    point_max DOUBLE PRECISION,
    total_note DOUBLE PRECISION,
    moyenne DOUBLE PRECISION,
    rang BIGINT 
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
        SELECT 
            v.id_classe,
            v.id_epreuve_mere,
            v.nom,
            v.prenom,
            v.numero,
            v.matricule,
            v.total_coef,
            v.point_max,
            v.total_note,
            v.moyenne,
            RANK() OVER (ORDER BY v.moyenne DESC) as rang
FROM v_rapport_etudiant_periode v
    WHERE v.id_classe = id_classe_param
    AND v.id_epreuve_mere = id_epreuve_mere_param;
END;
$$; 

SELECT * FROM f_rapport_etudiant_periode('CLS000003','EPR000003');


CREATE OR REPLACE FUNCTION f_rapport_global(
    id_classe_param VARCHAR,
    id_epreuve_mere_param VARCHAR
)
RETURNS TABLE (
    id_classe CHAR(9),
    nom_classe VARCHAR,
    id_epreuve_mere CHAR(9),
    nom_epreuve VARCHAR,
    effectif INTEGER,
    moyenne_classe DOUBLE PRECISION
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
        SELECT 
            v.id_classe,
            c.nom_classe,
            v.id_epreuve_mere,
            e.nom_epreuve,
            cast(count(*) as int) as effectif,
            avg(moyenne) as moyenne_classe
FROM v_rapport_etudiant_periode v
JOIN classe c ON c.id_classe = v.id_classe
JOIN epreuve e ON e.id_epreuve = v.id_epreuve_mere
    WHERE v.id_classe = id_classe_param
    AND v.id_epreuve_mere = id_epreuve_mere_param
    GROUP BY v.id_classe,v.id_epreuve_mere,c.nom_classe,e.nom_epreuve;
END;
$$;   

SELECT * FROM f_rapport_global('CLS000003','EPR000003');



A changer pour non-classer:
- 





CREATE OR REPLACE VIEW v_note_mere_classee AS
SELECT
    vnm.id_classe,
    vnm.matricule,
    vnm.id_matiere,
    vnm.rang_matiere,
    vnm.coefficient,
    vnm.nom,
    vnm.prenom,
    vnm.numero,
    vnm.id_epreuve_mere,
    vnm.id_epreuve_fille_1,
    vnm.id_epreuve_fille_2,
    vnm.id_epreuve_fille_3,
    vnm.note_1,
    vnm.note_2,
    vnm.note_exam,
    vnm.moyenne,
    vnm.mc
FROM v_note_mere vnm
WHERE vnm.note_exam != 0
AND vnm.matricule IN (
    SELECT matricule
    FROM v_note_mere
    WHERE note_exam != 0
    GROUP BY matricule
    HAVING COUNT(DISTINCT id_matiere) = (
        SELECT COUNT(DISTINCT id_matiere)
        FROM v_note_mere
        WHERE matricule = v_note_mere.matricule
    )
);

CREATE OR REPLACE FUNCTION v_eleve_classee(
    id_classe_param VARCHAR,
    id_epreuve_mere_param VARCHAR
)
RETURNS TABLE(
    matricule INTEGER,
    nom VARCHAR,
    prenom VARCHAR,
    numero INTEGER,
    id_classe CHAR(9)
) AS
$$
BEGIN
    RETURN QUERY
    SELECT DISTINCT
        e.matricule, 
        e.nom, 
        e.prenom,
        e.numero,
        e.id_classe
    FROM v_note_mere e
    WHERE e.matricule NOT IN (
        SELECT vnm.matricule
        FROM v_note_mere vnm
        WHERE vnm.note_exam = 0 AND id_epreuve_mere = id_epreuve_mere_param
        AND vnm.id_classe = id_classe_param
        GROUP BY vnm.matricule
    )
    ORDER BY e.numero;
END;
$$
LANGUAGE plpgsql;
