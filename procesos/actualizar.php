<?php 
    require_once "../clases/conexion.php";
    require_once "../clases/crud.php";
    $obj = new crud();

    $datos = array ($_POST['idJuego'], $_POST['nomU'], $_POST['anioU'], $_POST['empU']);

    echo $obj->Actualizar($datos);
?>