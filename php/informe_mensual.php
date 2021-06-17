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

//CONSULTA DEL INFORME MENSUAL CEDULAS Y LICENCIAS
$mes = $_POST["mes"];
$anio = $_POST["anio"];

if($mes==1){
  $n_mes='Enero';
}
if($mes==2){
  $n_mes='Febrero';
}
if($mes==3){
  $n_mes='Marzo';
}
if($mes==4){
  $n_mes='Abril';
}
if($mes==5){
  $n_mes='Mayo';
}
if($mes==6){
  $n_mes='Junio';
}
if($mes==7){
  $n_mes='Julio';
}
if($mes==8){
  $n_mes='Agosto';
}
if($mes==9){
  $n_mes='Septiembre';
}
if($mes==10){
  $n_mes='Octubre';
}
if($mes==11){
  $n_mes='Noviembre';
}
if($mes==12){
  $n_mes='Diciembre';
}

$q_Cedulas = "SELECT c.id_funcionario AS id_fun, COUNT(c.tipo) AS Total_Tramites, COUNT(IF(c.tipo='REPOSICION',1,NULL)) REPOSICIONES, COUNT(IF(c.tipo='NUEVO',1,NULL)) NUEVOS, COUNT(IF(c.tipo='RENOVACION',1,NULL)) RENOVACIONES, COUNT(IF(c.tipo='SOLICITANTE',1,NULL)) SOLICITANTES, SUM(c.juridico) AS T_Juridicos, SUM(c.cultural) AS T_Cultural FROM control_ci c, funcionario f WHERE MONTH(c.fecha)=$mes AND YEAR(c.fecha)=$anio AND c.id_funcionario=f.id_funcionario AND f.usuario='$usuario'";
$Cedulas = $conexion->query($q_Cedulas);
$row_Cedulas = $Cedulas->fetch_array(MYSQLI_ASSOC);
$total_cedulas = $row_Cedulas['REPOSICIONES']+$row_Cedulas['NUEVOS']+$row_Cedulas['RENOVACIONES'];

$q_Licencias = "SELECT l.id_funcionario AS id_fun, COUNT(l.cat_lic) AS Total_Licencias, COUNT(IF(l.cat_lic='A',1,NULL)) 'CAT_A', COUNT(IF(l.cat_lic='B',1,NULL)) 'CAT_B', COUNT(IF(l.cat_lic='C',1,NULL)) 'CAT_C', COUNT(IF(l.cat_lic='P',1,NULL)) 'CAT_P', COUNT(IF(l.cat_lic='M',1,NULL)) 'CAT_M', COUNT(IF(l.cat_lic='T',1,NULL)) 'CAT_T' FROM control_lic l, funcionario f WHERE MONTH(l.fecha)=$mes AND YEAR(l.fecha)=$anio AND l.id_funcionario=f.id_funcionario AND f.usuario='$usuario'";
$Licencias = $conexion->query($q_Licencias);
$row_Licencias = $Licencias->fetch_array(MYSQLI_ASSOC);
?>

<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">INFORME MENSUAL</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
    <form>
        <div class="form-group row">
            <label for="cite" class="col-sm-2 col-form-label">Cite</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="cite" id="cite" value="<?php echo $mes."/".$anio; ?>">
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
            <textarea id="informe_nota">
            <p>Se&ntilde;or (a) Jefe de Operaciones:</p>
            <p>Por medio de la presente, me permito presentar el informe mensual correspondiente al mes de <strong><?php echo $n_mes; ?></strong> de la gestion <strong><?php echo $anio; ?></strong>.</p>
            <?php if($row_Cedulas['Total_Tramites'] > 0){ ?>
            <table border="1" cellpadding="0" cellspacing="0" style="width:600px">
                <tbody>
                    <tr>
                        <td colspan=2><strong>Cedulas de Identidad</strong></td>
                    </tr>
                    <tr>
                        <td>
                        <ul>
                            <li>Registro Nuevos: <?php echo $row_Cedulas['NUEVOS']; ?></li>
                            <li>Registro Renovaciones: <?php echo $row_Cedulas['RENOVACIONES']; ?></li>
                            <li>Registro&nbsp;Reposiciones: <?php echo $row_Cedulas['REPOSICIONES']; ?></li>
                        </ul>
                        </td>
                        <td>
                        <ul>
                            <li>Registro Juridicos: <?php echo $row_Cedulas['T_Juridicos']; ?></li>
                            <li>Registro de solicitantes: <?php echo $row_Cedulas['SOLICITANTES']; ?></li>
                            <li>Registro de Identidad Cultural: <?php echo $row_Cedulas['T_Cultural']; ?></li>
                        </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } if($row_Licencias['Total_Licencias'] > 0){ ?>
            <table border="1" cellpadding="0" cellspacing="0" style="width:600px">
                <tbody>
                    <tr>
                        <td colspan=2><strong>Licencias para Conducir</strong></td>
                    </tr>
                    <tr>
                        <td>
                        <ul>
                            <li>Categoria A: <?php echo $row_Licencias['CAT_A'] ?></li>
                            <li>Categoria B: <?php echo $row_Licencias['CAT_B'] ?></li>
                            <li>Categoria C: <?php echo $row_Licencias['CAT_C'] ?></li>
                        </ul>
                        </td>
                        <td>
                        <ul>
                            <li>Categoria P: <?php echo $row_Licencias['CAT_P'] ?></li>
                            <li>Categoria M: <?php echo $row_Licencias['CAT_M'] ?></li>
                            <li>Categoria T: <?php echo $row_Licencias['CAT_T'] ?></li>
                        </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php } ?>
            <ul>
                <?php if($row_Cedulas['Total_Tramites'] > 0){ ?>
                <li>Total de tramites de Cedulas: <strong><?php echo $row_Cedulas['Total_Tramites']; ?></strong></li>
                <li>Total de Cedulas Emitidas: <strong><?php echo $total_cedulas; ?></strong></li>
                <?php } if($row_Licencias['Total_Licencias'] > 0){ ?>
                <li>Total de Licencias Emitidas: <strong><?php echo $row_Licencias['Total_Licencias']; ?></strong></li>
                <?php } ?>
                <li>Otros...</li>
            </ul>
            <p>Es todo cuanto tengo a bien informar.</p>
            <p>Atentamente,</p>
            </textarea>
        </div>
        <script>panelEditor();</script>
        <input type="hidden" name="titulo" id="titulo" value="INFORME MENSUAL">
        <input type="hidden" name="n_nes" id="n_mes" value="<?php echo $n_mes; ?>">
    </form>
</div>
<!-- Modal footer -->
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="informeGuardar();">Guardar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>