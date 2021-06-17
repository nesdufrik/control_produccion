<?php
error_reporting(0);
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

if (isset($_POST['fecha_reporte'])){
	$fecha = $_POST['fecha_reporte'];
}else{
	$fecha = date('Y-m-d');
}

$idusuario_sql = $_SESSION['id_usuario'];

$query_idusuario = "SELECT * FROM funcionario WHERE id_funcionario = '$idusuario_sql'";
$idusuario = $conexion->query($query_idusuario);
$row_idusuario = $idusuario->fetch_array(MYSQLI_ASSOC);

$query_Recordset1 = "SELECT *, (cm_transito+cm_particular+eva_oft+ce_transito+ce_particular+antecedentes+res_adm+hoja_reg+eva_psi+form_denuncia+dec_jur+notas+fotocopias) AS total_lic FROM control_lic WHERE fecha = '$fecha' AND id_funcionario = '$idusuario_sql' AND (tipo = 'RENOVACION' OR tipo = 'DUPLICADO' OR tipo = 'NUEVO')";
$Recordset1 = $conexion->query($query_Recordset1);
$row_Recordset1 = $Recordset1->fetch_array(MYSQLI_ASSOC);

$query_total_general = "SELECT SUM(cm_transito) AS t_cmtransito, SUM(cm_particular) AS t_cmparticular, SUM(eva_oft) AS t_eo, SUM(ce_transito) AS t_cetransito, SUM(ce_particular) AS t_ceparticular, SUM(antecedentes) AS t_ant, SUM(res_adm) AS t_resadm, SUM(hoja_reg) AS t_hreg, SUM(eva_psi) AS t_ep, SUM(form_denuncia) AS t_fden, SUM(dec_jur) AS t_djur, SUM(notas) AS t_notas, SUM(fotocopias) AS t_fotocopias, SUM(cm_transito+cm_particular+eva_oft+ce_transito+ce_particular+antecedentes+res_adm+hoja_reg+eva_psi+form_denuncia+dec_jur+notas+fotocopias) AS total_f FROM control_lic WHERE id_funcionario = '$idusuario_sql' AND fecha = '$fecha' AND (tipo = 'RENOVACION' OR tipo = 'DUPLICADO' OR tipo = 'NUEVO')";
$total_general = $conexion->query($query_total_general);
$row_total_general = $total_general->fetch_array(MYSQLI_ASSOC);

$query_total_nuevo = "SELECT COUNT(tipo) AS nuevo FROM control_lic WHERE tipo = 'NUEVO' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_nuevo = $conexion->query($query_total_nuevo);
$row_total_nuevo = $total_nuevo->fetch_array(MYSQLI_ASSOC);

$query_total_renovaciones = "SELECT COUNT(tipo) AS renovacion FROM control_lic WHERE tipo = 'RENOVACION' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_renovaciones = $conexion->query($query_total_renovaciones);
$row_total_renovaciones = $total_renovaciones->fetch_array(MYSQLI_ASSOC);

$query_total_duplicados = "SELECT COUNT(tipo) AS duplicado FROM control_lic WHERE tipo = 'DUPLICADO' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha' ";
$total_duplicados = $conexion->query($query_total_duplicados);
$row_total_duplicados = $total_duplicados->fetch_array(MYSQLI_ASSOC);

$query_total_A = "SELECT COUNT(cat_lic) AS t_A FROM control_lic WHERE cat_lic = 'A' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_A = $conexion->query($query_total_A);
$row_total_A = $total_A->fetch_array(MYSQLI_ASSOC);

$query_total_B = "SELECT COUNT(cat_lic) AS t_B FROM control_lic WHERE cat_lic = 'B' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_B = $conexion->query($query_total_B);
$row_total_B = $total_B->fetch_array(MYSQLI_ASSOC);

$query_total_C = "SELECT COUNT(cat_lic) AS t_C FROM control_lic WHERE cat_lic = 'C' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_C = $conexion->query($query_total_C);
$row_total_C = $total_C->fetch_array(MYSQLI_ASSOC);

$query_total_M = "SELECT COUNT(cat_lic) AS t_M FROM control_lic WHERE cat_lic = 'M' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_M = $conexion->query($query_total_M);
$row_total_M = $total_M->fetch_array(MYSQLI_ASSOC);

