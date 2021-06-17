<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$user_ci = $_POST['user_ci'];
$user_complemento = mb_strtoupper($_POST['user_complemento'],'UTF-8');
$user_nombre = mb_strtoupper($_POST['user_nombre'],'UTF-8');
$user_cel = $_POST['user_cel'];
$user_cat1 = $_POST['user_cat1'];
$user_tipo1 = $_POST['user_tipo1'];
$user_exp1 = $_POST['user_exp1'];
$user_cat2 = $_POST['user_cat2'];
$user_tipo2 = $_POST['user_tipo2'];
$user_exp2 = $_POST['user_exp2'];
$user_cat3 = $_POST['user_cat3'];
$user_tipo3 = $_POST['user_tipo3'];
$user_exp3 = $_POST['user_exp3'];

$funcionario = usuario($_SESSION['id_usuario']);
$fecha_hora = date('Y-m-d H:i:s');

$sql_buscar = "SELECT * FROM licencias_pago WHERE user_ci = '$user_ci' AND (user_estado = '1' OR user_estado = '2')";
$res_buscar = $conexion->query($sql_buscar);
$con_buscar = mysqli_num_rows($res_buscar);

if($res_buscar->num_rows > 0){
    ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Alerta!</strong> Esa cedula ya fue registrada y pronto sera atendida.
        <script type="text/javascript">
            $(".alert").delay(3000).slideUp(200, function() {
                $(this).alert('close');
            });
        </script>
    </div>
    <?php
}else{
    if($user_cat2 == "" && $user_cat3 == ""){
        $sql_guardar = "INSERT INTO licencias_pago (user_ci,user_complemento,user_nombre,user_cel,user_cat,user_tipo,user_exp,user_estado,operador_reg,fecha_sol) VALUES 
                    ('$user_ci','$user_complemento','$user_nombre','$user_cel','$user_cat1','$user_tipo1','$user_exp1','1','$funcionario','$fecha_hora')";
    }elseif($user_cat2 != "" && $user_cat3 == ""){
        $sql_guardar = "INSERT INTO licencias_pago (user_ci,user_complemento,user_nombre,user_cel,user_cat,user_tipo,user_exp,user_estado,operador_reg,fecha_sol) VALUES 
                    ('$user_ci','$user_complemento','$user_nombre','$user_cel','$user_cat1','$user_tipo1','$user_exp1','1','$funcionario','$fecha_hora'),
                    ('$user_ci','$user_complemento','$user_nombre','$user_cel','$user_cat2','$user_tipo2','$user_exp2','1','$funcionario','$fecha_hora')";
    }elseif($user_cat3 != "" && $user_cat3 != ""){
        $sql_guardar = "INSERT INTO licencias_pago (user_ci,user_complemento,user_nombre,user_cel,user_cat,user_tipo,user_exp,user_estado,operador_reg,fecha_sol) VALUES 
                    ('$user_ci','$user_complemento','$user_nombre','$user_cel','$user_cat1','$user_tipo1','$user_exp1','1','$funcionario','$fecha_hora'),
                    ('$user_ci','$user_complemento','$user_nombre','$user_cel','$user_cat2','$user_tipo2','$user_exp2','1','$funcionario','$fecha_hora'),
                    ('$user_ci','$user_complemento','$user_nombre','$user_cel','$user_cat3','$user_tipo3','$user_exp3','1','$funcionario','$fecha_hora')";
    }
    $res_guardar = $conexion->query($sql_guardar);
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Exito!</strong> Se guardo correctamente.
        <script type="text/javascript">
            $(".alert").delay(3000).slideUp(200, function() {
                $(this).alert('close');
            });
        </script>
    </div>
    <?php
}
?>