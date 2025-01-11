<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $eleve->numero }}_{{ $eleve->prenom }}_{{ $eleve->nom_classe }}_{{ $epreuve->nom_epreuve }}</title>
    <style>
        body {
            font-family: 'script-mt-bold', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
            padding: 10px 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            display: block;
            height: 35px;
        }
        .school-name {
            float: left;
            line-height: 140%;
        }
        .school-year {
            float: right;
            font-style: italic;
        }
        .title {
            text-align: center;
            margin: 22px 0;
            font-size: 18px;
            font-weight: bold;
        }
        .bulletinTitre{
            margin-top: 5%;
            margin-left: 5%; 
            display: block;
            line-height: 0%;
        }
        .eleve-info{
            width: 90%;
            margin: 0 auto;
            margin-top: 3%;
            /* border: 1px black solid; */

        }

        .eleve-info table {
            width: 100%;
            border-collapse: collapse; /* Pour éviter les espaces entre les bordures */
        }

        .eleve-info td{
            padding: 3px;
        }

        .bulletin{
            width: 100%;
            /* border: 1px black solid; */
            height: 100vh;
            margin-top: 3%;
        }

        .bulletin table {
            width: 100%;
            border-collapse: collapse;
        }

        .bulletin td, th {
        border: 1px solid black;
        }

        .th-rotate{
            transform: rotate(90deg); 
            display: inline-block;
            height: 40px;
            width: 2px;
            padding-top: 10px;
            padding-left: 5px; 
        }

        .th-NOTE{
            width: 15px;
        }

        .td-MATIERE{
            padding-left: 10px; 
            text-align: left;
        }

        .bulletin td{
            height: 20px;
            text-align: center;
        }

        .width-note{
            width: 30px;
        }

        .border-top-bottome{
            border-bottom: none;
            border-top:none ;
        }

    </style>
</head>
<body>
    <header class="header">
        <div class="school-name">Lycée privé <span class="script-font" style="font-family: Script Mt Bold">"Les Capucines"</span><br>
            <strong>Lot IIH 13A Ankerana<br></strong>
            <strong>Arreté N&deg; 103/2016-MEN du 14 Mars 2016<br></strong>
            <strong>Arreté N&deg; 16281/2019/MENETP du 09 Août 2019<br></strong>
        </div>
        <div class="school-year">Année scolaire: 2024-2025</div>
    </header>
    <main class="content">
        <div class="bulletinTitre">
            <h1 class="title">BULLETIN DE NOTES</h1>
            <h3 style="font-weight: bold;text-align:center ;line-height: 0.5px">{{ $epreuve->nom_epreuve }}</h3>
        </div>
        <div class="eleve-info">
            <table>
                <tr>
                    <td>Nom:</td>
                    <td>{{ $eleve->nom }}</td>
                    <td>Genre:</td>
                    <td>{{ $eleve->genre }}</td>
                    <td>CLASSE:</td>
                    <td>{{ $eleve->nom_classe }}</td>
                </tr>
                <tr>
                    <td>Prénom(s):</td>
                    <td>{{ $eleve->prenom }}</td>
                    <td>Né(e) le:</td>
                    <td>{{ $eleve->dtn }}</td>
                    <td>Numéro de classe:</td>
                    <td>{{ $eleve->numero }}</td>
                </tr>
                <tr>
                    <td>Matricule:</td>
                    <td>{{ $eleve->matricule }}</td>
                    <td></td>
                    <td></td>
                    <td>Statut:</td>
                    @if($eleve->statut == TRUE)
                        <td>Passant(e)</td>
                    @endif
                    @if($eleve->statut == FALSE)
                        <td>Redoublant(e)</td>
                    @endif
                </tr>
            </table>
        </div>
        <div class="bulletin">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 150px">MATIERE</th>
                        <th colspan="2">TEST PERIODIQUES</th>
                        <th rowspan="2"><span class="th-rotate">EXAM</span></th>
                        <th rowspan="2"><span class="th-rotate">Moyenne</span></th>
                        <th rowspan="2"><span class="th-rotate">Points</span></th>
                        <th rowspan="2"><span class="th-rotate">COEFF</span></th>
                        <th rowspan="2"><span class="th-rotate">M*C</span></th>
                        <th rowspan="2"><span class="th-rotate">RANG</span></th>
                        <th   rowspan="2">APPRECIATIONS</th>
                    </tr>
                    <tr>
                        <th class="th-NOTE">1ere NOTE</th>
                        <th class="th-NOTE">2eme NOTE</th>
                    </tr>ALTER TABLE classe_eleve ADD COLUMN passant BOOLEAN NOT NULL DEFAULT 't';
