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
            <div class="card-header">
            <h5 class="m-0">Liste des bulletins</h5>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-8">
                <button type="button" class="btn btn-block btn-success btn-xs bouton-export" style="margin-top: 15%;" data-toggle="modal" data-target="#modal-sm">Generer</button>
                </div>
                <div class="col-4 petite-interligne">
                <p>Annee scolaire : 2024-2025</p>
                <p>Libelle : DS 1</p>
                <p>Classe : Terminale S</p>
                <p>Nombre d'eleves : 35</p>
                <p>Moyenne : 16,32/20</p>
                </div>
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
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Moyenne</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form action="{{ route('export.apercu') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <tr>
                                <td>183</td>
                                <td>John</td>
                                <td>Doe</td>
                                <td>17/20</td>
                                <td><button type="submit" class="btn btn-block bg-gradient-info btn-xs">Apercu</button></td>
                            </tr>
                        </form>
                        <tr>
                            <td>278</td>
                            <td>Miles</td>
                            <td>Davies</td>
                            <td>17.25/20</td>
                            <td><button type="button" class="btn btn-block bg-gradient-info btn-xs">Apercu</button></td>
                        </tr>
                        <tr>
                            <td>183</td>
                            <td>RAMAKAVELO</td>
                            <td>Anjara Tia</td>
                            <td>12.25/20</td>
                            <td><button type="button" class="btn btn-block bg-gradient-info btn-xs">Apercu</button></td>
                        </tr>
                        <tr>
                            <td>278</td>
                            <td>SOMBIRALITERA</td>
                            <td>Jhony</td>
                            <td>15.5/20</td>
                            <td><button type="button" class="btn btn-block bg-gradient-info btn-xs">Apercu</button></td>
                        </tr>
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
