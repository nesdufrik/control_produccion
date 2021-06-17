<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$titulo = $_POST['titulo'];
$marco = $_POST['marco'];
$id_fun = $_SESSION['id_usuario'];
$fecha_hora = date('Y-m-d H:i:s');
$cite = $_POST['cite'];
$ref = $_POST['ref'];
$para = $_POST['para'];
$via = $_POST['via'];

$insertINF = "INSERT INTO op_inf_notas(id_funcionario, inf_fecha_creacion, inf_cite, inf_para, inf_ref, inf_marco, inf_titulo, inf_via) VALUES('$id_fun', '$fecha_hora', '$cite', '$para', '$ref', '$marco', '$titulo', '$via')";
$Result1 = $conexion->query($insertINF);
?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> Se guardo correctamente.
    <script type="text/javascript">
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>