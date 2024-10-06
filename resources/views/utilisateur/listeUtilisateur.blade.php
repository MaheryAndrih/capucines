@extends('template.template')

@section('pageTitle', 'Liste Utilisateur')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><small>ADMINISTRATION</small></a></li>
              <li class="breadcrumb-item active"><small>UTILISATEUR</small></li>
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
                <div class="row">
                  <h3 class="card-title">Liste des Utilisateur</h3>
                </div>
                <br/>
                <div class="row">
                  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-sm">Ajouter</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>NOM</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($utilisateurs as $utilisateur)
                    <div class="col-md-2">
                        <div id="modifUser{{ $utilisateur->id_utilisateur }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modifUser{{ $utilisateur->id }}Title" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modifUser{{ $utilisateur->id }}Title">Modifier un utilisateur</h5>
                                    </div>
                                    <form action="/editUtilisateur" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nom </label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="{{ $utilisateur->username }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mot de passe</label>
                                                <input type="password" class="form-control" id="exampleInputEmail1" name="password" value="{{ $utilisateur->password }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Retour</button>
                                            <input type="hidden" name="id_utilisateur" value="{{ $utilisateur->id_utilisateur }}">
                                            <input type="submit" class="btn  btn-primary" value="Modifier"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td>{{ $utilisateur->id_utilisateur }}</td>
                        <td>{{ $utilisateur->username }}</td>
                        <td><button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modifUser{{ $utilisateur->id_utilisateur }}">Modifier</button></td>
                        <form action="/deleteUtilisateur" method="post">
                            @csrf
                            <input type="hidden" name="id_utilisateur" value="{{ $utilisateur->id_utilisateur }}">
                            <td><button type="submit" class="btn btn-danger">Supprimer</button></td>
                        </form>
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
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Ajouter un utilisateur</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="/addUtilisateur" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nom</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="" name="username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="" name="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
