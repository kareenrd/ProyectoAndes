var obj = false;
var titulos = [];
var tabla_ = false;

function get_info(tabla) {
    tabla_ = tabla;
    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: 'Q1',
            info: {
                tabla: tabla
            }
        },
        success: function(response) {
            //console.log('response', response);
            var res = JSON.parse(response);
            obj = res;
            //console.log('table', tabla, 'res: ', res);
            var td = '';
            var th = '';
            titulos = [];

            for (var j in res[0]) titulos.push(j);

            for (var k in titulos) {
                th += '<th>' + titulos[k] + '</th>';
            }


            if (tabla == 'client') {
                for (var i in res) {
                    td +=
                        '<tr>' +
                        '<td>' + res[i].id + '</td>' +
                        '<td>' + res[i].codigo + '</td>' +
                        '<td>' + res[i].nombre + '</td>' +
                        '<td>' + res[i].ciudad + '</td>' +
                        '<td style="width: 20%">' +
                        '<button class="btn btn-outline-info " style="margin: 0 5px;" onclick ="edit_info(' + res[i].id + ')"> <i class="fa fa-fw fa-edit"></i></button>' +
                        '<button class="btn btn-outline-danger " style="margin: 0 5px;" onclick ="delete_info(' + res[i].id + ')"><i class="fa fa-fw fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';

                }
            } else if (tabla == 'users') {
                for (var i in res) {
                    td +=
                        '<tr>' +
                        '<td>' + res[i].id + '</td>' +
                        '<td>' + res[i].name + '</td>' +
                        '<td>' + res[i].pass + '</td>' +
                        '<td>' + res[i].email + '</td>' +
                        '<td style="width: 20%">' +
                        '<button class="btn btn-outline-info " style="margin: 0 5px;" onclick ="edit_info(' + res[i].id + ')"><i class="fa fa-fw fa-edit"></i></button>' +
                        '<button class="btn btn-outline-danger " style="margin: 0 5px;" onclick ="delete_info(' + res[i].id + ')"><i class="fa fa-fw fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';

                }
            } else {
                for (var i in res) {
                    td +=
                        '<tr>' +
                        '<td>' + res[i].id + '</td>' +
                        '<td>' + res[i].cod + '</td>' +
                        '<td>' + res[i].name + '</td>' +
                        '<td style="width: 20%">' +
                        '<button class="btn btn-outline-info " style="margin: 0 5px;" onclick ="edit_info(' + res[i].id + ')"><i class="fa fa-fw fa-edit"></i></button>' +
                        '<button class="btn btn-outline-danger " style="margin: 0 5px;" onclick ="delete_info(' + res[i].id + ')"><i class="fa fa-fw fa-trash"></i></button>' +
                        '</td>' +
                        '</tr>';

                }
            }

            var search = (tabla == 'client') ? '<input class="form-control" id="myInput" type="text" placeholder="Search.." onkeyup="search()">' : ' ';

            document.getElementById('tablas').innerHTML =
                search +
                '<table class="table" >' +
                '<thead>' +
                '<tr>' +
                '<th colspan=' + (titulos.length) + ' style="text-align: center;font-size: 22px;">Tabla ' + tabla + '</th>' +
                '<th><button class="btn btn-outline-success " style="margin: 0 5px;" onclick="create_item(\'' + tabla + '\')"><i class="fa fa-fw fa-plus"></i></button></th>' +
                '</tr>' +
                '<tr>' + th + '<th></th>' + '</tr>' +
                '</thead>' +
                '<tbody id="body_table">' +
                td +
                '</tbody>' +
                '</table>';


        }
    });
}