$query_total_P = "SELECT COUNT(cat_lic) AS t_P FROM control_lic WHERE cat_lic = 'P' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_P = $conexion->query($query_total_P);
$row_total_P = $total_P->fetch_array(MYSQLI_ASSOC);

$query_total_T = "SELECT COUNT(cat_lic) AS t_T FROM control_lic WHERE cat_lic = 'T' AND id_funcionario = '$idusuario_sql' AND fecha = '$fecha'";
$total_T = $conexion->query($query_total_T);
$row_total_T = $total_T->fetch_array(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Control Diario</title>
<link rel="stylesheet" id="estilo" href="css/estilo.css" type="text/css" media="all">
<link rel="stylesheet" id="style" href="css/style.css" type="text/css" media="all">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="3">
  <tr class="totales">
    <td colspan="4"  class="totales_no_top">HOJA DE CONTROL DE ENTREGA DIARIA DE DOCUMENTACIÓN DE LA/EL<br />
    TECNICO OPERADOR</td>
  </tr>
  <tr>
    <td class="totales2">DIRECCIÓN DEPARTAMENTAL:</td>
    <td class="totales2_normal">CHUQUISACA</td>
    <td align="right" class="totales2">FECHA:</td>
    <td class="totales2_normal"><?php echo $fecha; ?></td>
  </tr>
  <tr>
    <td class="totales2">OFICINA OPERATIVA:</td>
    <td class="totales2_normal"><?php echo $row_idusuario['oficina']; ?></td>
    <td align="right" class="totales2">Nº DE MESA:</td>
    <td class="totales2_normal"><?php echo $row_idusuario['mesa']; ?></td>
  </tr>
  <tr>
    <td class="totales2">NOMBRE DEL OPERADOR:</td>
    <td class="totales2_normal"><?php echo $row_idusuario['funcionario']; ?></td>
    <td align="right" class="totales2">Nº DE HOJA:</td>
    <td class="totales2_normal">1</td>
  </tr>
</table>
<br />
<table width="0%" border="4" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td rowspan="3">Nº</td>
    <td rowspan="3" class="totales2_normal_sep" align="center">Nº Licencias</td>
    <td rowspan="3" align="center"><p class="vertical">CATEGORIA</p></td>
    <td colspan="3" rowspan="2" class="totales2_normal_sep" align="center">TIPO DE TRÁMITE</td>
    <td colspan="13" class="totales2_normal_sep" align="center">Cantidad de Documentos que Entrega (llenar con números)</td>
    <td rowspan="3" class="totales2_normal_sep" align="center" valign="middle">TOTAL FOJAS</td>
  </tr>
  <tr>
    <td colspan="3" class="totales2_normal_sep" align="center">CERT-MED</td>
    <td colspan="2" align="center">CERT. ESC</td>
    <td rowspan="2" align="center"><p class="vertical">ANTECEDENTES</p></td>
    <td rowspan="2" align="center"><p class="vertical">ADMINISTRATIVA<br>RESOLUCION</p></td>
    <td rowspan="2" align="center"><p class="vertical">REGISTRO/KARDEX<br>HOJA DE</p></td>
    <td rowspan="2" align="center"><p class="vertical">PSICOLOGICA<br>EVALUACIÓN</p></td>
    <td rowspan="2" align="center"><p class="vertical">DENUNCIAS<br>FORM.</p></td>
    <td rowspan="2" align="center"><p class="vertical">JURADA<br>DECLARACIÓN</p></td>
    <td rowspan="2" align="center"><p class="vertical">NOTAS</p></td>
    <td rowspan="2" align="center"><p class="vertical">FOTOCOPIAS</p></td>
  </tr>
  <tr>
    <td class="totales2_normal_sep" align="center"><p class="vertical">NUEVOS</p></td>
    <td><p class="vertical">RENOVACIONES</p></td>
    <td><p class="vertical">DUPLICADOS</p></td>
    <td class="totales2_normal_sep" align="center"><p class="vertical">TRÁNSITO</p></td>
    <td align="center"><p class="vertical">PARTICULAR</p></td>
    <td align="center"><p class="vertical">Oftalmologia<br>Evaluación</p></td>
    <td align="center"><p class="vertical">TRÁNSITO</p></td>
    <td align="center"><p class="vertical">PARTICULAR</p></td>
  </tr>
  <?php $i=0; do { $i++; ?>
  <tr>
    <td align="center" class="totales2_normal"><?php echo $i; ?></td>
    <td align="center" class="totales2_normal_sep"><?php echo $row_Recordset1['ci_control']; ?></td>
    <td align="center" ><?php echo $row_Recordset1['cat_lic']; ?></td>
    <td align="center" class="totales2_normal_sep">
	  <?php
	if($row_Recordset1['tipo']=='NUEVO'){
		echo "1";}
		else{
			echo "0";}
	?>
    </td>
    <td align="center" class="totales2_normal">
      <?php
	if($row_Recordset1['tipo']=='RENOVACION'){
		echo "1";}
		else{
			echo "0";}
	?>
    </td>
    <td align="center" class="totales2_normal">
      <?php
	if($row_Recordset1['tipo']=='DUPLICADO'){
		echo "1";}
		else{
			echo "0";}
	?>
    </td>
    <td align="center" class="totales2_normal_sep"><?php echo $row_Recordset1['cm_transito']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['cm_particular']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['eva_oft']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['ce_transito']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['ce_particular']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['antecedentes']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['res_adm']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['hoja_reg']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['eva_psi']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['form_denuncia']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['dec_jur']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['notas']; ?></td>
    <td align="center" class="totales2_normal"><?php echo $row_Recordset1['fotocopias']; ?></td>
    <td align="center" class="totales2_normal_sep"><?php echo $row_Recordset1['total_lic']; ?></td>
  </tr>
  <?php } while ($row_Recordset1 = $Recordset1->fetch_array(MYSQLI_ASSOC)); ?>
  <tr class="totales">
    <td colspan="3" align="center" class="totales">TOTAL</td>
    <td align="center" class="totales_sep"><?php echo $row_total_nuevo['nuevo']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_renovaciones['renovacion']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_duplicados['duplicado']; ?></td>
    <td align="center" class="totales_sep"><?php echo $row_total_general['t_cmtransito']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_cmparticular']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_eo']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_cetransito']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_ceparticular']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_ant']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_resadm']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_hreg']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_ep']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_fden']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_djur']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_notas']; ?></td>
    <td align="center" class="totales"><?php echo $row_total_general['t_fotocopias']; ?></td>
    <td align="center" class="totales_sep"><?php echo $row_total_general['total_f']; ?></td>
  </tr>
