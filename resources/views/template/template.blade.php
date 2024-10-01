<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('pageTitle')</title>
        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"
        />
        <link rel="icon" href="{{ asset('assets/dist/img/logo2.jpeg') }}" type="image/x-icon">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />

        <!-- Style Perso -->
        @yield('stylePerso')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- warpper -->
        <div class="wrapper">
            <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="{{ asset('assets/dist/img/logo2.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">CAPUCINES</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-header">NOTES</li>
                    <li class="nav-item">
                        <a href="{{ route('note.ajout') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Ajout note</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login.acceuil') }}" class="nav-link active" method="post">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Liste note</p>
                        </a>
                    </li>
                    <li class="nav-header">BULLETINS</li>
                    <li class="nav-item">
                        <a href="/to_generer_bulletin" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Generer bulletin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../bulletin/selectionBulletin.html" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Liste bulletin</p>
                        </a>
                    </li>
                    <li class="nav-header">ADMINISTRATION</li>
                    <li class="nav-item">
                        <a href="/to_liste_utilisateur" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Utilisateur</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Etudiant
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/to_ajout_eleve" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ajout étudiant</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/to_eleve_classe" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classe</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/to_eleve" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Eleve</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('coefficient.choixClasse') }}" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>Coefficient</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('coefficient.showImport') }}" class="nav-link">
                            <i class="nav-icon far fa-square"></i>
                            <p>Import Coefficient</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('import.showImport') }}" class="nav-link">
                            <i class="nav-icon far fa-square"></i>
                            <p>Import</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content-header')
        <!-- /.content-header -->

        <!-- Main content -->
        @yield('main-content')
        <!-- nain-content -->
    </div>
    <!-- /.content-wrapper -->
    @yield('modal')
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2024 <a href="#">Lycee Les Capucines</a>.</strong>
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>

    @yield('jsPerso')
    </body>
</html>
