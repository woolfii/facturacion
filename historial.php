<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>historial de modificaciones..</title>
	<link rel="stylesheet" href="dtcss/bootstrap.min.css">
	<link rel="stylesheet" href="dtcss/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="dtcss/estilos.css">
	<!-- Buttons DataTables -->
	<link rel="stylesheet" href="dtcss/buttons.bootstrap.min.css">
	<link rel="stylesheet" href="dtcss/font-awesome.min.css">
<!-- menu -->
	 <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


</head>
<body>
<?php
			session_start();
			if(isset($_SESSION['u_usuario'])){
			}
			else{
				header("location: signup.html");
			}
	?>
	<header>
        <div class="menu_bar">
            <a href="#" class="bt-menu"><span class="icon-menu3"></span> MENU </a>
        </div>
		<nav>
							<ul>
							<li><a href="agenda.php"><span class="icon-calendar"></span>Agenda</a></li>
                            <li><a href="eventoslist.php"><span class="icon-file-text"></span>Eventos</a></li>
                            <li><a href="herramienta.php"><span class="icon-linkedin2"></span>Herramientas</a></li>
                            <li><a href="material.php"><span class="icon-linkedin2"></span>Materiales</a></li>
                            <li><a href="clientes.php"><span class="icon-profile"></span>Clientes</a></li>
                            <li><a href="cotizaciones.php"><span class="icon-file-text"></span>Cotizaciones</a></li>
                            <li><a href="historial.php"><span class="icon-file-text"></span>Historial</a></li>
                            <li><a href="cerrar_sesion.php"><img src="">SALIR</a></li>
                            </ul>
				</nav>
                
                    
    </header>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script>

	
	
	<div class="row">
		<div id="cuadro2" class="col-sm-12 col-md-12 col-lg-12 ocultar" >
			<form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<h3 class="col-sm-offset-2 col-sm-8 text-center">					
					Formulario de Registro de Usuarios</h3>
				</div>
				<input type="hidden" id="idusuario" name="idusuario" value="0">
				<input type="hidden" id="opcion" name="opcion" value="registrar">
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombres</label>
					<div class="col-sm-8"><input id="nombre" name="nombre" type="text" class="form-control"  autofocus></div>				
				</div>
				<div class="form-group">
					<label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
					<div class="col-sm-8"><input id="apellidos" name="apellidos" type="text" class="form-control" ></div>
				</div>
				<div class="form-group">
					<label for="apellidos" class="col-sm-2 control-label">Dni</label>
					<div class="col-sm-8"><input id="dni" name="dni" type="text" class="form-control" maxlength="8" ></div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<input id="" type="submit" class="btn btn-primary" value="Guardar">
						<input id="btn_listar" type="button" class="btn btn-primary" value="Listar">
					</div>
				</div>
			</form>
			<div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div id="cuadro1" class="col-sm-12 col-md-12 col-lg-12">
			<div class="col-sm-offset-2 col-sm-8">
				<h3 class="text-center"> <small class="mensaje"></small></h3>
			</div>
			<div class="table-responsive col-sm-12">		
				<table id="dt_hist" class="table table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr><th>El dia:</th>
							<th>El evento:</th>
							<th>con fecha</th>
							<th>Fue:</th>
							<th>Por : </th>
															
							
							
							
															
						</tr>
					</thead>					
				</table>
			</div>			
		</div>		
	</div>
	<div>
		<form id="frmEliminarUsuario" action="" method="POST">
			<input type="hidden" id="idusuario" name="idusuario" value="">
			<input type="hidden" id="opcion" name="opcion" value="eliminar">
			<!-- Modal -->
			<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h4>
						</div>
						<div class="modal-body">							
							¿Está seguro de eliminar al usuario?<strong data-name=""></strong>
						</div>
						<div class="modal-footer">
							<button type="button" onclick="" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
		</form>
	</div>
	
	<script src="dtjs/jquery-1.12.3.js"></script>
	<script src="dtjs/bootstrap.min.js"></script>
	<script src="dtjs/jquery.dataTables.min.js"></script>
	<script src="dtjs/dataTables.bootstrap.js"></script>
	<!--botones DataTables-->	
	<script src="dtjs/dataTables.buttons.min.js"></script>
	<script src="dtjs/buttons.bootstrap.min.js"></script>
	<!--Libreria para exportar Excel-->
	<script src="dtjs/jszip.min.js"></script>
	<!--Librerias para exportar PDF-->
	<script src="dtjs/pdfmake.min.js"></script>
	<script src="dtjs/vfs_fonts.js"></script>
	<!--Librerias para botones de exportación-->
	<script src="dtjs/buttons.html5.min.js"></script>

	<script>		
		$(document).on("ready", function(){
			listar();
		});

		$("#btn_listar").on("click", function(){
			listar();
		});

		var listar = function(){
			var table = $("#dt_hist").DataTable({
				"order": [[ 0, "desc" ]],
				"destroy":true,
				"ajax":{
					"method":"POST",
					"url": "listhistorial.php"
				},
				"columns":[
					{"data":"fechahoy"},
					{"data":"evento"},
					{"data":"fecha"},
					{"data":"accion"},
					{"data":"usuario"}
					
				],
				"language":idioma_espanol
			});
		}
		var idioma_espanol ={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
		
		

	</script>
</body>
</html>
