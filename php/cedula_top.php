<?php
error_reporting(0);
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_funcionario = $_SESSION['id_usuario'];
$fecha = date('Y-m-d');

$sql_listar = "SELECT COUNT(*) AS total_ci, f.usuario as nombre_f FROM control_ci c, funcionario f WHERE c.id_funcionario = f.id_funcionario AND c.fecha = '$fecha' AND c.tipo <> 'SOLICITANTE' GROUP BY f.id_funcionario ORDER BY total_ci DESC";
$res_listar = $conexion->query($sql_listar);
$row_listar = $res_listar->fetch_array(MYSQLI_ASSOC);
$i="0"; do{ 
    $i++;
    echo $i.". ".$row_listar['nombre_f']." - <strong>".$row_listar['total_ci']." ci</strong><br>";
}while($row_listar=$res_listar->fetch_array(MYSQLI_ASSOC));