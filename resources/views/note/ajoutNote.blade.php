@extends('template.template')

@section('pageTitle', 'Ajout note')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><small>Note</small></a></li>
            <li class="breadcrumb-item active"><a href="selectionNote.html"><small>Ajout</small></a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
@endsection

@section('main-content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Ajouter Note</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('note.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="model" value="ImportNote">
            <input type="hidden" name="id_classe" value="{{ $classes[0]->id_classe }}">
            <input type="hidden" name="id_matiere" value="{{ $classes[0]->id_matiere }}">
            <input type="hidden" name="id_epreuve" value="{{ $classes[0]->id_epreuve }}">
            <div class="card-body">
              <div class="form-group">
                <label for="inputAnneeScolaire">Annee Scolaire</label>
                <input type="text" class="form-control" id="inputAnneeScolaire" placeholder="2024-2025" disabled>
              </div>
              <div class="form-group">
                <label>Classe</label>
                <select class="form-control" name="id_classe" id="classeSelect">
                  @foreach($classes as $classe)
                      <option value="{{ $classe->id_classe }}" >
                        {{ $classe->code_classe }}
                      </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Matiere</label>
                <select class="form-control" name="id_matiere" id="matiereSelect">
                  <option value="">-- Sélectionnez une matière --</option>
                  @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id_matiere }}">{{ $matiere->code_matiere }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Epreuve</label>
                <select class="form-control" name="id_epreuve" id="epreuveSelect">
                  <option value="">-- Sélectionnez une epreuve --</option>
                  @foreach($epreuves as $epreuve)
                    <option value="{{ $epreuve->id_epreuve }}">{{ $epreuve->code_epreuve }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Importer</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                    <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                  </div>
                </div>
              </div>
              @error('error')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
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

        $.ajax({
          url: '/login/getEpreuves/' + classeId,
          type: 'GET',
          success: function(data) {
            var epreuveSelect = $('#epreuveSelect');
            epreuveSelect.empty();  // Vider les options actuelles
            epreuveSelect.append('<option value="">-- Sélectionnez une epreuve --</option>');
            
            // Boucle pour ajouter les nouvelles matières
            $.each(data, function(key, epreuve) {
              epreuveSelect.append('<option value="' + epreuve.id_epreuve + '">' + epreuve.code_epreuve + '</option>');
            });
          }
        });
      });
    });
  </script>
   
@endsection
