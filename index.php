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
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" onclick="get_info('client')">Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="get_info('users')">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="get_info('cities')">Cities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">Login</a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="row">

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

