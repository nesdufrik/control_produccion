<?php
session_start();
require_once("sis_conexion.php");

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM funcionario WHERE usuario = '$usuario'";

$result = $conexion->query($sql);

if($result->num_rows > 0){
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if($pass==$row['clave']){
		//Datos de sesión del usuario
		$_SESSION['loggedin'] = true;
		$_SESSION['id_usuario'] = $row['id_funcionario'];
		$_SESSION['nivel_usuario'] = $row['nivel'];
		//Datos del tiempo de tiempo de sesión
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start']+(60*60);
		//Reenvia a dirección
		?>
			<div class="alert alert-success">
				Iniciando sesión...
			</div>
			<script type="text/javascript">
				function redireccionar(){
					window.location.href="user-home.html";
				} 
				setTimeout ("redireccionar()", 1000); //tiempo expresado en milisegundos
			</script>
		<?php
	} else {
		?>
			<div class="alert alert-warning">
				Contraseña Incorrecta.
			</div>
			<script type="text/javascript">
				$(".alert").delay(1000).slideUp(200, function() {
					$(this).alert('close');
				});
			</script>
		<?php	
	}
} else {
	?>
		<div class="alert alert-danger">
			Usuario Incorrecto o Desactivado
		</div>
		<script type="text/javascript">
			$(".alert").delay(1000).slideUp(200, function() {
				$(this).alert('close');
			});
		</script>
	<?php
}
mysqli_close($conexion);
?>