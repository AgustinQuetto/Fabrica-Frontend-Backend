<?php
    if(!isset($_SESSION['dniEmpleado']))
    {
        header("Location: ../login.html");
    }
?>