ALTER TABLE classe_eleve DROP COLUMN passant ;
ALTER TABLE classe_eleve ADD COLUMN statut BOOLEAN NOT NULL DEFAULT 't';
                </thead>
                <tbody>
                    @foreach ($bulletins as $bulletin)
                        <tr>
                            <td class="td-MATIERE" style="text-align: left">{{ $bulletin->nom_matiere }}</td>
                            <td class="width-note">{{ $bulletin->ds1 }}</td>
                            <td class="width-note">{{ $bulletin->ds2 }}</td>
                            <td class="width-note">{{ $bulletin->exam }}</td>
                            <td class="width-note">{{ $bulletin->moyenne }}</td>
                            <td class="width-note">20</td>
                            <td class="width-note">{{ $bulletin->coefficient }}</td>
                            <td class="width-note">{{ $bulletin->mc }}</td>
                            <td class="width-note">{{ $bulletin->rang }}</td>
                            <td class="width-note">{{ $bulletin->appreciation }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="td-MATIERE" style="text-align: center" colspan="6"><strong>Moyenne de classe = {{ $bulletin->rapportGlobal->moyenne_classe }}/20</strong></td>
                        <td class="width-note">{{ $bulletin->rapportEtudiant->total_coef }}</td>
                        <td class="width-note">{{ $bulletin->rapportEtudiant->total_note }}</td>
                        <td style="width: 20px; text-align:left; padding-left:5px;" colspan="2"><strong>RANG: {{ $bulletin->rapportEtudiant->rang }} sur {{ $bulletin->rapportGlobal->effectif }} eleves</strong></td>
                    </tr>
                    <tr>
                        <td class="td-MATIERE" style="text-align: center" colspan="7"><strong>Total des notes obtenues: {{ $bulletin->rapportEtudiant->total_note }} sur {{ $bulletin->rapportEtudiant->point_max }}</strong></td>
                        <td style="text-align:center;" colspan="3"><strong>Moyenne:{{$bulletin->rapportEtudiant->moyenne}} sur 20</strong></td>
                    </tr>
                    <tr>
                        <td  colspan="6" style="text-align: center; border-top:none; border-bottom: none">ABSENCES/RETARDS-SANCTIONS</td>
                        <td colspan="4" style="text-align: center; border-top:none; border-bottom: none">DECISION DU CONSEIL DE CLASSE</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: center; border-top:none; border-bottom: none"></td>
                        <td colspan="4" style="text-align: center; border-top:none; border-bottom: none"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: center; border-top:none; border-bottom: none"></td>
                        <td colspan="4" style="text-align: center; border-top:none; border-bottom: none"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="text-align: center; border-top:none;"></td>
                        <td colspan="4" style="text-align: center; border-top:none;"></td>
                    </tr>
                    {{-- <tr>
                        <td class="td-MATIERE" style="text-align:left; border-right:none">Note 1er trimestre: 17.17</td>
                        <td colspan="3" style="border-left:none; border-right:none">Note 2eme trimestre: 17.49</td>
                        <td style="border-left:none; border-right:none"></td>
                        <td colspan="3" style="border-left:none; border-right:none">Note de passage: 17.15</td>
                        <td colspan="2" style="border-left:none;">Rang annuel: 10eme</td>
                    </tr> --}}
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-bottom:none; text-align:left; border-right:none; ">Signature des Parents</td>
                        <td colspan="4" class="td-MATIERE" style="border-bottom:none; text-align:left; border-left:none">Antananarivo,le {{ $date }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-right:none;"></td>
                        <td colspan="4" class="td-MATIERE" style="border-top:none;border-bottom:none;text-align:left; border-left:none; margin-top:-10%">RAZAFINDRAINIBE Andritsilavo Francky</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-right:none;"></td>
                        <td colspan="4" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-left:none"></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-right:none;"></td>
                        <td colspan="4" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-left:none"></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-right:none;"></td>
                        <td colspan="4" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-left:none"></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-right:none;"></td>
                        <td colspan="4" class="td-MATIERE" style="border-top:none; border-bottom:none;text-align:left; border-left:none"></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="td-MATIERE" style="border-top:none; text-align:left; border-right:none;"></td>
                        <td colspan="4" class="td-MATIERE" style="border-top:none; text-align:left; border-left:none">Directeur</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>VEUILLEZ BIEN CONSERVER CE DOCUMENT, AUCUN DUPLICATA NE SERA DELIVRE</p>
    </footer>
</body>
</html>

