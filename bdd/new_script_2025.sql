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