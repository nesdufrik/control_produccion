<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_control = $_POST['id_control'];

$sql_modificar = "SELECT * FROM control_ci WHERE id_control='$id_control'";
$res_modificar = $conexion->query($sql_modificar);
$row_modificar = $res_modificar->fetch_array(MYSQLI_ASSOC);
?>
<!-- Modal body -->
<div class="modal-body" id="mostrarModificar">
    <div class="form-group">
        <label for="ci_control_m">Cedula de Identidad</label>
        <input type="text" class="form-control form-control-sm" id="ci_control_m" value="<?php echo $row_modificar['ci_control']; ?>">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="edad_m">Tipo de persona</label>
        <select id="edad_m" class="form-control form-control-sm">
            <option value="MENOR1" <?php if (!(strcmp("MENOR1", $row_modificar['edad']))) {echo "selected=\"selected\"";} ?>>Menor 1-11</option>
            <option value="MENOR2" <?php if (!(strcmp("MENOR2", $row_modificar['edad']))) {echo "selected=\"selected\"";} ?>>Menor 12-17</option>
            <option value="ADULTO" <?php if (!(strcmp("ADULTO", $row_modificar['edad']))) {echo "selected=\"selected\"";} ?>>Adulto</option>
            <option value="PcD" <?php if (!(strcmp("PcD", $row_modificar['edad']))) {echo "selected=\"selected\"";} ?>>Con Discapacidad</option>
        </select>
        </div>
        <div class="form-group col-md-6">
        <label for="tipo_m">Tipo de tramite</label>
        <select id="tipo_m" class="form-control form-control-sm">
            <option value="NUEVO" <?php if (!(strcmp("NUEVO", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>Nuevo</option>
            <option value="RENOVACION" <?php if (!(strcmp("RENOVACION", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>Renovación</option>
            <option value="REPOSICION" <?php if (!(strcmp("REPOSICION", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>Reposición</option>
            <option value="SOLICITANTE" <?php if (!(strcmp("SOLICITANTE", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>Solicitante</option>
        </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="juridico_m">Juridico</label>
        <select id="juridico_m" class="form-control form-control-sm">
            <option value="1" <?php if (!(strcmp("1", $row_modificar['juridico']))) {echo "selected=\"selected\"";} ?>>Si</option>
            <option value="0" <?php if (!(strcmp("0", $row_modificar['juridico']))) {echo "selected=\"selected\"";} ?>>No</option>
        </select>
        </div>
        <div class="form-group col-md-6">
        <label for="cultural_m">Identidad cultural</label>
        <select id="cultural_m" class="form-control form-control-sm">
            <option value="1" <?php if (!(strcmp("1", $row_modificar['cultural']))) {echo "selected=\"selected\"";} ?>>Si</option>
            <option value="0" <?php if (!(strcmp("0", $row_modificar['cultural']))) {echo "selected=\"selected\"";} ?>>No</option>
        </select>
        </div>
    </div>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-primary btn-sm" onclick="actualizarCedula('<?php echo $id_control; ?>');" data-dismiss="modal">Modificar</button>
    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
</div>