@extends('template.template')

@section('pageTitle', 'Liste Utilisateur')

@section('content-header')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"><small>BULLETINS</small></a></li>
            <li class="breadcrumb-item active"><small>GENERER</small></li>
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
        <div class="col-md-6 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Generer Bulletin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/genererBulletin" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="inputAnneeScolaire">Annee Scolaire</label>
                    <input type="text" class="form-control" id="inputAnneeScolaire" placeholder="{{ date('Y') }}-{{ date('Y')+1 }}" disabled>
                    </div>
                    <div class="form-group">
                    <label>Examen</label>
                    <select class="form-control" name="id_epreuve">
                        @foreach($epreuves as $epreuve)
                            <option value="{{ $epreuve->id_epreuve }}">{{ $epreuve->nom_epreuve }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label>Classe</label>
                    <select class="form-control" name="id_classe">
                        @foreach($classes as $classe)
                            <option value="{{ $classe->id_classe }}">{{ $classe->nom_classe }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Generer">
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
