@extends('template.template')

@section('stylePerso')

<link rel="stylesheet" href="{{ asset('assets/plugins/cssPerso/listeNote.css') }}" />

@endsection

@section('pageTitle', 'Liste Utilisateur')

@section('content-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><small>Bulletin</small></a></li>
            <li class="breadcrumb-item active"><a href="selectionBulletin.html"><small>Selection</small></a></li>
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
                <form action="{{ route('bulletin.generer') }}" method="GET" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2">
                                <h5>Liste des bulletins</h5> 
                            </div>
                            <div class="col-2 ml-auto">
                                <input class="form-control form-control-sm" type="date" value="{{ $date }}" name="date" id="dateInput">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <button type="submit" class="btn btn-block btn-success btn-xs bouton-export" style="margin-top: 15%;">
                                    Generer
                                </button>
                                <input type="hidden" value ="{{ $id_classe }}" name="id_classe">
                                <input type="hidden" value ="{{ $id_epreuve }}" name="id_epreuve">
                            </div>
                            <div class="col-4 petite-interligne">
                            <p>Annee scolaire : 2024-2025</p>
                            <p>Libelle : <strong>{{ $rapportGlobal[0]->nom_epreuve }}</strong></p>
                            <p>Classe : <strong>{{ $rapportGlobal[0]->nom_classe }}</strong></p>
                            <p>Nombre d'eleves : <strong>{{ $rapportGlobal[0]->effectif }}</strong></p>
                            <p>Moyenne : <strong>{{ $rapportGlobal[0]->moyenne_classe }}/20</strong></p>
                            </div>
                        </form>
                        </div>
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    </div>
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
                                        <th>Moyenne</th>
                                        <th>Rang</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resultats as $resultat )
                                            <form action="{{ route('export.apercu') }}" method="GET" enctype="multipart/form-data">
                                                @csrf
                                                <tr>
                                                    <td>{{ $resultat->matricule }}</td>
                                                    <td>{{ $resultat->numero }}</td>
                                                    <td>{{ $resultat->nom }}</td>
                                                    <td>{{ $resultat->prenom }}</td>
                                                    <td>{{ $resultat->moyenne }}</td>
                                                    <td>{{ $resultat->rang }}</td>
                                                    <input type="hidden" name="date" id="hiddenDate">
                                                    <input type="hidden" value="{{ $resultat->matricule }}" name="matricule">
                                                    <td><button type="submit" class="btn btn-block bg-gradient-info btn-xs">Apercu</button></td>
                                                </tr>
                                                <input type="hidden" value ="{{ $id_epreuve }}" name="id_epreuve">
                                            </form>
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

@endsection
@section('jsPerso')
<script>
    function updateHiddenDate() {
        // Copie la valeur de dateInput dans hiddenDate
        document.getElementById('hiddenDate').value = document.getElementById('dateInput').value;
    }

    // Exécute la fonction lors du chargement de la page
    window.addEventListener('DOMContentLoaded', (event) => {
        updateHiddenDate(); // Initialise hiddenDate dès le chargement
    });

    // Exécute la fonction chaque fois que dateInput change
    document.getElementById('dateInput').addEventListener('change', updateHiddenDate);
</script>
@endsection
