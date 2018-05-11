<?php
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    session_start();
    require_once 'fabrica.php';
    require_once 'validarSesion.php';
    $fabrica = new fabrica('Charly discos', 7);
    $fabrica->TraerDeArchivo('../archivos/empleados.txt');
    $empleados = $fabrica->GetEmpleados();
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Listado de Empleados</title>
</head>
<body>
        <h2 align='center'>Listado de Empleados</h2>
        <table align='center'>
            <thead><h2 align='center'>Info</h2></thead>
            <tr><td colspan='4'><hr></td></tr>           
            <?php
                foreach($empleados as $emp)
                {
                    ?>
                    <tr>
                        <td>
                            <?php echo $emp->ToString(); ?>
                        </td>
                        <td>
                            <img src="<?php echo $emp->GetPathFoto(); ?>" alt="<?php echo $emp->GetApellido(); ?>" style="width:90px;height:90px;">
                        </td>
                        <td>
                            <a href="eliminar.php?id=<?php echo $emp->GetLegajo(); ?>">Eliminar</a>
                        </td>
                        <td>
                            <form action="./administracion.php" method="POST">
                                <button type="submit" value="<?php echo $emp->GetDni(); ?>" name="dni">Modificar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }

            ?> 
            <tr><td colspan='4'><hr></td></tr>
            <tr><td><a href='index.php'>Inicio</a></td></tr>
        </table>
    <a href='./backend/cerrarSesion.php'>Desloguearse</a>
</body>
</html>
