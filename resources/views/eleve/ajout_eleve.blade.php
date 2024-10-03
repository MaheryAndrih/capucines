@extends('template.template')

@section('pageTitle', 'Ajout Eleve')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><small>Eleve</small></a></li>
            <li class="breadcrumb-item active"><small>Ajout étudiant</small></li>
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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter un élève</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/ajouter_eleve" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAnneeScolaire">Année Scolaire</label>
                        <input type="text" class="form-control" id="inputAnneeScolaire" placeholder="2024-2025" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nom</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nom" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Prénom</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="prenom" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Date de naissance</label>
                        <input type="date" name="dtn" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Classe</label>
                        <select class="form-control" name="id_classe">
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id_classe }}">{{ $classe->code_classe }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Numero</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="numero" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Genre</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genre" value="M" required>
                          <label class="form-check-label">Masculin</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="genre" value="F" required>
                          <label class="form-check-label">Féminin</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nom père</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nom_pere">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Profession père</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="profession_pere">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Numéro père</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="numero_pere">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nom mère</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="nom_mere">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Profession mère</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="profession_mere">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Numéro mère</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="numero_mere">
                      </div>
                    </div>
                  </div>
                </div>
                {{ $erreur }}
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
                </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Elève existant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>L'élève Rakoto Jean figure déja dans la base de données.</p>
                <p>Est-ce la bonne personne?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                <button type="button" class="btn btn-success">Oui</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection