@extends('template.template')

@section('pageTitle', 'Liste Eleve Classe')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><small>Administration</small></a></li>
              <li class="breadcrumb-item active"><small>Utilisateur</small></li>
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
                <h3 class="card-title">Liste des eleves en {{ $classe->nom_classe }}</h3>
                  <div class="card-tools">
                    <form action="/search_eleve_class" method="post">
                      @csrf
                      <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <input type="hidden" name="id_classe" value="{{ $id_classe }}">
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
                      <th>MATRICULE</th>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      <th>GENRE</th>
                      <th>NAISSANCE</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($eleves as $eleve)
                    <tr>
                        <td><a href="/to_profil_eleve/{{ $eleve->id_eleve }}" style="color: inherit">{{ $eleve->id_eleve }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->id_eleve }}" style="color: inherit">{{ $eleve->nom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->id_eleve }}" style="color: inherit">{{ $eleve->prenom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->id_eleve }}" style="color: inherit">{{ $eleve->genre }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->id_eleve }}" style="color: inherit">{{ $eleve->dtn }}</a></td>
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
