<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_control = $_POST['id_control'];

$sql_modificar = "SELECT * FROM control_lic WHERE id_control='$id_control'";
$res_modificar = $conexion->query($sql_modificar);
$row_modificar = $res_modificar->fetch_array(MYSQLI_ASSOC);
?>
<!-- Modal body -->
<div class="modal-body" id="mostrarModificar">
    <table class="table table-bordered table-responsive-sm text-center small">
        <tr class="bg-secondary text-white align-middle">
            <td colspan="5" class="align-middle">Licencia</td>
            <td colspan="3" class="align-middle">Categoria</td>
            <td colspan="5" class="align-middle">Tipo de Tramite</td>
        </tr>
        <tr>
            <td colspan="5"><input class="form-control form-control-sm" type="text" id="ci_control_m" value="<?php echo $row_modificar['ci_control']; ?>"/></td>
            <td colspan="3">
                <select class="form-control form-control-sm" id="cat_lic_m">
                    <option value="M" <?php if (!(strcmp("M", $row_modificar['cat_lic']))) {echo "selected=\"selected\"";} ?>>M</option>
                    <option value="P" <?php if (!(strcmp("P", $row_modificar['cat_lic']))) {echo "selected=\"selected\"";} ?>>P</option>
                    <option value="A" <?php if (!(strcmp("A", $row_modificar['cat_lic']))) {echo "selected=\"selected\"";} ?>>A</option>
                    <option value="B" <?php if (!(strcmp("B", $row_modificar['cat_lic']))) {echo "selected=\"selected\"";} ?>>B</option>
                    <option value="C" <?php if (!(strcmp("C", $row_modificar['cat_lic']))) {echo "selected=\"selected\"";} ?>>C</option>
                    <option value="T" <?php if (!(strcmp("T", $row_modificar['cat_lic']))) {echo "selected=\"selected\"";} ?>>T</option>
                </select>
            </td>
            <td colspan="5">
                <select class="form-control form-control-sm" id="tipo_m">
                    <option value="NUEVO" <?php if (!(strcmp("NUEVO", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>NUEVO</option>
                    <option value="RENOVACION" <?php if (!(strcmp("RENOVACION", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>RENOVACIÓN</option>
                    <option value="DUPLICADO" <?php if (!(strcmp("DUPLICADO", $row_modificar['tipo']))) {echo "selected=\"selected\"";} ?>>DUPLICADO</option>
                </select>
            </td>
        </tr>
        <tr class="bg-secondary text-white align-middle">
            <td colspan="3">Cert. Medico</td>
            <td colspan="2">Cert. Escuela</td>
            <td rowspan="2" class="align-middle">Antece<br>dentes</td>
            <td rowspan="2" class="align-middle">Res. Admin.</td>
            <td rowspan="2" class="align-middle">Hoja de registro kardex</td>
            <td rowspan="2" class="align-middle">Ev. Psic.</td>
            <td rowspan="2" class="align-middle">Form. Denuncia</td>
            <td rowspan="2" class="align-middle">Dec. Jurada</td>
            <td rowspan="2" class="align-middle">Notas</td>
            <td rowspan="2" class="align-middle">Foto<br>copias</td>
        </tr>
        <tr class="bg-secondary text-white align-middle">
            <td class="align-middle">Transito</td>
            <td class="align-middle">Particular</td>
            <td>Ev. Oftal.</td>
            <td class="align-middle">Transito</td>
            <td class="align-middle">Particular</td>
        </tr>
        <tr>
            <td><input class="form-control form-control-sm" id="cm_transito_m" type="text" value="<?php echo $row_modificar['cm_transito']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="cm_particular_m" type="text" value="<?php echo $row_modificar['cm_particular']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="eva_oft_m" type="text" value="<?php echo $row_modificar['eva_oft']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="ce_transito_m" type="text"value="<?php echo $row_modificar['ce_transito']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="ce_particular_m" type="text" value="<?php echo $row_modificar['ce_particular']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="antecedentes_m" type="text" value="<?php echo $row_modificar['antecedentes']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="res_adm_m" type="text" value="<?php echo $row_modificar['res_adm']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="hoja_reg_m" type="text" value="<?php echo $row_modificar['hoja_reg']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="eva_psi_m" type="text" value="<?php echo $row_modificar['eva_psi']; ?>" maxlength="3" /></td>
            <td><input class="form-control form-control-sm" id="form_denuncia_m" type="text" value="<?php echo $row_modificar['form_denuncia']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="dec_jur_m" type="text" value="<?php echo $row_modificar['dec_jur']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="notas_m" type="text" value="<?php echo $row_modificar['notas']; ?>" maxlength="2" /></td>
            <td><input class="form-control form-control-sm" id="fotocopias_m" type="text" value="<?php echo $row_modificar['fotocopias']; ?>" maxlength="2" /></td>
        </tr>
    </table>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-primary btn-sm" onclick="actualizarLicencia('<?php echo $id_control; ?>');" data-dismiss="modal">Modificar</button>
    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
</div>