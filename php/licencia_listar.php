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

$sql_listar = "SELECT *,(cm_transito+cm_particular+eva_oft+ce_transito+ce_particular+antecedentes+res_adm+hoja_reg+eva_psi+form_denuncia+dec_jur+notas+fotocopias) AS total_f FROM control_lic WHERE id_funcionario='$id_funcionario' AND fecha='$fecha' ORDER BY id_control DESC";
$res_listar = $conexion->query($sql_listar);
$row_listar = $res_listar->fetch_array(MYSQLI_ASSOC);
?>
<h5>Registros de fecha: <strong><?php echo $fecha; ?></strong></h5>
<table class="table table-responsive-sm table-hover text-center small">
    <thead class="thead-light">
        <tr>
            <th rowspan="2" class="align-middle">#</th>
            <th rowspan="2" class="align-middle">Licencia</th>
            <th rowspan="2" class="align-middle">Cat.</th>
            <th rowspan="2" class="align-middle">Tipo</th>
            <th colspan="3">Cert. Medico</th>
            <th colspan="2">Cert. Escuela</th>
            <th rowspan="2" class="align-middle">Antece<br>dentes</th>
            <th rowspan="2" class="align-middle">Res. Admin.</th>
            <th rowspan="2" class="align-middle">Hoja de registro kardex</th>
            <th rowspan="2" class="align-middle">Ev. Psic.</th>
            <th rowspan="2" class="align-middle">Form. Denuncia</th>
            <th rowspan="2" class="align-middle">Dec. Jurada</th>
            <th rowspan="2" class="align-middle">Notas</th>
            <th rowspan="2" class="align-middle">Foto<br>copias</th>
            <th rowspan="2" class="align-middle">T.F.</th>
            <th rowspan="2" class="align-middle"></th>
            <th rowspan="2" class="align-middle"></th>
        </tr>
        <tr>
            <th class="align-middle">Tran<br>sito</th>
            <th class="align-middle">Parti<br>cular</th>
            <th>Ev. Oftal.</td>
            <th class="align-middle">Tran<br>sito</th>
            <th class="align-middle">Parti<br>cular</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; do{ $i++ ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row_listar['ci_control']; ?></td>
            <td><?php echo $row_listar['cat_lic']; ?></td>
            <td><?php echo $row_listar['tipo']; ?></td>
            <td><?php echo $row_listar['cm_transito']; ?></td>
            <td><?php echo $row_listar['cm_particular']; ?></td>
            <td><?php echo $row_listar['eva_oft']; ?></td>
            <td><?php echo $row_listar['ce_transito']; ?></td>
            <td><?php echo $row_listar['ce_particular']; ?></td>
            <td><?php echo $row_listar['antecedentes']; ?></td>
            <td><?php echo $row_listar['res_adm']; ?></td>
            <td><?php echo $row_listar['hoja_reg']; ?></td>
            <td><?php echo $row_listar['eva_psi']; ?></td>
            <td><?php echo $row_listar['form_denuncia']; ?></td>
            <td><?php echo $row_listar['dec_jur']; ?></td>
            <td><?php echo $row_listar['notas']; ?></td>
            <td><?php echo $row_listar['fotocopias']; ?></td>
            <th><?php echo $row_listar['total_f']; ?></th>
            <td><button type="button" data-toggle="modal" data-target="#myModal" onclick="modificarLicencia('<?php echo $row_listar['id_control'] ?>');" class="btn btn-outline-info btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg></button></td>
            <td><button type="button" onclick="borrarLicencia('<?php echo $row_listar['id_control'] ?>');" class="btn btn-outline-danger btn-sm"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></button></td>
        </tr>
        <?php }while($row_listar=$res_listar->fetch_array(MYSQLI_ASSOC)); ?>
    </tbody>
</table>