<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_inf = $_POST['id_inf'];
$titulo = $_POST['titulo'];
$marco = $_POST['marco'];
$fecha_hora = date('Y-m-d H:i:s');
$cite = $_POST['cite'];
$ref = $_POST['ref'];
$para = $_POST['para'];
if(isset($_POST['via'])){
    $via = $_POST['via'];
}else{
    $via = NULL;
}

$insertINF = "UPDATE op_inf_notas SET inf_fecha_modif='$fecha_hora', inf_cite='$cite', inf_para='$para', inf_via='$via', inf_ref='$ref', inf_marco='$marco', inf_titulo='$titulo' WHERE id_inf_nota=$id_inf";
  $Result1 = $conexion->query($insertINF);
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> Se actualizo correctamente.
    <script type="text/javascript">
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>