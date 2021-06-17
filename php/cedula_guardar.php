<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$ci = $_POST['ci'];
$edad = $_POST['edad'];
$tipo = $_POST['tipo'];
$ra = $_POST['ra'];
$cultural = $_POST['cultural'];

$id_funcionario = $_SESSION['id_usuario'];
$fecha = date('Y-m-d');
$hora = date('H:i:s');

$sql_guardar = "INSERT INTO control_ci (id_funcionario,ci_control,fecha,hora,edad,tipo,juridico,cultural) VALUES ('$id_funcionario','$ci','$fecha','$hora','$edad','$tipo','$ra','$cultural')";
$res_guardar = $conexion->query($sql_guardar);
?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> Se guardo correctamente.
    <script type="text/javascript">
        listarCedula();
        topCedula();
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>