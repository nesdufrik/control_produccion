<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");
require("auth_gen.php");

$id_funcionario = $_SESSION['id_usuario'];

//CONSULTA TODOS LOS DATOS DE FUNCIONARIOS
$q_Operador = "SELECT * FROM funcionario WHERE id_funcionario = '$id_funcionario'";
$Operador = $conexion->query($q_Operador);
$row_Operador = $Operador->fetch_array(MYSQLI_ASSOC);
$usuario = $row_Operador['usuario'];

//CONSULTA DATOS DE FUNCIONARIO PARA INMEDIATO SUPERIOR
$q_Funcionario = "SELECT * FROM funcionario WHERE nivel='20'";
$Funcionario = $conexion->query($q_Funcionario);
$row_Funcionario = $Funcionario->fetch_array(MYSQLI_ASSOC);

//CONSULTA DATOS DE FUNCIONARIO VIA INMEDIATO SUPERIOR
$q_Inmediato = "SELECT * FROM funcionario WHERE nivel='20'";
$Inmediato = $conexion->query($q_Inmediato);
$row_Inmediato = $Inmediato->fetch_array(MYSQLI_ASSOC);

?>

<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">INFORME DE ERRORES</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form>
        <div class="form-group row">
            <label for="cite" class="col-sm-2 col-form-label">Cite</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="cite" id="cite" value="SCR/  /Nº   /<?php echo date('Y'); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="para" class="col-sm-2 col-form-label">Para</label>
            <div class="col-sm-10">
                <select class="form-control" name="para" id="para" >
                    <option value="">Seleccione Destinatario</option>
                    <?php do{ ?>
                    <option value="<?php echo $row_Funcionario['id_funcionario']; ?>"><?php echo $row_Funcionario['funcionario']; ?></option>
                    <?php } while($row_Funcionario = $Funcionario->fetch_array(MYSQLI_ASSOC)); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="via" class="col-sm-2 col-form-label">Via</label>
            <div class="col-sm-10">
                <select class="form-control" name="via" id="via">
                    <option value="">Seleccione Via</option>
                    <?php do{ ?>
                    <option value="<?php echo $row_Inmediato['id_funcionario']; ?>"><?php echo $row_Inmediato['funcionario']; ?></option>
                    <?php } while($row_Inmediato = $Inmediato->fetch_array(MYSQLI_ASSOC)); ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="ref" class="col-sm-2 col-form-label">Ref</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ref" id="ref" value="Corrección de Datos Consolidados">
            </div>
        </div>
        <div class="form-group row">
            <textarea id="informe_nota">
            <p>Se&ntilde;or(a) Responsable de Operaciones:</p>
            <p>Mediante el presente informe, me permito indicar a uste, la existencia de un error en la emisi&oacute;n de la C&eacute;dula de Identidad, de: <strong>_____________________________________________________</strong> con CI N&ordm;: <strong>_______________________</strong>, de acuerdo al siguiente detalle:</p>
            <table align="center" border="1" cellpadding="0" cellspacing="0" style="width:100%">
                <tbody>
                <tr>
                    <td><strong>N&ordm; DE CI</strong></td>
                    <td><strong>NOMBRES Y APELLIDOS</strong></td>
                    <td><strong>FECHA DE EXPEDICI&Oacute;N</strong></td>
                    <td><strong>CAMPO ERRADO</strong></td>
                    <td><strong>DATO INCORRECTO</strong></td>
                    <td><strong>DATO CORRECTO</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                </tbody>
            </table>
            <p>&nbsp;
            <p>Error cometido involuntariamente, solicitando respetuosamente a usted, realizar la solicitud respectiva a la ciudad de La Paz, para la correcci&oacute;n del error.</p>
            </p>
            <p>Sin otro particular y agradeciendo su atenci&oacute;n, me despido, con las consideraciones del m&aacute;s alto respeto.</p>
            <p>Atentamente,</p>
            </textarea>
        </div>
        <script>panelEditor();</script>
        <input type="hidden" name="titulo" id="titulo" value="INFORME DE ERROR">
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="informeGuardarOtros();">Guardar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>