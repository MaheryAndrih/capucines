@extends('template.template')

@section('pageTitle', 'Coefficient')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/to_liste_utilisateur"><small>ADMININSTRATION</small></a></li>
            <li class="breadcrumb-item active"><small>CONSULTER COEFFICIENT</small></li>
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
            <h3 class="card-title">Consulter les coefficients</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('coefficient.listeCoefficient') }}" method="GET">
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
              <button type="submit" class="btn btn-primary">Valider</button>
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
@endsection