function create_item(tabla) {
    //console.log('se crea en: ' + tabla, titulos);
    $("#modal_acc").modal();

    document.getElementById('title_modal').innerHTML = 'Crear elemento para ' + tabla;

    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: 'Q2',
        },
        success: function(response) {
            var tag = '';
            var option = '';
            var res = JSON.parse(response);
            //console.log('response ', res);

            for (var i = 1; i < titulos.length; i++) {
                //console.log(titulos[i]);

                if (titulos[i] == 'ciudad') {

                    for (var j in res) {
                        //console.log(res[j].name);
                        option += '<option value="' + res[j].name + '">' + res[j].name + '</option>';
                    }
                    tag +=
                        '<div class="form-group">' +
                        '<label for="select_ciudad">' + titulos[i] + '</label>' +
                        '<select class="form-control" id="select_ciudad" name="' + titulos[i] + '">' +
                        option +
                        '</select>' +
                        '</div>';
                } else {
                    tag +=
                        '<div class="form-group">' +
                        '<label for="text">' + titulos[i] + '</label>' +
                        '<input type="text" class="form-control" placeholder="Enter ' + titulos[i] + '" id="' + titulos[i] + '" name="' + titulos[i] + '">' +
                        '</div>';
                }
            }



            document.getElementById('body_modal').innerHTML =
                '<form id="form_create">' +
                tag +
                '<span class="btn btn-success" onclick="serialize(\'form_create\');">Crear</span>' +
                '</form>' +
                '<br><div class="alert alert-success" id="alerta_modal_ok" style="display: none;">' +
                '<strong>OK!</strong> Elemento creado correctamente.' +
                '</div>' +
                '<br><div class="alert alert-danger" id="alerta_modal_fail" style="display: none;">' +
                '<strong>Error!</strong> Por favor revise la información.' +
                '</div>';
        }
    });
}




function serialize(id_form, id_item = null) {
    var fields = $('#' + id_form).serializeArray();
    //console.log('serialize: ', fields);
    var titulo = JSON.stringify(titulos);

    var op = id_form.split('_');
    //console.log(op);

    var opcion = (op[1] == 'edit') ? 'C2' : 'C1';

    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: opcion,
            info: {
                fields: fields,
                tabla: tabla_,
                titulo: titulos,
                id_item: id_item
            }
        },
        success: function(response) {
            //console.log(response);
            if (response == 1) {
                document.getElementById('alerta_modal_ok').style.display = 'block';
                setTimeout(function() {
                    $("#modal_acc").modal('hide');
                    get_info(tabla_);
                }, 1000);
            } else {
                document.getElementById('alerta_modal_fail').style.display = 'block';
            }

        }
    });
}

function edit_info(id) {
    $("#modal_acc").modal();

    document.getElementById('title_modal').innerHTML = 'Editar elemento para ' + tabla_;

    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: 'Q2',
        },
        success: function(response) {
            var tag = '';
            var option = '';
            var res = JSON.parse(response);
            //console.log('response ', res);


            for (var i in obj) {
                //console.log('this ', parseInt(obj[i].id), id);
                if (parseInt(obj[i].id) == id) {
                    for (var t = 1; t < titulos.length; t++) {
                        if (titulos[t] == 'ciudad') {
                            for (var r in res) {
                                var selec = (res[r].name == obj[i].ciudad) ? 'selected' : ' ';
                                option += '<option value="' + res[r].name + '" ' + selec + '>' + res[r].name + '</option>';
                            }
                            tag +=
                                '<div class="form-group">' +
                                '<label for="select_ciudad">' + titulos[t] + '</label>' +
                                '<select class="form-control" id="select_ciudad" name="' + titulos[t] + '">' +
                                option +
                                '</select>' +
                                '</div>';
                        } else {
                            for (var j in obj[i]) {
                                //console.log(obj[i][j], '-', j);
                                if (j == titulos[t]) {
                                    tag +=
                                        '<div class="form-group">' +
                                        '<label for="text">' + titulos[t] + '</label>' +
                                        '<input type="text" class="form-control" placeholder="Enter ' + titulos[t] + '" id="' + titulos[t] + '" name="' + titulos[t] + '" value="' + obj[i][j] + '">' +
                                        '</input>';
                                }
                            }

                        }
                    }
                }

                document.getElementById('body_modal').innerHTML =
                    '<form id="form_edit">' +
                    tag +
                    '<br><span class="btn btn-info" onclick="serialize(\'form_edit\',' + id + ')">Editar</span>' +
                    '</form>' +
                    '<br><div class="alert alert-success" id="alerta_modal_ok" style="display: none;">' +
                    '<strong>OK!</strong> Elemento modificado correctamente.' +
                    '</div>' +
                    '<br><div class="alert alert-danger" id="alerta_modal_fail" style="display: none;">' +
                    '<strong>Error!</strong> Por favor revise la información.' +
                    '</div>';
            }
        }
    });


}

