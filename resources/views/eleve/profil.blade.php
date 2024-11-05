@extends('template.template')

@section('pageTitle', 'Liste Eleve Classe')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><small>ELEVE</small></a></li>
              <li class="breadcrumb-item active"><small>PROFIL</small></li>
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('assets/dist/img/user4-128x128.jpg') }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $eleve->nom }}</h3>
                <p class="text-muted text-center">{{ $eleve->prenom }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Classe</b> <a class="float-right">{{ $eleve->nom_classe }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Genre</b> <a class="float-right">{{ $eleve->genre }}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#info" data-toggle="tab">Information Personnels</a></li>
                  <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">Parents</a></li>
                  <li class="nav-item"><a class="nav-link" href="#sanction" data-toggle="tab">Sanctions</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="info">
                    <form action="/modifier_eleve_info1" method="post" class="form-horizontal">
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nom" value="{{ $eleve->nom }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Prenom</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="prenom" value="{{ $eleve->prenom }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Naissance</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="dtn" value="{{ $eleve->dtn }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Genre</label>
                        <div class="col-sm-10">
                          @if($eleve->genre=="M")
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="genre" value="M" checked>
                              <label class="form-check-label">Masculin</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="genre" value="F">
                              <label class="form-check-label">Féminin</label>
                            </div>
                          @else
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="genre" value="M">
                              <label class="form-check-label">Masculin</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="genre" value="F" checked>
                              <label class="form-check-label">Féminin</label>
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <input type="hidden" name="matricule" value="{{ $eleve->matricule }}">
                          <button type="submit" class="btn btn-warning">Modifier</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="parents">
                    <form action="/modifier_eleve_info2" method="post" class="form-horizontal">
                        @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom Père</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nom_pere" value="{{ $eleve->nom_pere }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Profession Père</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="profession_pere" value="{{ $eleve->profession_pere }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Numero Père</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="numero_pere" value="{{ $eleve->numero_pere }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nom Mère</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nom_mere" value="{{ $eleve->nom_mere }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Profession Mère</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="profession_mere" value="{{ $eleve->profession_mere }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Numero Mère</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="numero_mere" value="{{ $eleve->numero_mere }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <input type="hidden" name="matricule" value="{{ $eleve->matricule }}">
                          <button type="submit" class="btn btn-warning">Modifier</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="sanction">
                    <div class="row">
                      <div class="col-md-6">
                        <form action="/add_sanction" method="post">
                          @csrf
                          <label>Motif</label>
                          <select class="form-control" name="motif">
                            <option value="Retard">Retard</option>
                            <option value="Absence">Absence</option>
                            <option value="Discipline">Discipline</option>
                            <option value="Travail">Travail</option>
                          </select>
                          <br/>
                          <input type="hidden" name="matricule" value="{{ $eleve->matricule }}">
                          <button type="submit" class="btn btn-primary">Ajouter</button> 
                        </form>
                      </div>
                      <div class="col-md-6">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Motif</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($sanctions as $sanction)
                              <tr>
                                <td>{{ $sanction->date_sanction }}</td>
                                <td>{{ $sanction->motif }}</td>
                                <form action="/deleteSanction" method="post">
                                    @csrf
                                    <input type="hidden" name="matricule" value="{{ $eleve->matricule }}">
                                    <input type="hidden" name="sanction" value="{{ $sanction->id_sanction }}">
                                    <td><button type="submit" class="btn btn-danger">Supprimer</button></td>
                                </form>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
