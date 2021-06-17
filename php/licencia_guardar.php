<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

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

$id_funcionario = $_SESSION['id_usuario'];
$fecha = date('Y-m-d');
$hora = date('H:i:s');

$sql_guardar = "INSERT INTO control_lic (id_funcionario,ci_control,fecha,cat_lic,tipo,cm_transito,cm_particular,eva_oft,ce_transito,ce_particular,antecedentes,res_adm,hoja_reg,eva_psi,form_denuncia,dec_jur,notas,fotocopias) VALUES ('$id_funcionario','$ci_control','$fecha','$cat_lic','$tipo','$cm_transito','$cm_particular','$eva_oft','$ce_transito','$ce_particular','$antecedentes','$res_adm','$hoja_reg','$eva_psi','$form_denuncia','$dec_jur','$notas','$fotocopias')";
$res_guardar = $conexion->query($sql_guardar);

?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Exito!</strong> Se guardo correctamente.
    <script type="text/javascript">
        listarLicencia();
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</div>