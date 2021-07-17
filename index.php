<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
    <script src="operaciones.js"></script>

    <title>Proyecto Andes</title>
</head>

<body>
    <div class="jumbotron text-center">
        <h1>Proyecto Andes</h1>
        <ul class="nav justify-content-center" id="nav_list" style="display: none;">
            <li class="nav-item">
                <a class="nav-link" onclick="get_info('client')">Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="get_info('users')">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="get_info('cities')">Cities</a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="alert alert-success" id="alert_login_ok" style="display: none;text-align: center;">
            <strong>Bienvenido!</strong> Ingreso correcto.
        </div>
        <div class="alert alert-danger" id="alert_login_fail" style="display: none;text-align: center;">
            <strong>Error!</strong> Por favor revise sus credenciales.
        </div>
        <div style="width: 100%;text-align: center;" id="loader">
            <br>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-success"></div>
            <br>
        </div>
        <div class="row" id="login_tmp">

            <div class="card" style="width:400px">
                <img class="card-img-top" src="https://filminvalle.com/wp-content/uploads/2019/10/User-Icon.png" alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <div class="card-text">
                        <form id="login_form">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name="email" value="prueba1@prueba.com">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-fw fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" name="pwd" value="1234567">
                            </div>
                        </form>
                    </div>
                    <a onclick="login()" class="btn btn-primary">Ingresar</a>
                </div>
            </div>
            <br>
        </div>
        <div class="row" id="login_tmp">

        </div>
        <div class="row">
            <div id="tablas" class="col-12"></div>
        </div>
    </div>

    <div>
        <div class="modal" id="modal_acc">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title_modal">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="body_modal"> </div>
                    <div class="modal-footer" id="footer_modal"> </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php 
include 'server.php';
?>