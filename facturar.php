<?php
include("conexion.php");
require('fpdf181/fpdf.php');
date_default_timezone_set("America/Mexico_City");
$producto = $_GET['producto'];
$precio = $_GET['precio'];
$cantidad = $_GET['cantidad'];
$cotizacion = $_GET['cot'];
$rfc = $_GET['rfc'];
$nombreCliente = $_GET['nombreCliente'];
$correo = $_GET['correo'];
$fecha_actual = date('Y-m-d H:i:s');

class PDF extends FPDF
{
    public $producto = array();
    public $precio=array();
    public $cantidad=array();
    public $cotizacion=array();
    public $rfc;
    public $correo;
    public $nombreCliente;

    function construct($producto, $precio, $cantidad, $cotizacion, $fecha_actual, $rfc, $nombreCliente, $correo ) {
        $this->producto = $producto;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->cotizacion = $cotizacion;
        $this->fecha_actual = $fecha_actual;
        $this->rfc = $rfc;
        $this->correo = $correo;
        $this->nombreCliente = $nombreCliente;
    }
    //Cabecera de página
   function Header()
   {
    //Logo
    $this->Image("secttt.png" , 115 ,8, 85 , 50 , "png" ,"http://localhost/SECT/cotizaciones.php");
    //Arial bold 15
    $this->SetFont('Arial','b',15);
    $this->Ln(10);
    $this->Cell(0,0,'CFDI V.3.3',0,0,'L');
    $this->SetFont('Arial','',15);
    $this->Ln(10);
    $this->Cell(0,0,'Serie:10965 ',0,0,'L');
    $this->Ln(10);
    $this->Cell(0,0,'Tipo de comprobante: Ingreso',0,0,'L');
    $this->Ln(10);
    $this->Cell(0,0,'Durango Dgo. a: '.$this->fecha_actual." ",0,0,'L');
    $this->Ln(10);
    
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
      
        $this->SetFillColor(10,5,86);
        $this->SetTextColor(255);
        $this->SetDrawColor(23, 23, 23);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $this->Cell(0,6,"Datos del emisor:",0,0,"C",true);
        $this->Ln(10);
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial','',15);
        $this->Cell(0,6,"RFC: GAAJ970502FZ4",0,0,"L");
        $this->Ln();
        $this->Cell(0,6,"Empresa: S.E.C.T. telecomunicaciones",0,0,"L",false); 
        $this->Ln();
        $this->Cell(0,6,"Regimen fiscal: Regimen de Incorporacion Fiscal  ",0,0,"L");

        $this->SetFillColor(10,5,86);
        $this->SetTextColor(255);
        $this->SetDrawColor(23, 23, 23);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        $this->Ln(20);
        $this->Cell(0,6,"Datos del receptor:",0,0,"C",true);
        $this->Ln(10);
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('Arial','',15);
        $this->Cell(0,6,"RFC: ".$this->rfc." ",0,0,"L"); 
        $this->Ln();
        $this->Cell(0,6,"nombre: ".$this->nombreCliente."",0,0,"L");
        $this->Ln();
        $this->Cell(0,6,"Uso CFDI: G01",0,0,"L");
        $this->Ln(20);
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
  
              $this->Cell(48,6,$productoD,'LR',0,'C',$fill);
              $this->Cell(48,6,"$".$precioD,'LR',0,'C',$fill);
              $this->Cell(48,6,$cantidadD ,'LR',0,'C',$fill);
              $this->Cell(48,6,"$".($precioD*$cantidadD),'LR',0,'C',$fill);
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
          $this->Cell(0,6,"Tipo de cambio: MXN ",0,0,"R");
          $this->Ln();
          $this->Cell(0,6,"Subtotal : $" . $subtot . " ",0,0,"R");
          $this->Ln();
          $this->Cell(0,6,"IVA(16%) : $" . $taxes . " ",0,0,"R");
          $this->Ln();
          $this->Cell(0,6,"Total : $" . $tot . " ",0,0,"R");
    }
    

   
   
}


    $pdf = new PDF();
    $pdf->construct($producto, $precio, $cantidad, $cotizacion, $fecha_actual, $rfc, $nombreCliente, $correo);
    $header=array('Producto|Servicio','Precio unit.','Cantidad','Importe');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetY(65);
    $pdf->TablaColores($header);
    $pdf->Output("Facturacion-$nombreCliente.pdf", "D");
    $pdf->Output();






?>