<?php
$mysqli = mysqli_connect("localhost", "root", "", "proyecto_andes");

$info = $_POST;
//print_r($info);

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
        case 'I1':
            $res = install_data($mysqli);
            break;
        
        default:
            
            break;
        
    }
    print_r($res);
}

function install_data($mysqli){
    $ya_entro = 0;
    $install = file_get_contents('instalacion.sql');

    $tablas = $mysqli->query('SELECT 1 FROM client');
    if(empty($tablas) == 1){
        $resultado = ($mysqli->multi_query($install) == 1 ) ? 1:0;
    } else {
        $resultado = 'false';
    }

    
    return $resultado;
}

function login($mysqli, $data){
    //print_r($data['fields']);
    $email = '';
    $pwd = '';
    $resultado = '';
    foreach ($data['fields'] as $key => $value) {
        if($value['name'] == 'email'){
            $email = $value['value'];
        } else {
            $pwd = $value['value'];
        }
    }

    $sql = 'SELECT * FROM users WHERE email = \''.$email.'\' AND pass = \''.$pwd.'\';';
    $resultado = mysqli_query($mysqli, $sql, MYSQLI_USE_RESULT);
    $res =  json_encode(mysqli_fetch_row($resultado));
    
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