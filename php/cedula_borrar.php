<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_control = $_POST['id_control'];
$sql_borrar = "DELETE FROM control_ci WHERE id_control='$id_control'";
$res_borrar = $conexion->query($sql_borrar);
?>
<div class="alert alert-warning">
    <strong>Exito!</strong> Se borro correctamente.
    <script type="text/javascript">
        listarCedula();
        topCedula();
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>