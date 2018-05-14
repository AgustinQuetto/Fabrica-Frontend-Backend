<?php
    require './fabrica.php';
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    if(isset($_GET['id'])) {
        $fabrica = new Fabrica('Los tortolitos', 7);
        $fabrica->TraerDeArchivo('../archivos/empleados.txt');
        if($fabrica->EliminarEmpleadoPorLegajo($_GET['id'])) {
            $fabrica->GuardarEnArchivo('../archivos/empleados.txt');
            echo 'Empleado eliminado';
        } else {
            echo 'El empleado no fue encontrado';
        }
    } else {
        echo 'Falta el numero de legajo';
    }
?>