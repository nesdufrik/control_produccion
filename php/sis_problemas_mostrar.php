<?php
error_reporting(0);
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$sistema = $_POST['sistema'];

$sql_listar = "SELECT * FROM down_list WHERE down_system = '$sistema'";
$res_listar = $conexion->query($sql_listar);
$row_listar = $res_listar->fetch_array(MYSQLI_ASSOC);

$i = 0;
do{
    $i++ ?>
    <button type="button" class="btn btn-outline-dark btn-sm btn-block" data-toggle="tooltip" title="<?php echo $row_listar['down_obs']; ?>" data-dismiss="modal" onclick="registrarProblemas('<?php echo $row_listar['id_down_list']; ?>');"><?php echo $row_listar['down_error']; ?></button>
<?php
}while($row_listar=$res_listar->fetch_array(MYSQLI_ASSOC));
?>