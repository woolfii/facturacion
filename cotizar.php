<?php
include("conexion.php");
require('fpdf181/fpdf.php');
date_default_timezone_set("America/Mexico_City");
$producto = $_GET['producto'];
$precio = $_GET['precio'];
$cantidad = $_GET['cantidad'];
$cotizacion = $_GET['cot'];
$fecha_actual = date('Y-m-d H:i:s');
class PDF extends FPDF
{
    public $producto = array();
    public $precio=array();
    public $cantidad=array();
    public $cotizacion=array();

    function construct($producto, $precio, $cantidad, $cotizacion,$fecha_actual ) {
        $this->producto = $producto;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->cotizacion = $cotizacion;
        $this->fecha_actual = $fecha_actual;
    }
    //Cabecera de página
   function Header()
   {
    //Logo
    $this->Image("secttt.png" , 10 ,8, 190 , 25 , "png" ,"http://localhost/SECT/cotizaciones.php");
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Ln(30);
    $this->Cell(0,0,'Cotizacion: '.$this->cotizacion." ",0,0,'L');
    $this->Ln(10);
    $this->Cell(0,0,'Empresa: SECT S.A. de C.V.',0,0,'L');
    //Salto de línea
    $this->Ln(10);
    $this->Cell(0,0,'Fecha de cotizacion: '.$this->fecha_actual." ",0,0,'L');
    $this->Ln(20);
    $this->Ln(20);
    
      
   }
   
   function Footer()
   {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
        //Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
 
   //Tabla coloreada
    function TablaColores($header)
    {
        //Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(10,5,86);
        $this->SetTextColor(255);
        $this->SetDrawColor(23, 23, 23);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        //Cabecera

        for($i=0;$i<count($header);$i++)
        $this->Cell(48,7,$header[$i],1,0,'C',1);
        $this->Ln();
        //Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');

        //Datos
        $fill=false;
        $long = count($this->producto);
        for ($i=0; $i<$long; $i++) {
            $productoD = $this->producto[$i]; 
            $precioD = $this->precio[$i]; 
            $cantidadD = $this->cantidad[$i];

            $this->Cell(48,6,$productoD,'LR',0,'L',$fill);
            $this->Cell(48,6,"$".$precioD,'LR',0,'L',$fill);
            $this->Cell(48,6,$cantidadD ,'LR',0,'R',$fill);
            $this->Cell(48,6,"$".($precioD*$cantidadD),'LR',0,'R',$fill);
            $this->Ln();
            $fill=!$fill;
        }
        $fill=true;
        $this->Cell(192,0,'','T');

        $subtot=0;
        $taxes=0;
        $tot=0;
        for ($i=0; $i<$long; $i++) {
            $multiplicacion = ($this->precio[$i] * $this->cantidad[$i]);
            $subtot = $subtot + $multiplicacion;
        }
        $taxes = ($subtot * .16);
        $tot = $subtot + $taxes;
        
        $this->Cell(48,6,"");
        $this->Ln();
        $this->Cell(0,6,"Subtotal : $" . $subtot . " ",0,0,"R");
        $this->Ln();
        $this->Cell(0,6,"IVA(16%) : $" . $taxes . " ",0,0,"R");
        $this->Ln();
        $this->Cell(0,6,"Total : $" . $tot . " ",0,0,"R");
    }
    

   
   
}
$existeCot = existe_cotizacion($conexion, $cotizacion);
if($existeCot>0) {
    $cotizacion = $cotizacion." 1";
    registrar($conexion, $cotizacion, $producto, $precio, $cantidad);
    $pdf = new PDF();
    $pdf->construct($producto, $precio, $cantidad, $cotizacion,$fecha_actual);
    $header=array('Producto|Servicio','Precio unit.','Cantidad','Importe');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetY(65);
    $pdf->TablaColores($header);
    $pdf->Output("Cotizacion-$cotizacion.pdf", "D");
}
else {
    registrar($conexion, $cotizacion, $producto, $precio, $cantidad);
    $pdf = new PDF();
    $pdf->construct($producto, $precio, $cantidad, $cotizacion,$fecha_actual);
    $header=array('Producto|Servicio','Precio unit.','Cantidad','Importe');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetY(65);
    $pdf->TablaColores($header);
    $pdf->Output("Cotizacion-$cotizacion.pdf", "D");
}


function existe_cotizacion($conexion, $cotizacion){
    $query = "SELECT id_cotizacion FROM cotizaciones WHERE cotizacion = '$cotizacion';";
    $resultado = mysqli_query($conexion, $query);
    $existe_cotizacion = mysqli_num_rows( $resultado );
    return $existe_cotizacion;
}

function registrar($conexion, $cotizacion, $producto, $precio, $cantidad){
    $long = count($producto);
    for ($i=0; $i<$long; $i++) {
        $productoD = $producto[$i]; 
        $precioD = $precio[$i]; 
        $cantidadD = $cantidad[$i];
        $query1 = "INSERT INTO cotizaciones VALUES(0, '$cotizacion', '$productoD', '$precioD','$cantidadD');";
        $resultado1 = mysqli_query($conexion, $query1);	
    }
    
}




?>