@extends('template.template')

@section('pageTitle', 'Rapport Examen')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/to_generer_bulletin"><small>BULLETINS</small></a></li>
              <li class="breadcrumb-item active"><small>RAPPORT RANG EXAMEN</small></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection

@section('main-content')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Sélection Classe</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/select_rapport_examen" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Epreuve</label>
                <select class="form-control" name="id_epreuve">
                    <option value="EPR000003" >Examen Trimestriel I</option>
                    <option value="EPR000006" >Examen Trimestriel II</option>
                    <option value="EPR000009" >Examen Trimestriel III</option>
                </select>
              </div>
              <div class="form-group">
                <label>Classe</label>
                <select class="form-control" name="id_classe">
                    @foreach($classes as $classe)
                      <option value="{{ $classe->id_classe }}" >
                        {{ $classe->nom_classe }}
                      </option>
                    @endforeach
                </select>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

@endsection