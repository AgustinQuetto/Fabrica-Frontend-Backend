<?php
error_reporting(E_ALL);
if(isset($_POST['apellido']) && isset($_POST['dni'])) {
    $elArchivo = fopen('../archivos/empleados.txt','r');

    while(!feof($elArchivo)) {
        $datoEmpleado = explode(' - ', fgets($elArchivo));
        if(trim($datoEmpleado[0]) != '') {
            if($_POST['apellido'] == $datoEmpleado[0] && $_POST['dni'] == $datoEmpleado[2]) {
                session_start();
                $_SESSION['dniEmpleado'] = $_POST['dni'];
                header('Location: ./mostrar.php');
                die();
            }
        }
    }

    fclose($elArchivo);
    ?>El usuario no ha sido encontrado.<?php
    ?><a href="../login.html" class="btn btn-primary">Volver</a> <?php
}
?>