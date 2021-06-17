<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_usuario = $_SESSION['id_usuario'];
$nom_usuario = $_POST['nom_usuario'];
$cargo_usuario = $_POST['cargo_usuario'];
$pass_usuario_ant = $_POST['pass_usuario_ant'];
$pass_usuario_new1 = $_POST['pass_usuario_new1'];
$pass_usuario_new2 = $_POST['pass_usuario_new2'];
$pass_usuario = $pass_usuario_new1;

$buscar = "SELECT * FROM funcionario WHERE id_funcionario='$id_usuario'";
$result = $conexion->query($buscar);
$row = $result->fetch_array(MYSQLI_ASSOC);

$actualizar = "UPDATE funcionario SET funcionario='$nom_usuario', cargo='$cargo_usuario', clave='$pass_usuario' WHERE id_funcionario='$id_usuario'";

if($pass_usuario_ant==$row['clave']){
    if($pass_usuario_new1 == $pass_usuario_new2){
        if($conexion->query($actualizar) === TRUE){
            ?>
                <div class="modal-body">Se actualizaron los datos</div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload();">Cerrar</button>
                </div>
            <?php
        } else {
            echo "Error al registrar el tramite.<br>".$conexion->error;
        }
    }else{
        ?>
            <div class="modal-body">Las contraseñas nuevas no coinciden</div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        <?php
    }
} else {
    ?>
        <div class="modal-body">Contraseña Anterior Incorrecta</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
    <?php
}
mysqli_close($conexion);
?>