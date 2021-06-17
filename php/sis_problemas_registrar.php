<?php
//error_reporting(0);
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

if(isset($_POST) && !empty($_POST)){
    $id_funcionario = $_SESSION['id_usuario'];
    $id_down_list = $_POST['problema'];
    $down_date = date('Y-m-d');
    $down_time = date('H:i:s');
    $last_time = new DateTime();
    $last_time->modify('-15 minute');
    $time = $last_time->format('H:i:s');
    
    //Verificar existencia de datos
    $sql_verificar = "SELECT * FROM down_detector WHERE id_funcionario = '$id_funcionario' AND down_date = '$down_date'";
    $res_verificar = $conexion->query($sql_verificar);
    $count_verificar = mysqli_num_rows($res_verificar);

    if($count_verificar == 0){
        $sql_registrar = "INSERT INTO down_detector (id_funcionario,id_down_list,down_date,down_time) VALUES ('$id_funcionario','$id_down_list','$down_date','$down_time')";
        $res_registrar = $conexion->query($sql_registrar); ?>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Se registro correctamente el error que tuvo en el sistema.
            <script type="text/javascript">
                $(".alert").delay(2000).slideUp(200, function() {
                    $(this).alert('close');
                });
            </script>
        </div>
    <?php
    } else {

        //Conseguir ultima hora de registro
        $sql_tiempo = "SELECT * FROM down_detector WHERE (SELECT MAX(down_time) FROM down_detector WHERE id_funcionario = '$id_funcionario' AND down_date = '$down_date')<='$time' LIMIT 1";
        $res_tiempo = $conexion->query($sql_tiempo);
        $count_tiempo = mysqli_num_rows($res_tiempo);

        if($count_tiempo > 0){
            $sql_registrar = "INSERT INTO down_detector (id_funcionario,id_down_list,down_date,down_time) VALUES ('$id_funcionario','$id_down_list','$down_date','$down_time')";
            $res_registrar = $conexion->query($sql_registrar); ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Se registro correctamente el error que tuvo en el sistema.
                <script type="text/javascript">
                    $(".alert").delay(2000).slideUp(200, function() {
                        $(this).alert('close');
                    });
                </script>
            </div>
        <?php
        } else { ?>
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Solo puede registrar una falla de sistema cada 15 minutos.
                <script type="text/javascript">
                    $(".alert").delay(2000).slideUp(200, function() {
                        $(this).alert('close');
                    });
                </script>
            </div>
        <?php
        }
    }
} else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> Algo salio mal!
        <script type="text/javascript">
            $(".alert").delay(2000).slideUp(200, function() {
                $(this).alert('close');
            });
        </script>
    </div>
<?php
}
?>