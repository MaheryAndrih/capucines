@extends('template.template')

@section('pageTitle', 'Rapport Matiere')

@section('content-header')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/to_generer_bulletin"><small>BULLETINS</small></a></li>
              <li class="breadcrumb-item active"><small>RAPPORT RANG MATIERE</small></li>
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
            <h3 class="card-title">Sélection Rapport Rang Matière</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/select_rapport_matiere" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label>Epreuve</label>
                <select class="form-control" name="id_epreuve">
                      <option value="1">Examen Trimestriel I</option>
                      <option value="4">Examen Trimestriel II</option>
                      <option value="7">Examen Trimestriel III</option>
                </select>
              </div>
              <div class="form-group">
                <label>Classe</label>
                <select class="form-control" name="id_classe" id="classeSelect">
                    @foreach($classes as $classe)
                      <option value="{{ $classe->id_classe }}" >
                        {{ $classe->nom_classe }}
                      </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Matière</label>
                <select class="form-control" name="id_matiere" id="matiereSelect">
                    <option value="">-- Sélectionnez une matière --</option>
                    @foreach($matieres as $matiere)
                        <option value="{{ $matiere->id_matiere }}">{{ $matiere->code_matiere }}</option>
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

@section('jsPerso')
  
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      $('#classeSelect').change(function() {
        var classeId = $(this).val();
        
        // Requête AJAX pour obtenir les matières
        $.ajax({
          url: '/login/getMatieres/' + classeId,
          type: 'GET',
          success: function(data) {
            var matiereSelect = $('#matiereSelect');
            matiereSelect.empty();  // Vider les options actuelles
            matiereSelect.append('<option value="">-- Sélectionnez une matière --</option>');
            
            // Boucle pour ajouter les nouvelles matières
            $.each(data, function(key, matiere) {
              matiereSelect.append('<option value="' + matiere.id_matiere + '">' + matiere.code_matiere + '</option>');
            });
          }
        });
      });
    });
  </script>
   
@endsection