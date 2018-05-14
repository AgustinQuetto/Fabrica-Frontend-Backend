<?php
    include_once 'fabrica.php';
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
    if(isset($_POST['txtApellido']) && isset($_POST['txtLegajo'])) {

        $empleado = new Empleado($_POST['txtApellido'], $_POST['txtNombre'], $_POST['txtDni'], $_POST['cboSexo'], $_POST['txtLegajo'], $_POST['txtSueldo'], $_POST['rdoTurno']);
        $fabrica = new Fabrica('Los tortolitos', 7);

        if($_FILES['foto']['size'] > 0) {
            $foto = pathinfo($_FILES['foto']['name']);
            $rutaFoto = '../fotos/'.$_POST['txtDni'].'-'.$_POST['txtApellido'].'.'.$foto['extension'];
            if ($foto['extension'] != 'jpg' && $foto['extension'] != 'png' && $foto['extension'] != 'jpeg' && $foto['extension'] != 'gif' && $foto['extension'] !=' bmp') {
                echo 'Extension invalida';
            } else if ($foto['size'] > 1024) {
                echo 'La foto excede el peso máximo.';
            }
            else if (file_exists($rutaFoto)) {
                unlink($rutaFoto);
            }
            
        } elseif (isset($_POST['hdnModificar'])) {
            $existing = $fabrica->TraerDeArchivoPorDni('../archivos/empleados.txt', $_POST['txtDni']);
            $rutaFoto = $existing[7];
        }
        
        
        $empleado->SetPathFoto($rutaFoto);
        $fabrica->TraerDeArchivo('../archivos/empleados.txt');

        if(isset($_POST['hdnModificar'])) {
            $fabrica->EliminarEmpleadoPorLegajo($_POST['txtLegajo']);
        }

        if ($fabrica->AgregarEmpleado($empleado)) {
            if ($fabrica->GuardarEnArchivo('../archivos/empleados.txt')) {
                move_uploaded_file($_FILES['foto']['tmp_name'], $rutaFoto);
                ?>
                    <a href=./mostrar.php>Empleado cargado - Mostrar</a>
                <?php          
            }
            else {
                ?>
                    <a href=../index.php>Error al escribir archivo - Inicio</a>
                <?php
            }
        }
        else {
            ?>
                <a href=../index.php>Error al agregar empleado - fábrica llena - Inicio</a>
            <?php      
        }
    }
?>
    