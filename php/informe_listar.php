<?php
error_reporting(0);
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_funcionario = $_SESSION['id_usuario'];

$sql_listar = "SELECT * FROM op_inf_notas WHERE id_funcionario='$id_funcionario' ORDER BY id_inf_nota DESC";
$res_listar = $conexion->query($sql_listar);
$row_listar = $res_listar->fetch_array(MYSQLI_ASSOC);
?>
<table class="table table-responsive-sm table-hover text-center small">
    <thead class="thead-light">
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Fecha</th>
            <th class="align-middle">Cite</th>
            <th class="align-middle">Ref</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; do{ $i++ ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row_listar['inf_fecha_creacion']; ?></td>
            <td><?php echo $row_listar['inf_cite']; ?></td>
            <td><?php echo $row_listar['inf_ref']; ?></td>
            <td><button type="button" data-toggle="modal" data-target="#myModal" onclick="imprimirInforme('<?php echo $row_listar['id_inf_nota'] ?>');" class="btn btn-outline-dark btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg></button></td>
            <td><button type="button" data-toggle="modal" data-target="#myModal" onclick="modificarInforme('<?php echo $row_listar['id_inf_nota'] ?>');" class="btn btn-outline-info btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg></button></td>
            <td><button type="button" onclick="borrarInforme('<?php echo $row_listar['id_inf_nota'] ?>');" class="btn btn-outline-danger btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></button></td>
        </tr>
        <?php }while($row_listar=$res_listar->fetch_array(MYSQLI_ASSOC)); ?>
    </tbody>
</table>