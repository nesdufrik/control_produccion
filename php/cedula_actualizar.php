<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_control = $_POST['id_control'];
$ci_control = $_POST['ci_control'];
$edad = $_POST['edad'];
$tipo = $_POST['tipo'];
$juridico = $_POST['juridico'];
$cultural = $_POST['cultural'];

$sql_actualizar = "UPDATE control_ci SET ci_control='$ci_control',edad='$edad',tipo='$tipo',juridico='$juridico',cultural='$cultural' WHERE id_control='$id_control'";
$res_actualizar = $conexion->query($sql_actualizar);
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> Se actualizo correctamente.
    <script type="text/javascript">
        listarCedula();
        topCedula();
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>