<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_control = $_POST['id_control'];
$ci_control = $_POST['ci_control'];
$cat_lic = $_POST['cat_lic'];
$tipo = $_POST['tipo'];
$cm_transito = $_POST['cm_transito'];
$cm_particular = $_POST['cm_particular'];
$eva_oft = $_POST['eva_oft'];
$ce_transito = $_POST['ce_transito'];
$ce_particular = $_POST['ce_particular'];
$antecedentes = $_POST['antecedentes'];
$res_adm = $_POST['res_adm'];
$hoja_reg = $_POST['hoja_reg'];
$eva_psi = $_POST['eva_psi'];
$form_denuncia = $_POST['form_denuncia'];
$dec_jur = $_POST['dec_jur'];
$notas = $_POST['notas'];
$fotocopias = $_POST['fotocopias'];

$sql_actualizar = "UPDATE control_lic SET 
                    ci_control='$ci_control',
                    cat_lic='$cat_lic',
                    tipo='$tipo',
                    cm_transito='$cm_transito',
                    cm_particular='$cm_particular',
                    eva_oft='$eva_oft',
                    ce_transito='$ce_transito',
                    ce_particular='$ce_particular',
                    antecedentes='$antecedentes',
                    res_adm='$res_adm',
                    hoja_reg='$hoja_reg',
                    eva_psi='$eva_psi',
                    form_denuncia='$form_denuncia',
                    dec_jur='$dec_jur',
                    notas='$notas',
                    fotocopias='$fotocopias'
                    WHERE id_control='$id_control'";
$res_actualizar = $conexion->query($sql_actualizar);
?>
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> Se actualizo correctamente.
    <script type="text/javascript">
        listarLicencia(document.getElementById('fecha').value);
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>