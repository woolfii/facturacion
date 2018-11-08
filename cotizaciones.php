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
            div.innerHTML = '<form method="POST" oninput="resultado.value=parseInt(valor1.value)*parseInt(valor2.value)"><div class="col-md-offset-1 col-md-3"><input class="form-control" name="productos[]"  type="text"/> </div><div class="col-md-3"><input class="form-control" type="number" id="valor1" name="precio[]" value="0"> </div><div class="col-md-3"><input class="form-control" type="number" id="valor2" name="cantidad[]" value="0"></div><div class="col-md-2"><output name="resultado" for="valor1 valor2"></output></div></form>';
            document.getElementById('peticiones').appendChild(div);
            document.getElementById('peticiones').appendChild(div);
           //'<div style="clear:both" class="peticion_'+a+' col-md-offset-1 col-md-3"><input class="form-control" name="productos[]"  type="text"/></div><div class="peticion_'+a+' col-md-3""><input class="form-control" name="precio[]"  type="number"/></div><div class="peticion_'+a+' col-md-3""><input class="form-control" name="cantidad[]"  type="number"/></div><div class="peticion_'+a+' col-md-1""><input class="form-control" name="importe[]"  type="number"/></div>';
            
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
                            <li><a href="cotizaciones.php"><span class="icon-file-text"></span>Facturar</a></li>
                            <li><a href="historial.php"><span class="icon-file-text"></span>Historial</a></li>
                            <li><a href="cerrar_sesion.php"><img src="">SALIR</a></li>
                            </ul>
				</nav>
                    
    </header>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script><!-- efectos del menu responsive -->



<div class="container">
    <form action="cotizaciones.php" id="formulario" method="get"><br/><br/>
    <div class="row">
        <div class="col-md-offset-1 col-md-2"><label>Nombre Cotizacion:</label></div>
        <div class="col-md-6"><input class="form-control" name="cot" type="text"/></div>
    </div><br/><br/>

    <div class="row">
        <div class="col-md-offset-1 col-md-3"><label>Producto | Servicio</label></div>
        <div class="col-md-3"><label>Precio unit.</label></div>
        <div class="col-md-3"><label>Cantidad</label></div>
        <div class="col-md-2"><label>Importe</label></div>
     
</div>

    <div class="row" id="peticiones"> </div><br/>

    <div class="row">
    
    <div class="col-md-offset-10 col-md-3"><label>sub-total:</label>
    <label>
            <?php
            
            function calculoSubTot(){
                $importe = $_GET['importe'];
                $subt = 0;
                foreach ($importe as $valor) {
                    $subt = $subt + $valor;
                }
                print $subt;   
            }
            
            ?>
    </label></div><br/>
    <div class="col-md-offset-10 col-md-3"><label>iva(16%):</label></div><br/>
    <div class="col-md-offset-10 col-md-3"><label>Total</label></div><br/>
    <div class="col-md-offset-10 col-md-3"><input type="button" class="btn btn-success" id="add_peticion()" onClick="addPeticion()" value="+" />
    <input type="button" class="btn btn-primary" id="add_peticion()" onClick="calculoSubTot()" value="=" /></div><br/>
    </div>
    <div class="col-md-offset-1 col-md-6">
        <button type="submit" class=" btn btn-primary btn-block">GENERAR</button>
    </div>
    
    </form>
</div>



</body>
</html>