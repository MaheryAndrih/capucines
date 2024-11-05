@extends('template.template')

@section('pageTitle', 'Liste note')

@section('stylePerso')
  <link rel="stylesheet" href="{{ asset('assets/plugins/cssPerso/listeNote.css') }}" />
@endsection

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('note.ajout') }}"><small>NOTES</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('login.acceuil') }}"><small>SELECTION</small></a></li>
            <li class="breadcrumb-item"><small>Liste</small></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
@endsection

@section('main-content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mx-auto">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Liste des notes</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <button type="button" class="btn btn-block bg-gradient-warning btn-xs bouton-export" data-toggle="modal" data-target="#modela"
                    data-id-classe="{{ $id_classe }}"
                    data-id-epreuve="{{ $id_epreuve }}"
                    data-id-matiere="{{ $id_matiere }}"
                  >
                    Tout supprimer
                  </button>
                </div>                
                <div class="col-4 petite-interligne">
                  <p>Annee scolaire : 2024-2025</p>
                  <p>Libelle :<strong> {{ $nom_epreuve['nom_epreuve'] }}  </strong> </p>
                  <p>Classe :<strong> {{ $nom_classe['nom_classe'] }}  </strong> </p>
                  <p>Matiere :<strong> {{ $nom_matiere['nom_matiere'] }}  </strong> </p>
                  <p>Nombre :<strong> {{ $nbr_eleve }} eleves  </strong> </p>
                  <p>Moyenne :<strong> {{ $moyenne }}/20  </strong> </p>
                </div>
              </div>
              <div class="row" style="margin-top: 2%;">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-tools">
                        <form action="/search_eleve_note" method="post">
                          @csrf
                          <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search">
                            <input type="hidden" name="id_classe" value="{{ $id_classe }}">
                            <input type="hidden" name="id_matiere" value="{{ $id_matiere }}">
                            <input type="hidden" name="id_epreuve" value="{{ $id_epreuve }}">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Matricule</th>
                            <th>Numero</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Note</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($notes as $note)
                            <tr>
                              <td><a href="/to_profil_eleve/{{ $note->matricule }}" style="color: inherit">{{ $note->matricule }}</a></td>
                              <td><a href="/to_profil_eleve/{{ $note->matricule }}" style="color: inherit">{{ $note->numero }}</a></td>
                              <td><a href="/to_profil_eleve/{{ $note->matricule }}" style="color: inherit">{{ $note->nom }}</a></td>
                              <td><a href="/to_profil_eleve/{{ $note->matricule }}" style="color: inherit">{{ $note->prenom }}</a></td>
                              <td><a href="/to_profil_eleve/{{ $note->matricule }}" style="color: inherit">{{ $note->note }}/20</a></td>
                              <td>
                                <button type="button" class="btn btn-block bg-gradient-info btn-xs" data-toggle="modal" data-target="#modal-sm"
                                  data-nom = "{{ $note->nom }}"
                                  data-prenom = "{{ $note->prenom }}"
                                  data-note = "{{ $note->note }}"
                                  data-id-classe = "{{ $note->id_classe }}"
                                  data-id-matiere = "{{ $note->id_matiere }}"
                                  data-id-eleve = "{{ $note->matricule }}"
                                  data-id-epreuve = "{{ $note->id_epreuve }}"
                                >
                                  Modifier
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
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
@endsection

@section('modal')
<div class="modal fade" id="modal-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ajouter note</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('note.updateOrInsertNote') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="card-body">
              <div class="form-group">
                <label for="inputNom">Nom</label>
                <input type="text" class="form-control" id="inputNom" disabled>
              </div>
              <div class="form-group">
                <label for="inputPrenom">Prenom</label>
                <input type="text" class="form-control" id="inputPrenom" disabled>
              </div>
              <div class="form-group">
                <label for="inputNote">Note</label>
                <input type="text"  class="form-control" name="new_note" id="inputNote" required>
              </div>
              <input type="hidden" id="inputIdClasse" name="id_classe">
              <input type="hidden" id="inputIdMatiere" name="id_matiere">
              <input type="hidden" id="inputIdEleve" name="id_eleve">
              <input type="hidden" id="inputIdEpreuve" name="id_epreuve">

            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submint" class="btn btn-warning">Modifier</button>
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
        <h4 class="modal-title">Supprimer tout les notes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('note.delete') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="card-body">
            <p>Cette action supprimera tout les notes de la classe <strong></strong></p>
            <input type="hidden" id="inputIdClasse" name="id_classe">
            <input type="hidden" id="inputIdMatiere" name="id_matiere">
            <input type="hidden" id="inputIdEpreuve" name="id_epreuve">
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
@endsection

@section('jsPerso')
  <script>
    $('#modal-sm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Bouton qui déclenche le modal
      var nom = button.data('nom'); // Récupère le code_matiere
      var prenom = button.data('prenom'); 
      var note = button.data('note');
      var idClasse = button.data('id-classe');
      var idMatiere = button.data('id-matiere');
      var idEleve = button.data('id-eleve');
      var idEpreuve = button.data('id-epreuve');


      var modal = $(this);
      modal.find('#inputNom').val(nom); // Injecte code_matiere comme placeholder
      modal.find('#inputPrenom').val(prenom);
      modal.find('#inputNote').val(note);
      modal.find('#inputIdClasse').val(idClasse);
      modal.find('#inputIdMatiere').val(idMatiere);
      modal.find('#inputIdEleve').val(idEleve);
      modal.find('#inputIdEpreuve').val(idEpreuve);
    });

    $('#modela').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var idClasse = button.data('id-classe');
      var idMatiere = button.data('id-matiere');
      var idEpreuve = button.data('id-epreuve');

      var modal = $(this);
      modal.find('#inputIdClasse').val(idClasse);
      modal.find('#inputIdMatiere').val(idMatiere);
      modal.find('#inputIdEpreuve').val(idEpreuve);
    });
  </script>
@endsection

