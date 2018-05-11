<?php
include_once 'fabrica.php';
$empleado1 = new Empleado('Vangioni', 'Leonel', 35334042, 'M', 10, 50000, 'Mañana');
$empleado2 = new Empleado('Funes', 'Ramiro', 35334043, 'M',10, 50000, 'Tarde');
$empleado3 = new Empleado('Mercado', 'Gabriel', 35334044, 'M', 10, 50000, 'Noche');
$empleado4 = new Empleado('Maidana', 'Jonatan', 35334045, 'M', 10, 50000, 'Mañana');
$empleado5 = new Empleado('Perez', 'Juan', 35334046, 'M', 10, 50000, 'Noche');
$empleado6 = new Empleado('Lopez', 'Jorge', 35334047, 'M', 10, 50000, 'Tarde');
echo '******************************EMPLEADOS******************************<br>';
echo $empleado1->ToString();
echo '<br>';
echo $empleado1->Hablar('Español, Inglés y Frances');
echo '<br>';
echo '<br>';
echo '******************************CARGA EMPLEADOS******************************<br>';
$unaFabrica = new Fabrica('La Fábrica del PHP');
if($unaFabrica->AgregarEmpleado($empleado1)){}
else{
    echo 'No se pueden tomar mas empleados';
}
if($unaFabrica->AgregarEmpleado($empleado2)){}
else{
    echo 'No se pueden tomar mas empleados';
}
if($unaFabrica->AgregarEmpleado($empleado3)){}
else{
    echo 'No se pueden tomar mas empleados';
}
if($unaFabrica->AgregarEmpleado($empleado3)){}
else{
    echo 'No se pueden tomar mas empleados';
}
if($unaFabrica->AgregarEmpleado($empleado4)){}
else{
    echo 'No se pueden tomar mas empleados';
}
if($unaFabrica->AgregarEmpleado($empleado5)){
    echo $unaFabrica->ToString();
}
else{
    echo 'No se pueden tomar mas empleados';
}
echo '<br>';
if($unaFabrica->AgregarEmpleado($empleado6)){}
else{
        echo 'No se pueden tomar mas empleados';
}
echo '<br>';
echo '<br>';
echo '******************************CALCULAR SUELDOS******************************<br>';
echo $unaFabrica->CalcularSueldos();
echo '<br>';
echo '<br>';

echo '******************************ELIMINAR EMPLEADO******************************<br>';
if($unaFabrica->EliminarEmpleado($empleado5)){
    echo 'Empleado 3 eliminado con éxito <br> <br>';
}
echo $unaFabrica->ToString();
echo '<br>';
echo '<br>';
echo '******************************NUEVOS SUELDOS******************************<br>';
echo $unaFabrica->CalcularSueldos();

?>
