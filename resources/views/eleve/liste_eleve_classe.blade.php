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
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="modal" data-target="#modal-sm">Importer</a>
            </li>
          </ul>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Liste des élèves en {{ $classe->nom_classe }}</h3>
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
                      <th>NUMERO</th>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      <th>GENRE</th>
                      <th>NAISSANCE</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($eleves as $eleve)
                    <tr>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->matricule }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->numero }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->nom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->prenom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->genre }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $eleve->matricule }}" style="color: inherit">{{ $eleve->dtn }}</a></td>
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


@section('modal')
  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Classe Eleve</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/importClasseEleve" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="card-body">
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                  <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                  <input type="hidden" name="id_classe" value="{{ $classe->id_classe }}">
                  <input type="hidden" value="ImportCoefficient" name="model">
              </div>
              </div>
            </div>
          </div>
          @error('error')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning">Importer</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('jsPerso')
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
@endsection