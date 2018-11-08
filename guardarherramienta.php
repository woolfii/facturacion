<?php
include("conexion.php");

    $id_herramienta = $_POST["id_herramienta"];
    $nombre = $_POST["nombre"];
    $cantidad = $_POST["cantidad"];
    $opcion = $_POST["opcion"];
switch($opcion){
        case 'registrar':
            if( $nombre != "" && $cantidad != ""){
                 $existe = existe_herramienta($nombre, $conexion);
                if($existe >0){
                    $informacion["respuesta"]="EXISTE";
                    echo json_encode($informacion);
                }else{
                    registrar($nombre,$cantidad,$conexion);
            }
                            
            }else{
            $informacion["respuesta"] = "VACIO";
                echo json_encode($informacion);
            }
            break;
        case 'modificar':
            modificar($id_herramienta, $nombre, $cantidad, $conexion  );
            break;
        
        case 'eliminar':
            eliminar($id_herramienta,$conexion);
            break;

        default:
        $informacion["respuesta"]= "OPCION VACIA";
            break;
    }

    function existe_herramienta($nombre, $conexion){
		$query = "SELECT id_herramienta FROM herramientas WHERE nombre = '$nombre';";
		$resultado = mysqli_query($conexion, $query);
		$existe_herramienta = mysqli_num_rows( $resultado );
		return $existe_herramienta;
	}

	function registrar($nombre,$cantidad, $conexion){
		$query = "INSERT INTO herramientas VALUES(0, '$nombre', '$cantidad');";
		$resultado = mysqli_query($conexion, $query);		
		verificar_resultado($resultado);
		cerrar($conexion);
	}

    function modificar( $id_herramienta, $nombre, $cantidad, $conexion  ){
       $query = "UPDATE herramientas SET nombre='$nombre',
                                        cantidad = '$cantidad'
                                    WHERE id_herramienta = $id_herramienta ";
        $resultado = mysqli_query($conexion,$query);
        verificar_resultado($resultado);
        cerrar($conexion);  
    }
    function eliminar($id_herramienta,$conexion){
        $query = "DELETE FROM herramientas WHERE id_herramienta = $id_herramienta ";
        $resultado = mysqli_query($conexion,$query);
        verificar_resultado($resultado);
        cerrar($conexion);  
    }
    function verificar_resultado($resultado){
        if(!$resultado)   $informacion["respuesta"] = "ERROR";
        else $informacion["respuesta"] = "BIEN";
        echo json_encode($informacion);
    }  
    function cerrar($conexion){
        mysqli_close($conexion);
    }

?>