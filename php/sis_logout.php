<?php
if((isset($_POST['desconectar'])) && ($_POST['desconectar'] == "logout")){
    session_start();
    unset($_SESSION['id_usuario']);
    session_destroy();
}
 ?>
 <div class="alert alert-success">
    <strong>Exito!</strong> Se desconecto correctamente.
    <script type="text/javascript">
        function redireccionar(){
            window.location.href="index.html";
        } 
        setTimeout ("redireccionar()", 250); //tiempo expresado en milisegundos
    </script>
</div>