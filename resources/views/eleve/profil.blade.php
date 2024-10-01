@extends('template.template')

@section('pageTitle', 'Liste Eleve Classe')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><small>Administration</small></a></li>
              <li class="breadcrumb-item active"><small>Etudiant</small></li>
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
                  <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Information Personnels</a></li>
                  <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">Parents</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="info">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" value="{{ $eleve->nom }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Prenom</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="{{ $eleve->prenom }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Naissance</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" value="{{ $eleve->dtn }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-warning">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="parents">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nom Père</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" value="{{ $eleve->nom_pere }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Profession Père</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="{{ $eleve->profession_pere }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Numero Père</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" value="{{ $eleve->numero_pere }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nom Mère</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" value="{{ $eleve->nom_mere }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Profession Mère</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="{{ $eleve->profession_mere }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Numero Mère</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" value="{{ $eleve->numero_mere }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-warning">Modifier</button>
                                </div>
                            </div>
                        </form>
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
