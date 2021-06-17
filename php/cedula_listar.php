<?php
error_reporting(0);
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_funcionario = $_SESSION['id_usuario'];
if(!isset($_POST['fecha'])){
    $fecha = date('Y-m-d');
}else{
    $fecha = $_POST['fecha'];
}

$sql_listar = "SELECT * FROM control_ci WHERE id_funcionario='$id_funcionario' AND fecha='$fecha' ORDER BY id_control DESC";
$res_listar = $conexion->query($sql_listar);
$row_listar = $res_listar->fetch_array(MYSQLI_ASSOC);
?>
<h5>Registros de fecha: <strong><?php echo $fecha; ?></strong></h5>
<table class="table table-responsive-sm table-hover text-center small">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cedula de identidad</th>
            <th scope="col">Tipo de persona</th>
            <th scope="col">Tipo de tramite</th>
            <th scope="col">Juridico</th>
            <th scope="col">Identidad cultural</th>
            <th scope="col">Modificar</th>
            <th scope="col">Borrar</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; do{ $i++ ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row_listar['ci_control']; ?></td>
            <td><?php echo $row_listar['edad']; ?></td>
            <td><?php echo $row_listar['tipo']; ?></td>
            <td><?php echo $row_listar['juridico']; ?></td>
            <td><?php echo $row_listar['cultural']; ?></td>
            <td><button type="button" data-toggle="modal" data-target="#myModal" onclick="modificarCedula('<?php echo $row_listar['id_control'] ?>');" class="btn btn-outline-info btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button></td>
            <td><button type="button" onclick="borrarCedula('<?php echo $row_listar['id_control'] ?>');" class="btn btn-outline-danger btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button></td>
        </tr>
        <?php }while($row_listar=$res_listar->fetch_array(MYSQLI_ASSOC)); ?>
    </tbody>
</table>