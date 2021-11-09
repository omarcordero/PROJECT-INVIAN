<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invian</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <!-- Css -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">INVIAN</a>

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Mis Empresas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="pt-4">
        <div class="col-lg-10 mx-auto">
            <div class="row">
                <div class="col-lg-3 pt-4">
                    <div class="pt-2">
                        <div class="card card-body shadow">
                            <div class="avatar-img text-center pt-2">
                                <img src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png"
                                    width="30%" heigth="30%">
                            </div>
                            <div class="text-center pt-2">
                                <h3>Bienvenido usuario</h3>
                            </div>
                            <hr>
                            <div class="sidebar-option">
                                <h5>
                                    <a href="{{ url('/empresas') }}" class="text-dark">
                                        Mis Empresas
                                    </a>
                                </h5>
                            </div>
                            <div class="col-lg-9 mx-auto">
                                <hr>
                            </div>
                            <div class="sidebar-option">
                                <h5>
                                    <a href="{{ url('/categorias') }}" class="text-dark">
                                        Mis categorías
                                    </a>
                                </h5>
                            </div>
                            <div class="col-lg-9 mx-auto">
                                <hr>
                            </div>
                            <div class="sidebar-option">
                                <h5>
                                    <a href="{{ url('/usuarios') }}" class="text-dark">
                                        Mis usuarios
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">

                    @section('title')

                    @show

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    
    <br>
    <div class="pt-4"></div>
    <hr>
    <footer class="text-center text-lg-start">

        <div class="text-center p-3">
            © 2020 Copyright - Todos los derechos reservados - 
            <a class="text-primary" href="javascript:void(0)">Omar Cordero</a>
        </div>

    </footer>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    </script>
    @section('script')

    @show


</body>

</html>