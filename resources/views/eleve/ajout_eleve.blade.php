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
          <div class="col-md-6 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter un élève</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                    <div class="form-group">
                      <label for="inputAnneeScolaire">Année Scolaire</label>
                      <input type="text" class="form-control" id="inputAnneeScolaire" placeholder="2024-2025" disabled>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nom</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Prénom</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="">
                  </div>
                </div>
                <!-- /.card-body -->
                
                </form>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
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