function delete_info(id) {
    $("#modal_acc").modal();
    document.getElementById('title_modal').innerHTML = 'Eliminar elemento para ' + tabla_;
    var tag = '';
    for (var i in obj) {
        if (parseInt(obj[i].id) == id) {
            //console.log(obj[i]);
            for (var t = 1; t < titulos.length; t++) {
                for (var j in obj[i]) {
                    //console.log(obj[i][j], '-', j);
                    if (j == titulos[t]) {
                        tag +=
                            '<div class="form-group">' +
                            '<label for="text">' + titulos[t] + '</label>' +
                            '<input type="text" class="form-control" placeholder="Enter ' + titulos[t] + '" id="' + titulos[t] + '" name="' + titulos[t] + '" value="' + obj[i][j] + '" readonly>' +
                            '</input>';
                    }
                }

            }
            document.getElementById('body_modal').innerHTML =

                '<div class="alert alert-danger" >' +
                '<strong>Va a eliminar!</strong> ¿Esta seguro que quiere eliminar?.' +
                '</div>' +
                '<form id="form_edit">' +
                tag +
                '<br><span class="btn btn-danger" onclick="delete_ajax(' + id + ')">Eliminar</span>' +
                '</form>' +
                '<br><div class="alert alert-success" id="alerta_modal_ok" style="display: none;">' +
                '<strong>OK!</strong> Elemento ELIMINADO correctamente.' +
                '</div>' +
                '<br><div class="alert alert-danger" id="alerta_modal_fail" style="display: none;">' +
                '<strong>Error!</strong> Por favor revise la información.' +
                '</div>';
        }
    }

}

function delete_ajax(id_item) {

    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: 'D1',
            info: {
                tabla: tabla_,
                id_item: id_item
            }
        },
        success: function(response) {
            //console.log(response);
            if (response == 1) {
                document.getElementById('alerta_modal_ok').style.display = 'block';
                setTimeout(function() {
                    $("#modal_acc").modal('hide');
                    get_info(tabla_);
                }, 1000);
            } else {
                document.getElementById('alerta_modal_fail').style.display = 'block';
            }

        }
    });

}

function search(params) {

    var value = $('#myInput').val().toLowerCase();
    $("#body_table tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

}

function login() {
    var fields = $('#login_form').serializeArray();
    //console.log('serialize: ', fields);

    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: 'L1',
            info: {
                fields: fields
            }
        },
        success: function(response) {
            var res = JSON.parse(response);
            //console.log(res.length);
            if (res.length >= 1) {
                document.getElementById('alert_login_ok').style.display = 'block';
                document.getElementById('loader').style.display = 'block';

                setTimeout(function() {
                    document.getElementById('nav_list').style.display = 'flex';
                    document.getElementById('login_tmp').style.display = 'none';
                    document.getElementById('alert_login_ok').style.display = 'none';
                    document.getElementById('loader').style.display = 'none';
                }, 2000);
            } else {
                document.getElementById('alert_login_fail').style.display = 'block';
                document.getElementById('nav_list').style.display = 'none';
                document.getElementById('loader').style.display = 'none';
            }

        }
    });
}

function install_data() {
    $.ajax({
        type: "POST",
        url: 'server.php',
        data: {
            opcion: 'I1',
        },
        success: function(response) {
            var res = JSON.parse(response);
            console.log(response);
        }
    });
}