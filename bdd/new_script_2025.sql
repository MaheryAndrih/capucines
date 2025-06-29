ALTER TABLE public.note DROP CONSTRAINT note_note_check;
ALTER TABLE public.note ADD CONSTRAINT note_check CHECK ((note <= (20)::double precision));
ALTER TABLE public.import_note ALTER COLUMN note DROP NOT NULL;

CREATE OR REPLACE FUNCTION public.insert_unique_note()
 RETURNS void
 LANGUAGE plpgsql
AS $function$
BEGIN
    INSERT INTO note (id_note,id_classe,matricule,id_epreuve,id_matiere,note)
    SELECT DISTINCT
        'NTE' || RIGHT('000000' || nextval('note_seq'), 6),
        c.id_classe,
        CAST(i.matricule as INT),
        e.id_epreuve,
        m.id_matiere,
        COALESCE(CAST(i.note as DOUBLE PRECISION), (0)::DOUBLE PRECISION)
    FROM import_note AS i
        JOIN classe AS c    
            ON c.code_classe = i.code_classe
        JOIN epreuve AS e 
            ON e.code_epreuve = i.code_epreuve
        JOIN matiere AS m 
            ON m.code_matiere = i.code_matiere
    WHERE TRIM(i.note) IS NOT NULL AND TRIM(i.note) <> ''
    ON CONFLICT DO NOTHING;
END
$function$
;

-- DROP FUNCTION public.get_bulletin(varchar, int4);

CREATE OR REPLACE FUNCTION public.get_bulletin(p_id_epreuve character varying, p_matricule integer DEFAULT NULL::integer)
 RETURNS TABLE(id_classe character, id_matiere character, nom_matiere character varying, matricule integer, nom character varying, prenom character varying, ds1 double precision, ds2 double precision, exam double precision, coefficient double precision, moyenne double precision, mc double precision)
 LANGUAGE plpgsql
AS $function$
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
            CASE 
                WHEN calculer_moyenne(
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000001' THEN vc.note END),
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000002' THEN vc.note END),
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000003' THEN vc.note END)
                ) = 0 THEN 0
                ELSE classe_matiere_coefficient.coefficient 
            END AS coefficient,
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
            CASE 
                WHEN calculer_moyenne(
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000004' THEN vc.note END),
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000005' THEN vc.note END),
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000006' THEN vc.note END)
                ) = 0 THEN 0
                ELSE classe_matiere_coefficient.coefficient 
            END AS coefficient,
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
            CASE 
                WHEN calculer_moyenne(
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000007' THEN vc.note END),
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000008' THEN vc.note END),
                    MAX(CASE WHEN vc.id_epreuve = 'EPR000009' THEN vc.note END)
                ) = 0 THEN 0
                ELSE classe_matiere_coefficient.coefficient 
            END AS coefficient,
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
$function$
;

--------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION public.get_bulletin(p_id_epreuve character varying, p_matricule integer DEFAULT NULL::integer)
 RETURNS TABLE(id_classe character, id_matiere character, nom_matiere character varying, matricule integer, nom character varying, prenom character varying, ds1 double precision, ds2 double precision, exam double precision, coefficient double precision, moyenne double precision, mc double precision)
 LANGUAGE plpgsql
AS $function$
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
            classe_matiere_coefficient.coefficient AS coefficient,
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
            classe_matiere_coefficient.coefficient AS coefficient,
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
            classe_matiere_coefficient.coefficient AS coefficient,
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
$function$
;


CREATE OR REPLACE FUNCTION public.f_rapport_etudiant_annuel(id_classe_param character varying)
 RETURNS TABLE(
    id_classe character, 
    nom character varying, 
    prenom character varying, 
    numero integer, 
    matricule integer, 
    note_1 double precision, 
    note_2 double precision,
    note_3 double precision,
    note_passage double precision,
    rang BIGINT
)
 LANGUAGE plpgsql
AS $function$
BEGIN
    RETURN QUERY
        SELECT 
            v.id_classe,
            v.nom,
            v.prenom,
            v.numero,
            v.matricule,
            MAX(CASE WHEN v.id_epreuve_mere = 'EPR000003' THEN v.moyenne END) AS note_1,
            MAX(CASE WHEN v.id_epreuve_mere = 'EPR000006' THEN v.moyenne END) AS note_2,
            MAX(CASE WHEN v.id_epreuve_mere = 'EPR000009' THEN v.moyenne END) AS note_3,
            calculer_moyenne(
                MAX(CASE WHEN v.id_epreuve_mere = 'EPR000003' THEN v.moyenne END),
                MAX(CASE WHEN v.id_epreuve_mere = 'EPR000006' THEN v.moyenne END),
                MAX(CASE WHEN v.id_epreuve_mere = 'EPR000009' THEN v.moyenne END)
            ) AS note_passage,
            RANK() OVER 
                (ORDER BY 
                    (calculer_moyenne
                        (
                            MAX(CASE WHEN v.id_epreuve_mere = 'EPR000003' THEN v.moyenne END),
                            MAX(CASE WHEN v.id_epreuve_mere = 'EPR000006' THEN v.moyenne END),
                            MAX(CASE WHEN v.id_epreuve_mere = 'EPR000009' THEN v.moyenne END)
                        )
                    ) DESC
                ) 
            as rang
FROM v_rapport_etudiant_periode v
    WHERE v.id_classe = id_classe_param
    GROUP BY v.id_classe, v.nom, v.prenom, v.numero, v.matricule;
END;
$function$
;

SELECT * FROM f_rapport_etudiant_annuel('CLS000003') WHERE matricule = 1771;
