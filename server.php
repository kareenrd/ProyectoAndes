<?php

//$enlace = mysqli_connect("localhost", "root", '', "proyecto_andes");
$mysqli = new mysqli("localhost", "root", "", "proyecto_andes");

//print_r($mysqli);

$info = $_POST;
//print_r(sizeof($info));

if(sizeof($info) > 0){
    $res = false;
    switch ($info['opcion']) {
        case 'Q1':
            $res = get_info($mysqli, $info['info']);
            break;
        case 'C1':
            $res = create_item($mysqli, $info['info']);
            break;
        case 'Q2':
            $res = get_ciudades($mysqli);
            break;
        case 'C2':
            $res = edit_item($mysqli, $info['info']);
            break;
        case 'D1':
            $res = delete_item($mysqli, $info['info']);
            break;
        case 'L1':
            $res = login($mysqli, $info['info']);
            break;
        
        default:
            # code...
            break;
        
    }
    print_r($res);
}

function login($mysqli, $data){
    //print_r($data['fields']);
    $email = '';
    $pwd = '';
    foreach ($data['fields'] as $key => $value) {
        if($value['name'] == 'email'){
            $email = $value['value'];
        } else {
            $pwd = $value['value'];
        }
    }

    $sql = 'SELECT * FROM users WHERE email = \''.$email.'\' AND pass = \''.$pwd.'\'';
    //echo $sql;
    $resultado = $mysqli->query($sql);

    $res =  json_encode($resultado->fetch_all(MYSQLI_ASSOC));
    return $res;

}

function delete_item ($mysqli, $data){
    $sql = 'DELETE FROM '.$data['tabla'].' WHERE id = '.$data['id_item'];

    $resultado = $mysqli->query($sql);
    return $resultado;
}

function edit_item($mysqli, $data){
    $campos = '';
    foreach ($data['fields'] as $key => $value) {
        $campos .= $value['name']." = '".$value['value']."',";
    }
    $campos = substr($campos, 0, -1);   
    $titulo = $data['titulo'];
    $sql = 'UPDATE '.$data['tabla'].' SET '.$campos.' WHERE id = \''.$data['id_item'].'\'';

    $resultado = $mysqli->query($sql);
    return $resultado;
}

function create_item($mysqli, $data){
    $campos = '';
    $tabla = $data['tabla'];
    foreach ($data['fields'] as $key => $value) {
        $campos .= ",'".$value['value']."'";
    }
    
    $titulo = implode(",", $data['titulo']);
    $sql = 'INSERT INTO '.$tabla.'('.$titulo.') VALUES (0'.$campos.');';
    
    $resultado = $mysqli->query($sql);

      return $resultado;
}

function get_ciudades($mysqli){
    $sql = 'SELECT * FROM cities';
    $resultado = $mysqli->query($sql);

    $res =  json_encode($resultado->fetch_all(MYSQLI_ASSOC));
    return $res;
}

function get_info($mysqli, $data){
    $sql = 'SELECT * FROM '.$data['tabla'].' ORDER BY id ASC;';
    $resultado = $mysqli->query($sql);

        $res =  json_encode($resultado->fetch_all(MYSQLI_ASSOC));
    return $res;
}


?>