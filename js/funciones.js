/*----------------------------
||							||
||		ACCESO USUARIOS		||
||							||
----------------------------*/

//Iniciar Sesion Login Usuario 24-11-2020
$(document).ready(function(){
    $("#login").submit(function(){
        $.ajax({
            url: 'php/sis_validar_usuario.php',
            type: 'POST',
            data: {
                usuario: $("#usuario").val(),
                pass: $("#pass").val()
            },
            success: function(respuesta){
                $("#mostrardatos").html(respuesta);
            },
        });
    });
});

//Finalizar Sesion Logout Usuario
function logout() {
	var desconectar = document.getElementById("desconectar").value;
	var url = "php/sis_logout.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			desconectar: desconectar
		},
		success: function(datos) {
			$("#mostrarDesconexion").html(datos);
		}
	});
}

//Barra de navegacion por usuario
function navbar() {
	var url = "php/sis_navbar.php";
	$.ajax({
		type: "post",
		url: url,
		success: function(datos) {
			$("#navbar").html(datos);
		}
	});
}

//Limpiar formulario
function limpiar(formulario) {
    setTimeout('document.'+formulario+'.reset()',1000);
    return false;
}

//Contenido de problemas
function mostrarProblemas(sistema) {
	let url = "php/sis_problemas_mostrar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			sistema: sistema
		},
		success: function(datos) {
			$("#contenidoproblemas").html(datos);
		}
	})
}

//Registrar problemas
function registrarProblemas(problema) {
	let url = "php/sis_problemas_registrar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			problema: problema
		},
		success: function(datos) {
			$("#mostrarDesconexion").html(datos);
		}
	})
}

/*----------------------------
||							||
||	CONFIGURACION/RESP		||
||							||
----------------------------*/

//Tooltip
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

//Imprimir
function imprimir(historial){
	var ficha=document.getElementById(historial);
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
}

//Panel de Edicion de Informe
function panelEditor(){
    CKEDITOR.replace('informe_nota',{
		height: 320
	});
}

//Actualizar datos personales usuario del sistema
function actualizarUsuario() {
	var nom_usuario = document.getElementById("nom_usuario").value;
	var cargo_usuario = document.getElementById("cargo_usuario").value;
	var pass_usuario_ant = document.getElementById("pass_usuario_ant").value;
	var pass_usuario_new1 = document.getElementById("pass_usuario_new1").value;
	var pass_usuario_new2 = document.getElementById("pass_usuario_new2").value;
	var url = "php/gen_actualizar_usuario.php";
	
	$.ajax({
		type: "post",
		url: url,
		data: {
			nom_usuario: nom_usuario,
			cargo_usuario: cargo_usuario,
			pass_usuario_ant: pass_usuario_ant,
			pass_usuario_new1: pass_usuario_new1,
			pass_usuario_new2: pass_usuario_new2
		},
		success: function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Mostrar Datos del Usuario/Funcionario
function updateUsuario() {
	var url = "php/gen_configuracion.php";
	$.ajax({
		type: "post",
		url: url,
		success: function(datos) {
			$("#updateUsuario").html(datos);
		}
	});
}

/*----------------------------
||							||
||			CEDULAS			||
||							||
----------------------------*/

//Registrar Cedula
$(document).ready(function(){
    $("#form_cedula").submit(function(){
        $.ajax({
            url: 'php/cedula_guardar.php',
            type: 'POST',
            data: {
                ci:$("#ci").val(),
                edad:$("#edad").val(),
                tipo:$("#tipo").val(),
                ra:$("#ra").val(),
                cultural:$("#cultural").val()
            },
            success: function(respuesta){
                $("#mostrardatos").html(respuesta);
            },
        });
    });
});

//Regularizar Cedula
$(document).ready(function(){
    $("#form_cedula_regularizar").submit(function(){
		var fecha = document.getElementById("fecha").value;
        $.ajax({
            url: 'php/cedula_regularizar.php',
            type: 'POST',
            data: {
                ci:$("#ci").val(),
                edad:$("#edad").val(),
                tipo:$("#tipo").val(),
                ra:$("#ra").val(),
				cultural:$("#cultural").val(),
				fecha: fecha
            },
            success: function(respuesta){
                $("#mostrardatos").html(respuesta);
            },
        });
    });
});

//Modificar Cedula
function modificarCedula(id_control) {
	var id_control = id_control;
	var url = "php/cedula_modificar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_control: id_control
		},
		success: function(datos) {
			$("#mostrarModificar").html(datos);
		}
	});
}

