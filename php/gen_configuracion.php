<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM funcionario WHERE id_funcionario='$id_usuario'";
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);

?>

<form class="was-validated" method="POST" id="form">
    <div class="form-group">
        <label for="nom_usuario">Nombre Completo:</label>
        <input
            type="text"
            class="form-control"
            id="nom_usuario"
            value="<?php echo $row['funcionario']; ?>"
            name="nom_usuario"
            required
        />
    </div>
    <div class="form-group">
        <label for="cargo_usuario">Cargo Institucional:</label>
        <input
            type="text"
            class="form-control"
            id="cargo_usuario"
            value="<?php echo $row['cargo']; ?>"
            name="cargo_usuario"
            required
        />
    </div>
    <div class="form-group">
        <label for="datos_usuario">Cambiar Contraseña:</label>
        <div class="input-group">
            <input
            type="password"
            class="form-control"
            id="pass_usuario_ant"
            placeholder="Contraseña Anterior"
            required
            />
            <input
            type="password"
            class="form-control"
            id="pass_usuario_new1"
            placeholder="Contraseña Nueva"
            required
            />
            <input
            type="password"
            class="form-control"
            id="pass_usuario_new2"
            placeholder="Repita Contraseña"
            required
            />
        </div>
    </div>
    <button
    type="button"
    class="btn btn-primary"
    data-toggle="modal"
    data-target="#myModal"
    onclick="actualizarUsuario();"
    >
    Actualizar
    </button>
</form>