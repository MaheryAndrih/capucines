@extends('template.template')

@section('pageTitle', 'Liste Eleve Classe')

@section('content-header')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/to_generer_bulletin"><small>BULLETINS</small></a></li>
            <li class="breadcrumb-item active"><a href="/to_rang_matiere"><small>RAPPORT RANG MATIERE</small></a></li>
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
                <h3 class="card-title">{{ $classe->nom_classe }} - {{ $matiere->nom_matiere }} - {{ $epreuve->nom_epreuve }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>N</th>
                      <th>N Mat</th>
                      <th>NOM</th>
                      <th>PRENOM</th>
                      @foreach ($details_epreuve as $detail_epreuve )
                        <th>{{ $detail_epreuve->code_epreuve_fille }}</th>
                      @endforeach
                      <th>Coefficient</th>
                      <th>MOYENNE</th>
                      <th>mc</th>
                      <th>rang</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rapport_matiere as $rapport )
                      <tr>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->numero }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->matricule }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit; font-size: smaller">{{ $rapport->nom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit; font-size: smaller">{{ $rapport->prenom }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->note_1 }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->note_2 }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->note_exam }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->coefficient }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->moyenne }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->mc }}</a></td>
                        <td><a href="/to_profil_eleve/{{ $rapport->matricule }}" style="color: inherit">{{ $rapport->rang }}</a></td>
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