</table>
<br>
<table width="0%" border="2" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000" class="totales2">
  <?php $i=0; do { $i++; ?>
  <?php } while ($row_Recordset1 = $Recordset1->fetch_array(MYSQLI_ASSOC)); ?>
  <tr class="totales">
    <td align="center">TOTAL CATEGORIAS</td>
    <td align="center">A</td>
    <td align="center" class="totales2_normal"><?php echo $row_total_A['t_A']; ?></td>
    <td align="center">B</td>
    <td align="center" class="totales2_normal"><?php echo $row_total_B['t_B']; ?></td>
    <td align="center">C</td>
    <td align="center" class="totales2_normal"><?php echo $row_total_C['t_C']; ?></td>
    <td align="center">M</td>
    <td align="center" class="totales2_normal"><?php echo $row_total_M['t_M']; ?></td>
    <td align="center" >P</td>
    <td align="center" class="totales2_normal"><?php echo $row_total_P['t_P']; ?></td>
    <td align="center">T</td>
    <td align="center" class="totales2_normal"><?php echo $row_total_T['t_T']; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="500" border="0" align="center" cellpadding="1" cellspacing="3">
  <tr>
    <td><table width="0%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><span class="totales2">ENTREGUE CONFORME</span></td>
      </tr>
      <tr>
        <td align="center"><span class="totales2">Firma y Sello</span></td>
      </tr>
      <tr>
        <td align="center"><span class="totales2">CI ...................................</span></td>
      </tr>
    </table></td>
    <td><table width="0%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><span class="totales2">RECIBÍ CONFORME</span></td>
      </tr>
      <tr>
        <td align="center"><span class="totales2">Firma y Sello</span></td>
      </tr>
      <tr>
        <td align="center"><span class="totales2">CI ...................................</span></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>