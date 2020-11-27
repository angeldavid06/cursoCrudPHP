<?php 
    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj = new crud();

    $datos = array ($_POST['nom'], $_POST['anio'], $_POST['emp']);

    echo $obj->agregar($datos);
?>