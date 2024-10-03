@extends('template.template')

@section('pageTitle', 'Select Classe')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><small>Eleve</small></a></li>
              <li class="breadcrumb-item active"><small>Classe</small></li>
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
                <form action="/select_eleve_classe" method="get">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Classe</label>
                            <select class="form-control" name="id_classe">
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id_classe }}">{{ $classe->code_classe }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Valider">
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