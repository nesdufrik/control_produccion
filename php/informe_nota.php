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
    <h4 class="modal-title">NOTAS</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form>
        <div class="form-group row">
            <label for="titulo" class="col-sm-2 col-form-label">Titulo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo para la nota" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="cite" class="col-sm-2 col-form-label">Cite</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="cite" id="cite" placeholder="Cite si corresponde" value="">
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
                <input type="text" class="form-control" name="ref" id="ref" placeholder="Asunto de la nota" value="">
            </div>
        </div>
        <div class="form-group row">
            <textarea id="informe_nota">
            <p>Presente.-</p>
            <p>De mi mayor consideraci&oacute;n:</p>
            <p>A tiempo de saludarle, me dirijo a su persona para solicitarle que por la secci&oacute;n que corresponda, se me pueda <strong>AUTORIZAR VACACIONES PARA EL DIA ## al ## de ##### del 20##</strong>, puesto que mi solicitud ya se encuentra programada en jefatura de operaciones.</p>
            <p>Sin otro particular me despido cordialmente, esperando que mi solicitud sea aceptada.</p>
            <p>&nbsp;</p>
            <p>Atentamente,</p>
            </textarea>
        </div>
        <script>panelEditor();</script>
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="informeGuardarOtros();">Guardar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>