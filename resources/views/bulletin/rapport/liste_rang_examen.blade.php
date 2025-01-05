@extends('template.template')

@section('pageTitle', 'Liste Eleve Classe')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/to_generer_bulletin"><small>BULLETINS</small></a></li>
            <li class="breadcrumb-item active"><a href="/to_rang_matiere"><small>RAPPORT RANG EXAMEN</small></a></li>
            <li class="breadcrumb-item active"><small>LISTE</small></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('main-content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{  $rapportGlobal[0]->nom_classe }} / <strong>{{  $rapportGlobal[0]->nom_epreuve }}</strong> / <strong>Moyenne de classe : {{ $rapportGlobal[0]->moyenne_classe }}</strong>
                  / Effectif : {{  $rapportGlobal[0]->effectif }} eleves 
                </h3>
                <div class="card-tools">
                  <button class="btn btn-primary">
                    Generer pdf
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Numero</th>
                      <th>Matricule</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Moyenne</th>
                      <th>Rang</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($resultats as $resultat)
                      <tr>
                        <td><a href="/to_profil_eleve/{{ $resultat->matricule }}" style="color: inherit">{{ $resultat->numero }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $resultat->matricule }}" style="color: inherit">{{ $resultat->matricule }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $resultat->matricule }}" style="color: inherit; font-size: smaller">{{ $resultat->nom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $resultat->matricule }}" style="color: inherit; font-size: smaller">{{ $resultat->prenom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $resultat->matricule }}" style="color: inherit">{{ $resultat->moyenne }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $resultat->matricule }}" style="color: inherit">{{ $resultat->rang }}</a></td>
                      </tr>   
                    @endforeach           
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
