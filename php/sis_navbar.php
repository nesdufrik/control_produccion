<?php
session_start();
require_once("sis_conexion.php");
require("sis_funciones.php");

if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['nivel_usuario'])){
    ?>
	<script>
        alert("Usted no inicio Sesion, por favor incie sesion para continuar");
        window.location.href="index.html";
    </script> 
    <?php
    exit;
} else {
    $id_usuario = $_SESSION['id_usuario'];
    $btn_cedula = "1,4,10";
    $btn_licencia = "2,4,10";
    $btn_resp = "3,10";
}

?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="user-home.html">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <!--<li class="nav-item">
                        <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='saneo_registrar_tramite.html'">
                        Iniciar Saneamiento
                        </button>&nbsp;
                    </li>-->
                    <?php if (((isset($_SESSION['id_usuario'])) && (autorizacion("",$btn_cedula, $_SESSION['id_usuario'], $_SESSION['nivel_usuario'])))){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                            Cedulas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="cedula-home.html">Registrar</a>
                            <a class="dropdown-item" href="cedula-regularizar.html">Regularizar</a>
                            <!--<a class="dropdown-item" href="#">Imprimir Reportes</a>-->
                        </div>
                    </li>
                    <?php } ?>
                    <?php if (((isset($_SESSION['id_usuario'])) && (autorizacion("",$btn_licencia, $_SESSION['id_usuario'], $_SESSION['nivel_usuario'])))){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                            Licencias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="licencia-home.html">Registrar</a>
                            <a class="dropdown-item" href="licencia-regularizar.html">Regularizar</a>
                            <a class="dropdown-item" href="licencia-reporte.html">Imprimir Reportes</a>
                        </div>
                    </li>
                    <?php } ?>
                    <?php if (((isset($_SESSION['id_usuario'])) && (autorizacion("",$btn_resp, $_SESSION['id_usuario'], $_SESSION['nivel_usuario'])))){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="licencia-pagos.html">
                            Pagos
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="informes-home.html">
                            Informes
                        </a>
                    </li>
                </ul>
                <?php if (((isset($_SESSION['id_usuario'])) && (autorizacion("",$btn_cedula, $_SESSION['id_usuario'], $_SESSION['nivel_usuario'])))){ ?>
                <div class="navbar-nav dropdown">
                    <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header text-warning">Tengo problemas con...</h6>
                        <a class="dropdown-item" data-toggle="modal" data-target="#problemas" onclick="mostrarProblemas('RUIBIO');" href="#">Sistema Biometrico</a>
                        <a class="dropdown-item disabled" href="#">Sistema RuiSegip</a>
                        <a class="dropdown-item disabled" href="#">Sistema Licencias</a>
                    </div>
                </div>
                <div class="navbar-nav dropdown mr-4">
                    <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" onclick="topCedula();"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l-1.51-.229L8 1.126l-1.355.702-1.51.229-.684 1.365-1.086 1.072L3.614 6l-.25 1.506 1.087 1.072.684 1.365 1.51.229L8 10.874l1.356-.702 1.509-.229.684-1.365 1.086-1.072L12.387 6l.248-1.506-1.086-1.072-.684-1.365z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu p-4 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header">Top Cedulas Emitidas</h6>
                        <div class="small" id="top_cedula"></div>
                    </div>
                </div>
                <?php } ?>
                <div class="navbar-nav dropdown">
                    <a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <h6 class="dropdown-header"><?php echo usuario($id_usuario); ?></h6>
                        <a class="dropdown-item" href="user-config.html">Configuración
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                        <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                        </svg>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="text-danger dropdown-item" href="#" onclick="logout();">Desconectar
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        </a>
                        <!--<a class="dropdown-item" href="#">Imprimir Reportes</a>-->
                    </div>
                </div>
                <input type="hidden" value="logout" id="desconectar">
            </div>
        </div>
    </nav>