<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="font.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script>
        a = 0;
        function addPeticion(){
            var j=0;
            a++;
            var div = document.createElement('div');
            div.setAttribute('class', 'form-inline');
            div.innerHTML = '<div style="clear:both" class="peticion_'+a+' col-md-offset-1 col-md-2"><input class="form-control" name="producto[]"  type="text" required></div><div class="peticion_'+a+' col-md-2""><input class="form-control" name="descripcion"  type="text" required></div><div class="peticion_'+a+' col-md-2""><input class="form-control" name="precio[]"  type="number" min ="1" step="any"  required></div><div class="peticion_'+a+' col-md-3""><input class="form-control" name="cantidad[]"  type="number" min ="1" required></div>';
            document.getElementById('peticiones').appendChild(div);
         }
    </script>
</head>
 
<body>
<!-- comprueba sesion -->
<?php
			session_start();
			if(isset($_SESSION['u_usuario'])){
			}
			else{
				header("location: signup.html");
			}
	?>
	<header>
		<!-- menu normal y para dispositivos moviles -->
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
                            <li><a href="facturacion.php"><span class="icon-file-text"></span>Facturar</a></li>
                            <li><a href="historial.php"><span class="icon-file-text"></span>Historial</a></li>
                            <li><a href="cerrar_sesion.php"><img src="">SALIR</a></li>
                            </ul>
				</nav>
                    
    </header>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script><!-- efectos del menu responsive -->



<div class="container">
    <form action="facturar.php" id="formulario" method="get" ><br/>
        <div class="row"><!-- receptor -->
            <div class="col-md-offset- col-md-10"><label>Datos del Receptor:</label></div>
        </div><br/><br/>
        <div class="row"><!-- receptor -->
            <div class="col-md-offset-1 col-md-1"><label>RFC</label></div>
            <div class="col-md-4"><input class="form-control" name="rfc" type="text" required></div><br/>
        </div><br/>
        <div class="row"><!-- receptor -->
            <div class="col-md-offset-1 col-md-1"><label># Nombre</label></div>
            <div class="col-md-6"><input class="form-control" name="nombreCliente" type="text" required></div><br/>
        </div><br/>
        <div class="row"><!-- receptor -->
            <div class="col-md-offset-1 col-md-1"><label># Correo</label></div>
            <div class="col-md-6"><input class="form-control" name="correo" type="email" required></div><br/>
        </div><br/>

        
        <div class="row"><!-- receptor -->
            <div class="col-md-offset-1 col-md-5"><button type="submit" class=" btn btn-primary btn-block">Facturar</button></div>
            </div><br/>
    </form>
</div>



</body>
</html>