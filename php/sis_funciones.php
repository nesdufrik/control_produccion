<?php

function usuario($user_id){
	require('sis_conexion.php');
	$sql = "SELECT * FROM funcionario WHERE id_funcionario='$user_id'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['usuario'];
}

function externo($externo_id){
	require('sis_conexion.php');
	$sql = "SELECT * FROM estados_tramites WHERE id_estado='$externo_id'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['nombre_estado'];
}

function tramite($tramite_id){
	require('sis_conexion.php');
	$sql = "SELECT * FROM tramites WHERE id_tramite='$tramite_id'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo $row['nom_tramite'];
}

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

function totalAtendidosUser($vy,$vm,$vu,$vn){
	require('sis_conexion.php');
	if($vn == 3){
		$sql = "SELECT COUNT(*) AS atendidos FROM control WHERE id_usuario='$vu' AND YEAR(date_control)='$vy' AND MONTH(date_control)='$vm' AND estado_control='1'";
		$result = $conexion->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$sql2 = "SELECT COUNT(*) AS atendidos FROM control WHERE id_usuario='$vu' AND YEAR(date_control)='$vy' AND MONTH(date_control)='$vm' AND estado_control='3'";
		$result2 = $conexion->query($sql2);
		$row2 = $result2->fetch_array(MYSQLI_ASSOC);

		$rowTotal = $row['atendidos']+$row2['atendidos'];
		return $rowTotal;
	}else{
		$sql = "SELECT COUNT(*) AS atendidos FROM control WHERE id_usuario='$vu' AND YEAR(date_control)='$vy' AND MONTH(date_control)='$vm' AND estado_control='3'";
		$result = $conexion->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		return $row['atendidos'];
	}
}

function totalExternosUser($vy,$vm,$vu){
	require('sis_conexion.php');
	$sql = "SELECT COUNT(*) AS externos FROM control WHERE id_usuario='$vu' AND YEAR(date_control)='$vy' AND MONTH(date_control)='$vm' AND estado_control='2'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['externos'];
}

function totalPendientesUser($vy,$vm,$vu){
	require('sis_conexion.php');
	$sql = "SELECT COUNT(*) AS pendientes FROM control WHERE id_usuario='$vu' AND YEAR(date_control)='$vy' AND MONTH(date_control)='$vm' AND estado_control='0'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['pendientes'];
}

function totalTramitesUser($vy,$vm,$vu){
	require('sis_conexion.php');
	$sql = "SELECT COUNT(*) AS tramites FROM control WHERE id_usuario='$vu' AND YEAR(date_control)='$vy' AND MONTH(date_control)='$vm'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['tramites'];
}

function autorizacion($strUsers, $strGroups, $UserName, $UserGroup){
	// Por seguridad, se inicia asumiendo que el visitante NO esta autorizado.
	$isValid = False;
	if (!empty($UserName)){
		$arrUsers = Explode(",", $strUsers);
		$arrGroups = Explode(",", $strGroups);
		if (in_array($UserName, $arrUsers)){
		$isValid = true;
		}
		if (in_array($UserGroup, $arrGroups)){
		$isValid = true;
		}
		if (($strUsers == "") && false){
		$isValid = true;
		}
	}
	return $isValid;
}

function inputRegularizar($id_tramite,$year,$mes,$dia,$cantidad,$usuario_sesion){
	require('sis_conexion.php');
	$date = $year."-".$mes."-".$dia;
	for ($i = 1; $i <= $cantidad; $i++){
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$cod_saneamiento = generate_string($permitted_chars, 20);
		$query1 = "INSERT INTO saneamiento (cod_saneamiento, id_tramite, ci_saneamiento, nom_saneamiento, date_saneamiento, time_saneamiento) VALUES ('$cod_saneamiento','$id_tramite','0','0','$date','12:00:00')";
		$query2 = "INSERT INTO control (cod_saneamiento, id_tramite, id_usuario, estado_control, obs_control, date_control, time_control) VALUES ('$cod_saneamiento','$id_tramite','$usuario_sesion','1','TRAMITE FINALIZADO','$date','12:00:00')";
		$result1 = $conexion->query($query1);
		$result2 = $conexion->query($query2);
	}
}

function loadRegularizar($year,$mes,$dia,$id_tramite){
	require('sis_conexion.php');
	$query = "SELECT COUNT(id_saneamiento) AS total FROM saneamiento WHERE id_tramite = '$id_tramite' AND YEAR(date_saneamiento) = '$year' AND MONTH(date_saneamiento) = '$mes' AND DAY(date_saneamiento) = '$dia'";
	$result = $conexion->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row['total'];
}
?>