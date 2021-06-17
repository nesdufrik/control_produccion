<?php
//error_reporting(0);
session_start();
require_once("../php/sis_conexion.php");
require("../php/sis_funciones.php");
require("../php/auth_gen.php");

$id_inf_nota = $_POST['id_inf_nota'];

//INFORMACION DE INFORME O NOTA PARA IMPRIMIR
$q_EditInf = "SELECT * FROM op_inf_notas WHERE id_inf_nota = $id_inf_nota";
$EditInf = $conexion->query($q_EditInf);
$row_EditInf = $EditInf->fetch_array(MYSQLI_ASSOC);

$id_de = $row_EditInf['id_funcionario'];
$id_para = $row_EditInf['inf_para'];

if($row_EditInf['inf_via'] != NULL){
  $id_via = $row_EditInf['inf_via'];
  //FUNCIONARIO VIA:
  $q_Inmediato = "SELECT * FROM funcionario WHERE id_funcionario='$id_via'";
  $Inmediato = $conexion->query($q_Inmediato);
  $row_Inmediato = $Inmediato->fetch_array(MYSQLI_ASSOC);
  $text_via = mb_strtoupper($row_Inmediato['funcionario'],'UTF-8');
}

//DE:
$q_Operador = "SELECT * FROM funcionario WHERE id_funcionario='$id_de'";
$Operador = $conexion->query($q_Operador);
$row_Operador = $Operador->fetch_array(MYSQLI_ASSOC);
$text_de = mb_strtoupper($row_Operador['funcionario'],'UTF-8');

//FUNCIONARIO A:
$q_Funcionario = "SELECT * FROM funcionario WHERE id_funcionario='$id_para'";
$Funcionario = $conexion->query($q_Funcionario);
$row_Funcionario = $Funcionario->fetch_array(MYSQLI_ASSOC);
$text_a = mb_strtoupper($row_Funcionario['funcionario'],'UTF-8');

//TRANSFORMAR A MAYUSCULAS
$text_ref = mb_strtoupper($row_EditInf['inf_ref'],'UTF-8');

//FECHA EN TEXTO
$dia = date('d');
$mes = date('m');
$anio = date('Y');
if($mes==1){
    $n_mes='Enero';
  }
  if($mes==2){
    $n_mes='Febrero';
  }
  if($mes==3){
    $n_mes='Marzo';
  }
  if($mes==4){
    $n_mes='Abril';
  }
  if($mes==5){
    $n_mes='Mayo';
  }
  if($mes==6){
    $n_mes='Junio';
  }
  if($mes==7){
    $n_mes='Julio';
  }
  if($mes==8){
    $n_mes='Agosto';
  }
  if($mes==9){
    $n_mes='Septiembre';
  }
  if($mes==10){
    $n_mes='Octubre';
  }
  if($mes==11){
    $n_mes='Noviembre';
  }
  if($mes==12){
    $n_mes='Diciembre';
  }
$fecha = "Sucre, ".$dia." de ".$n_mes." del ".$anio;
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">INFORME MENSUAL</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body" id="body_inf">
<table width="100%">
  <tr>
    <td width="10%"></td>
    <td width="90%" valign="top">
    <h3 align="center"><?php echo $row_EditInf['inf_titulo']."<br>".$row_EditInf['inf_cite']; ?></h3>
    <table cellpadding="4" cellspacing="4">
      <tr>
        <td>A:</td>
        <td><strong><?php echo $text_a."<br>".$row_Funcionario['cargo']; ?></strong></td>
      </tr>
      <?php if($row_EditInf['inf_via'] != NULL){ ?>
      <tr>
        <td>VIA:</td>
        <td><strong><?php echo $text_via."<br>".$row_Inmediato['cargo']; ?></strong></td>
      </tr>
      <?php } ?>
      <tr>
        <td>DE:</td>
          <td><strong><?php echo $text_de."<br>".$row_Operador['cargo']; ?></strong></td>
      </tr>
      <tr>
        <td>REF:</td>
        <td><strong><?php echo $text_ref; ?></strong></td>
      </tr>
      <tr>
        <td>FECHA:</td>
        <td><?php echo $fecha; ?></td>
      </tr>
    </table>
    <hr>
    <?php echo $row_EditInf['inf_marco']; ?>
    </td>
  </tr>
</table>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="imprimir('body_inf');">Imprimir</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>