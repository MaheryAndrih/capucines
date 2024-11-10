@extends('template.template')

@section('pageTitle', 'Coefficient')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/to_liste_utilisateur"><small>ADMINISTRATION</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('coefficient.choixClasse') }}"><small>CONSULTER COEFFICIENT</small></a></li>
            <li class="breadcrumb-item active"><small>LISTE</small></li>
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
                <h3 class="card-title">Liste des Coefficients</h3>
              </div>
              <br/>
              <div class="row">
                <p><button type="submit" class="btn btn-primary" style="margin-left: 9%" data-toggle="modal" data-target="#modely">Importer</button></p>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>RANG</th>
                    <th>MATIERE</th>
                    <th>VALEUR</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($listeCoefficient as $coefficient)
                    <tr>
                      <td>{{ $coefficient->rang }}</td>
                      <td>{{ $coefficient->nom_matiere }}</td>
                      <td>{{ $coefficient->coefficient }}</td>
                      <td>
                        <button type="button" class="btn btn-warning update-coefficient" data-toggle="modal" data-target="#modal-sm" 
                          data-code-matiere="{{ $coefficient->code_matiere }}" 
                          data-id-matiere="{{ $coefficient->id_matiere }}"
                          data-id-classe="{{ $coefficient->id_classe }}"
                          data-coefficient="{{ $coefficient->coefficient }}"
                        >
                          Modifier
                        </button>
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modela"
                          data-id-matiere="{{ $coefficient->id_matiere }}"
                          data-id-classe="{{ $coefficient->id_classe }}"
                          data-code_classe="{{ $classe['code_classe'] }}"
                          data-code_matiere="{{ $coefficient->code_matiere }}"
                        >
                          Supprimer
                        </button>
                      </td>
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
@endsection

@section('modal')
  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Modifier coefficient</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('coefficient.update') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="card-body">
              <div class="form-group">
                <div class="form-group">
                  <label for="inputAnneeScolaire">Matière</label>
                  <input type="text" class="form-control" id="inputAnneeScolaire" placeholder="" disabled>
                  <input type="hidden" id="inputIdMatiere" name="id_matiere">
                  <input type="hidden" id="inputIdClasse" name="id_classe">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Valeur</label>
                <input type="number" class="form-control" id="inputCoefficient" name="coefficient">
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-warning">Modifier</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="modela">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Suppression de matiere</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('coefficient.delete') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="card-body">
              <p>Supprimer la matiere <strong id="inputCodeMatiere"></strong> de la classe <strong id="inputCodeClasse"></strong></p>
              <input type="hidden" id="inputIdClasse" name="id_classe">
              <input type="hidden" id="inputIdMatiere" name="id_matiere">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submint" class="btn btn-warning">Confirmer</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="modely">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import fichier csv</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('coefficient.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="card-body">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                  <label class="custom-file-label" for="exampleInputFile">Choisir le fichier</label>
                  <input type="hidden" value="ImportCoefficient" name="model">
                  <input type="hidden" value="{{ $id_classe }}" name="id_classe">
                </div>
              </div>
            </div>
          </div>
          @error('error')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
            <button type="submint" class="btn btn-warning">Confirmer</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@section('jsPerso')
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script>
    $('#modal-sm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Bouton qui déclenche le modal
      var codeMatiere = button.data('code-matiere'); // Récupère le code_matiere
      var idMatiere = button.data('id-matiere'); 
      var idClasse = button.data('id-classe');
      var coefficient = button.data('coefficient');

      var modal = $(this);
      modal.find('#inputAnneeScolaire').attr('placeholder', codeMatiere); // Injecte code_matiere comme placeholder
      modal.find('#inputIdMatiere').val(idMatiere);
      modal.find('#inputIdClasse').val(idClasse);
      modal.find('#inputCoefficient').val(coefficient);
    });

    $('#modela').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Bouton qui déclenche le modal
      var codeMatiere = button.data('code-matiere'); // Récupère le code_matiere
      var idMatiere = button.data('id-matiere'); 
      var idClasse = button.data('id-classe');
      var code_classe = button.data('code_classe');
      var code_matiere = button.data('code_matiere');

      var modal = $(this);
      modal.find('#inputIdMatiere').val(idMatiere);
      modal.find('#inputIdClasse').val(idClasse);
      modal.find('#inputCodeClasse').text(code_classe);
      modal.find('#inputCodeMatiere').text(code_matiere);
    });
  </script>
@endsection

