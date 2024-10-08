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
                  <div class="card-tools">
                    <form action="/search_eleve_class" method="post">
                      @csrf
                      <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <input type="hidden" name="id_classe" value="{{ $classe->id_classe }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                      </div>
                    </form>
                  </div>
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
                      <th>DS1</th>
                      <th>DS2</th>
                      <th>Examen I</th>
                      <th>DS3</th>
                      <th>DS4</th>
                      <th>Examen II</th>
                      <th>DS5</th>
                      <th>DS6</th>
                      <th>Examen III</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($eleves as $eleve)
                    <tr>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->numero }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->matricule }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->nom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->prenom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000001') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000002') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000003') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000004') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000005') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000006') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000007') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000008') }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->getNote('EPR000009') }}</a></td>
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