//Actualizar Cedula
function actualizarCedula(id_control) {
	var id_control = id_control;
	var ci_control = document.getElementById("ci_control_m").value;
	var edad = document.getElementById("edad_m").value;
	var tipo = document.getElementById("tipo_m").value;
	var juridico = document.getElementById("juridico_m").value;
	var cultural = document.getElementById("cultural_m").value;
	var url = "php/cedula_actualizar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_control: id_control,
			ci_control: ci_control,
			edad: edad,
			tipo: tipo,
			juridico: juridico,
			cultural: cultural
		},
		success: function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Borrar Cedula
function borrarCedula(id_control) {
	var id_control = id_control;
	var url = "php/cedula_borrar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_control: id_control
		},
		success: function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Listar Cedula
function listarCedula(valor) {
	var fecha = valor;
	var url = "php/cedula_listar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			fecha: fecha
		},
		success: function(datos) {
			$("#listarCedula").html(datos);
		}
	});
}

//Top Cedula
function topCedula() {
	var url = "php/cedula_top.php";
	$.ajax({
		type: "post",
		url: url,
		success: function(datos) {
			$("#top_cedula").html(datos);
		}
	});
}

/*----------------------------
||							||
||			LICENCIAS		||
||							||
----------------------------*/

//Registrar Licencia
$(document).ready(function(){
    $("#form_licencia").submit(function(){
        $.ajax({
            url: 'php/licencia_guardar.php',
            type: 'POST',
            data: {
                ci_control:$("#ci_control").val(),
                cat_lic:$("#cat_lic").val(),
				tipo:$("#tipo").val(),
				cm_transito:$("#cm_transito").val(),
				cm_particular:$("#cm_particular").val(),
				eva_oft:$("#eva_oft").val(),
				ce_transito:$("#ce_transito").val(),
				ce_particular:$("#ce_particular").val(),
				antecedentes:$("#antecedentes").val(),
				res_adm:$("#res_adm").val(),
				hoja_reg:$("#hoja_reg").val(),
				eva_psi:$("#eva_psi").val(),
				form_denuncia:$("#form_denuncia").val(),
                dec_jur:$("#dec_jur").val(),
				notas:$("#notas").val(),
				fotocopias:$("#fotocopias").val()
            },
            success: function(respuesta){
                $("#mostrardatos").html(respuesta);
            },
        });
    });
});

//Regularizar Licencia
$(document).ready(function(){
    $("#form_licencia_regularizar").submit(function(){
		var fecha = document.getElementById("fecha").value;
        $.ajax({
            url: 'php/licencia_regularizar.php',
            type: 'POST',
            data: {
                ci_control:$("#ci_control").val(),
                cat_lic:$("#cat_lic").val(),
				tipo:$("#tipo").val(),
				cm_transito:$("#cm_transito").val(),
				cm_particular:$("#cm_particular").val(),
				eva_oft:$("#eva_oft").val(),
				ce_transito:$("#ce_transito").val(),
				ce_particular:$("#ce_particular").val(),
				antecedentes:$("#antecedentes").val(),
				res_adm:$("#res_adm").val(),
				hoja_reg:$("#hoja_reg").val(),
				eva_psi:$("#eva_psi").val(),
				form_denuncia:$("#form_denuncia").val(),
                dec_jur:$("#dec_jur").val(),
				notas:$("#notas").val(),
				fotocopias:$("#fotocopias").val(),
				fecha: fecha
            },
            success: function(respuesta){
                $("#mostrardatos").html(respuesta);
            },
        });
    });
});

