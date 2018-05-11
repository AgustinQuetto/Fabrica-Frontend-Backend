<?php
    session_start();
    include_once './backend/validarSesion.php';
    include_once './backend/fabrica.php';
    $title = isset($_GET['dni']) ? 'Modificar' : 'Alta';
    $isReadOnly = isset($_GET['dni']) ? 'readonly' : null;
    $submitText = isset($_GET['dni']) ? 'Modificar' : 'Enviar';
    $modifing = isset($_GET['dni']) ? '1' : null;
    
    if (isset($_GET['dni'])) {
        $fabrica = new Fabrica('Empleado te invoco', 7);
        $empleado = $fabrica->TraerDeArchivoPorDni('./archivos/empleados.txt', $_GET['dni']);
    } else {
        $empleado = null;
    }

    $getRealPathImage = explode('/', $empleado[7]);
    $imagenActual = isset($_GET['dni']) ? '<img src="./fotos/'.$getRealPathImage[2].'" alt="Foto de '.$empleado[0].' '.$empleado[1].'" width="250px" height="auto">' : null;

    if(isset($_GET['dni'])) {
        if($empleado[3] == 'masculino')
            $options = '<option value="Masculino" selected>Masculino(M)</option><option value="Femenino">Femenino (F)</option>';
        else
            $options = '<option value="Masculino">Masculino(M)</option><option value="Femenino" selected>Femenino (F)</option>';
    } else {
        $options = '<option value="Masculino">Masculino (M)</option><option value="Femenino">Femenino (F)</option>';
    }

    if(isset($_GET['dni'])) {
        if($empleado[6] == 'M') {
            $turno =    '<input type="radio" name="rdoTurno" id="tManana" value="M" checked>Mañana<br>
                        <input type="radio" name="rdoTurno" id="tTarde" value="T">Tarde<br>
                        <input type="radio" name="rdoTurno" id="tNoche" value="N">Noche<br>';
        } else if ($empleado[6] == 'T') {
            $turno =    '<input type="radio" name="rdoTurno" id="tManana" value="M">Mañana<br>
                        <input type="radio" name="rdoTurno" id="tTarde" value="T" checked>Tarde<br>
                        <input type="radio" name="rdoTurno" id="tNoche" value="N">Noche<br>';
        } else if ($empleado[6] == 'N') {
            $turno =    '<input type="radio" name="rdoTurno" id="tManana" value="M">Mañana<br>
                        <input type="radio" name="rdoTurno" id="tTarde" value="T">Tarde<br>
                        <input type="radio" name="rdoTurno" id="tNoche" value="N" checked>Noche<br>';
        }
    } else {
        $turno =    '<input type="radio" name="rdoTurno" id="tManana" value="M">Mañana<br>
                    <input type="radio" name="rdoTurno" id="tTarde" value="T">Tarde<br>
                    <input type="radio" name="rdoTurno" id="tNoche" value="N">Noche<br>';
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <title>HTML 5 – Formulario <? echo $title; ?> Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
    .container {
        width: 30%;
    }
    td {
        padding: 5px;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2 align="center"><? echo $title; ?> Empleados</h2>
        <form enctype="multipart/form-data" method="post" action="backend/administracion.php">
            <table align="center" class="table-responsive">      
                <tr><td><h4>Datos Laborales</h4></td></tr>
                <tr>
                    <td>DNI</td>
                    <td>
                        <input type="number" class="form-control" name="txtDni" id="txtDni" value="<?php echo $empleado[2]; ?>" min="1000000" max="55000000" <?php echo $isReadOnly; ?>>
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td>
                        <input type="text" class="form-control" name="txtApellido" id="txtApellido" value="<?php echo $empleado[0]; ?>">
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>
                        <input type="text" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $empleado[1]; ?>">
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Sexo</td>
                    <td>
                        <select name="cboSexo" class="form-control" id="cboSexo">
                            <option value="default">Seleccione(---)</option>
                            <?php echo $options; ?>
                        </select>
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr><td><h4>Datos Laborales</h4></td></tr>
                <tr>
                    <td>Legajo</td>
                    <td>
                        <input type="number" class="form-control" name="txtLegajo" id="txtLegajo" value="<?php echo $empleado[4]; ?>" min="100" max="550" <?php echo $isReadOnly; ?>>
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Sueldo</td>
                    <td>
                        <input type="number" class="form-control" name="txtSueldo" id="txtSueldo" value="<?php echo $empleado[5]; ?>" min="8000" step="500">
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr>
                    <td>Turno</td>
                    <td>
                        <?php echo $turno; ?>
                    </td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td>
                        <?php echo $imagenActual; ?>
                        <input type="file" name="foto" id="foto" value="<?php echo $modifing; ?>">
                        <span style="display:none">*</span>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" value="<?php echo $_POST['dni']; ?>" name="hdnModificar"/>
                    <td><input type="reset" name="btnLimpiar" value="Limpiar" class="btn btn-warning"></td>
                    <td><input type="submit" name="btnEnviar" value="<?php echo $submitText; ?>" class="btn btn-success" style="float:right"></td>
                </tr>
                
            </table>
        </form>
        <a href="./backend/cerrarSesion.php">Desloguearse</a>
    </div>
</body>
</html>