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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Listado de Empleados</title>
    <style>
        body {
            text-align: center;
            padding: 0px 10% 0px 10%;
            vertical-align: middle;
        }

    </style>
</head>
<body>
        <h2>Listado de Empleados</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        Apellido
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Dni
                    </th>
                    <th>
                        Sexo
                    </th>
                    <th>
                        Legajo
                    </th>
                    <th>
                        Turno
                    </th>
                    <th>
                        URL
                    </th>
                    <th>
                        Imagen
                    </th>
                    <th colspan="2">
                        Herramientas
                    </th>
                </tr>
            </thead>
            <tbody>          
            <?php
                foreach($empleados as $emp)
                {
                    ?>
                    <tr>
                        <td>
                            <?php echo $emp->GetApellido(); ?>
                        </td>
                        <td>
                            <?php echo $emp->GetNombre(); ?>
                        </td>
                        <td>
                            <?php echo $emp->GetDni(); ?>
                        </td>
                        <td>
                            <?php echo $emp->GetSexo(); ?>
                        </td>
                        <td>
                            <?php echo $emp->GetLegajo(); ?>
                        </td>
                        <td>
                            <?php echo $emp->GetTurno(); ?>
                        </td>
                        <td>
                            <?php echo $emp->GetPathFoto(); ?>
                        </td>
                        <td>
                            <img src="<?php echo $emp->GetPathFoto(); ?>" alt="<?php echo $emp->GetApellido(); ?>" style="width:90px;height:90px;">
                        </td>
                        <td>
                            <form action="../index.php?dni=<?php echo $emp->GetDni(); ?>" method="POST">
                                <button type="submit" value="<?php echo $emp->GetDni(); ?>" name="dni" class="btn btn-warning">Modificar</button>
                            </form>
                        </td>
                        <td>
                            <a href="eliminar.php?id=<?php echo $emp->GetLegajo(); ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                }

            ?> 
            </tbody>
        </table>
        <a href='index.php' class="btn btn-primary">Inicio</a>
        <a href='./backend/cerrarSesion.php' class="btn btn-info">Cerrar sesión</a>
</body>
</html>
