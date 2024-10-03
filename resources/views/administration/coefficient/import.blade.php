@extends('template.template')

@section('pageTitle', 'Import Coefficient')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><small>Administration</small></a></li>
            <li class="breadcrumb-item active"><a href="consulter_coef.html"><small>Import Coefficient</small></a></li>
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
            <h3 class="card-title">Import coefficients</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('coefficient.import') }}" method="POST" enctype="multipart/form-data">
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
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                        <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                        <input type="hidden" value="ImportCoefficient" name="model">
                    </div>
                </div>
                @error('error')
                  <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
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

@section('jsPerso')
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
@endsection