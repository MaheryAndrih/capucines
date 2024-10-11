@extends('template.template')

@section('pageTitle', 'Liste Eleve Classe')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/to_generer_bulletin"><small>BULLETINS</small></a></li>
            <li class="breadcrumb-item active"><a href="/to_rang_matiere"><small>RAPPORT RANG MATIERE</small></a></li>
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
                <h3 class="card-title">{{ $classe->nom_classe }} - {{ $matiere->nom_matiere }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>NUMERO</th>
                      <th>MATRICULE</th>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      <th>{{ $epreuves[0]->code_epreuve }}</th>
                      <th>{{ $epreuves[1]->code_epreuve }}</th>
                      <th>{{ $epreuves[2]->code_epreuve }}</th>
                      <th>MOYENNE</th>
                      <th>RANG</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                    $rang = 1;
                  @endphp
                  @foreach($eleves as $eleve)
                    <tr>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->numero }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->matricule }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->nom }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->prenom }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote($epreuves[0]->id_epreuve,$matiere->id_matiere) }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote($epreuves[1]->id_epreuve,$matiere->id_matiere) }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote($epreuves[2]->id_epreuve,$matiere->id_matiere) }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getMoyenneMatiere($epreuves,$matiere->id_matiere) }}</a></td>
                      <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $rang }}</a></td>
                    </tr>
                    @php
                      $rang++;
                    @endphp
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
