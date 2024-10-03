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

create table matiere(
    id_matiere char(9) primary key,
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

create table classe_eleve(
    id_classe char(9) references classe(id_classe),
    matricule int references eleve(matricule),
    numero int,
    unique(matricule)
);

create table classe_matiere_coefficient(
    id_classe char(9) references classe(id_classe) not null,
    id_matiere char(9) references matiere(id_matiere) not null,
    coefficient double precision not null check(coefficient >= 0.5),
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
('CLS000006', 'EPR000009');

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

CREATE or REPLACE View v_eleve as
    select eleve.*,COALESCE(classe_eleve.id_classe,'NULL') as id_classe,COALESCE(classe.nom_classe,'NON-CLASSEE') as nom_classe, classe_eleve.numero
    from classe_eleve full join eleve on classe_eleve.matricule=eleve.matricule
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
        m.code_matiere,
        cm.coefficient
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
    code_classe varchar not null,
    code_matiere varchar not null,
    matricule varchar not null,
    nom varchar not null,
    prenom varchar not null,
    note varchar not null,
    unique(,code_classe,code_matiere,id_eleve)
);

CREATE OR REPLACE FUNCTION delete_import_note()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE  from import_note;
END;
$$;

drop table import_note;

CREATE TABLE import_note (
    id serial primary key,
    code_epreuve varchar not null,
    code_classe varchar not null,
    code_matiere varchar not null,
    id_eleve varchar not null,
    nom varchar not null,
    prenom varchar not null,
    note varchar not null,
    unique(code_epreuve,code_classe,code_matiere,id_eleve)
);


CREATE OR REPLACE FUNCTION insert_unique_note()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO note (id_note,id_classe,id_eleve,id_epreuve,id_matiere,note)
    SELECT DISTINCT
        'NTE' || RIGHT('000000' || nextval('note_seq'), 6),
        c.id_classe,
        i.id_eleve,
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

CREATE OR REPLACE FUNCTION delete_import_coefficient()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    DELETE  from import_coefficient;
END;
$$;

CREATE OR REPLACE FUNCTION insert_unique_coefficient()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO classe_matiere_coefficient(id_classe,id_matiere,coefficient)
    SELECT
        c.id_classe,
        m.id_matiere,
        CAST(i.coefficient as DOUBLE PRECISION)
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
    matricule varchar not null,
);

CREATE OR REPLACE FUNCTION insert_unique_eleve()
RETURNS void
LANGUAGE plpgsql
AS $$
BEGIN
    INSERT INTO eleve (matricule,nom,prenom,genre,dtn)
    SELECT DISTINCT
        CAST(i.matricule as INT),
        i.noms,
        i.prenoms,
        i.genre,
        CAST(i.dtn as DATE)
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