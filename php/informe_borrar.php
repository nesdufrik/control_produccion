<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_inf_nota = $_POST['id_inf_nota'];
$sql_borrar = "DELETE FROM op_inf_notas WHERE id_inf_nota='$id_inf_nota'";
$res_borrar = $conexion->query($sql_borrar);
?>
<div class="alert alert-warning">
    <strong>Exito!</strong> Se borro correctamente.
    <script type="text/javascript">
        listarCedula();
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>