//Modificar Cedula 24-11-2020
function modificarLicencia(id_control) {
	var id_control = id_control;
	var url = "php/licencia_modificar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_control: id_control
		},
		success: function(datos) {
			$("#mostrarModificar").html(datos);
		}
	});
}

//Actualizar Licencia 24-11-2020
function actualizarLicencia(id_control) {
	var id_control = id_control;
	var ci_control = document.getElementById("ci_control_m").value;
	var cat_lic = document.getElementById("cat_lic_m").value;
	var tipo = document.getElementById("tipo_m").value;
	var cm_transito = document.getElementById("cm_transito_m").value;
	var cm_particular = document.getElementById("cm_particular_m").value;
	var eva_oft = document.getElementById("eva_oft_m").value;
	var ce_transito = document.getElementById("ce_transito_m").value;
	var ce_particular = document.getElementById("ce_particular_m").value;
	var antecedentes = document.getElementById("antecedentes_m").value;
	var res_adm = document.getElementById("res_adm_m").value;
	var hoja_reg = document.getElementById("hoja_reg_m").value;
	var eva_psi = document.getElementById("eva_psi_m").value;
	var form_denuncia = document.getElementById("form_denuncia_m").value;
	var dec_jur = document.getElementById("dec_jur_m").value;
	var notas = document.getElementById("notas_m").value;
	var fotocopias = document.getElementById("fotocopias_m").value;
	var url = "php/licencia_actualizar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_control: id_control,
			ci_control: ci_control,
			cat_lic: cat_lic,
			tipo: tipo,
			cm_transito: cm_transito,
			cm_particular: cm_particular,
			eva_oft: eva_oft,
			ce_transito: ce_transito,
			ce_particular: ce_particular,
			antecedentes: antecedentes,
			res_adm: res_adm,
			hoja_reg: hoja_reg,
			eva_psi: eva_psi,
			form_denuncia: form_denuncia,
			dec_jur: dec_jur,
			notas: notas,
			fotocopias: fotocopias
		},
		success: function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Borrar Licencia 24-11-2020
function borrarLicencia(id_control) {
	var id_control = id_control;
	var url = "php/licencia_borrar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_control: id_control
		},
		success: function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Listar Licencias
function listarLicencia(valor) {
	var fecha = valor;
	var url = "php/licencia_listar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			fecha: fecha
		},
		success: function(datos) {
			$("#listarCedula").html(datos);
		}
	});
}

//Mostrar Reporte LICENCIAS
function mostrarReporte(valor) {
	var fecha = valor;
	var url = "php/licencia_reporte.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			fecha_reporte: fecha
		},
		success: function(datos) {
			$("#listarCedula").html(datos);
		}
	});
}

//Licencia Solicitud de Pago
$(document).ready(function(){
    $("#solicitud").submit(function(){
        $.ajax({
            url: 'php/licencia_pago.php',
            type: 'POST',
            data: {
                user_ci:$("#user_ci").val(),
                user_complemento:$("#user_complemento").val(),
                user_nombre:$("#user_nombre").val(),
                user_cel:$("#user_cel").val(),
				user_cat1:$("#user_cat1").val(),
				user_tipo1:$("#user_tipo1").val(),
				user_exp1:$("#user_exp1").val(),
				user_cat2:$("#user_cat2").val(),
				user_tipo2:$("#user_tipo2").val(),
				user_exp2:$("#user_exp2").val(),
				user_cat3:$("#user_cat3").val(),
				user_tipo3:$("#user_tipo3").val(),
				user_exp3:$("#user_exp3").val()
            },
            success: function(respuesta){
				$("#mostrardatos").html(respuesta);
            },
        });
    });
});

/*----------------------------
||							||
||	REPORTES/INFORMES		||
||							||
----------------------------*/

//Crear Informe Mensual
function informeMensual() {
	var mes = document.getElementById("mes").value;
	var anio = document.getElementById("anio").value;
	$.ajax({
		url: "php/informe_mensual.php",
		method: 'post',
		data: {
			mes: mes,
			anio: anio
		},
		success:function(datos) {
			$("#modalinforme").html(datos);
		}
	});
}

//Crear Informe Errores
function informeError() {
	$.ajax({
		url: "php/informe_error.php",
		method: 'post',
		success:function(datos) {
			$("#modalinforme").html(datos);
		}
	});
}

//Crear Notas Institucionales
function informeNota() {
	$.ajax({
		url: "php/informe_nota.php",
		method: 'post',
		success:function(datos) {
			$("#modalinforme").html(datos);
		}
	});
}

//Guardar Informe Mensual
function informeGuardar() {
	var titulo = document.getElementById("titulo").value;
	var marco = CKEDITOR.instances.informe_nota.getData();
	var cite = document.getElementById("cite").value;
	var n_mes = document.getElementById("n_mes").value;
	var para = document.getElementById("para").value;
	var via = document.getElementById("via").value;
	$.ajax({
		url: "php/informe_guardar.php",
		method: 'post',
		data: {
			titulo: titulo,
			marco: marco,
			cite: cite,
			n_mes: n_mes,
			para: para,
			via: via
		},
		success:function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Guardar Informe Mensual
function informeGuardarOtros() {
	var titulo = document.getElementById("titulo").value;
	var marco = CKEDITOR.instances.informe_nota.getData();
	var cite = document.getElementById("cite").value;
	var ref = document.getElementById("ref").value;
	var para = document.getElementById("para").value;
	var via = document.getElementById("via").value;
	$.ajax({
		url: "php/informe_guardar_otros.php",
		method: 'post',
		data: {
			titulo: titulo,
			marco: marco,
			cite: cite,
			ref: ref,
			para: para,
			via: via
		},
		success:function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Modificar Informe
function modificarInforme(id_inf) {
	var id_inf = id_inf;
	var url = "php/informe_modificar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_inf: id_inf
		},
		success: function(datos) {
			$("#modalinforme").html(datos);
		}
	});
}

function informeActualizar() {
	var id_inf = document.getElementById("id_inf").value;
	var titulo = document.getElementById("titulo").value;
	var marco = CKEDITOR.instances.informe_nota.getData();
	var cite = document.getElementById("cite").value;
	var ref = document.getElementById("ref").value;
	var para = document.getElementById("para").value;
	var via = document.getElementById("via").value;
	$.ajax({
		url: "php/informe_actualizar.php",
		method: 'post',
		data: {
			id_inf: id_inf,
			titulo: titulo,
			marco: marco,
			cite: cite,
			ref: ref,
			para: para,
			via: via
		},
		success:function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Borrar Informe
function borrarInforme(id_inf) {
	var id_inf = id_inf;
	var url = "php/informe_borrar.php";
	$.ajax({
		type: "post",
		url: url,
		data: {
			id_inf_nota: id_inf
		},
		success: function(datos) {
			$("#mostrardatos").html(datos);
		}
	});
}

//Listar Informes
function listarInformes() {
	var url = "php/informe_listar.php";
	$.ajax({
		type: "post",
		url: url,
		success: function(datos) {
			$("#listarInformes").html(datos);
		}
	});
}

//Imprimir Informes / Notas
function imprimirInforme(nombre) {
	$.ajax({
		url: "php/informe_imprimir.php",
		method: 'post',
		data: {
			id_inf_nota: nombre
		},
		success:function(datos) {
			$("#modalinforme").html(datos);
		}
	});
}