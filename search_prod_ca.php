<?php
// Procesamos en envio desde el input via POST
$palabraclave = strval($_POST['busqueda']);
$busqueda = "{$palabraclave}%";
// Realizamos la conexión MySQLi
$conexion =new mysqli('localhost', 'root', '' , 'cadig');
// Preparamos la consulta para realizar la busqueda del criterio
$consultaDB = $conexion->prepare("SELECT * FROM productos
INNER JOIN proveedor ON proveedor.id_proveedor = productos.id_proveedor
INNER JOIN categorias ON categorias.id_categorias = productos.id_categorias WHERE productos.nombre_producto LIKE ?");
$consultaDB->bind_param("s",$busqueda);
$consultaDB->execute();
$resultado = $consultaDB->get_result();
$newdata="";
// Condicional para tratar a los resultados encontrados
if ($resultado->num_rows > 0) {
	while($reg = $resultado->fetch_assoc()) {
		$fec=$reg['fecha'];
            $date = date_create($fec);
            $fecha=date_format($date, 'd-m-Y');
            $newdata= $newdata."<tr class='datos'>
    		    
                  <td scope='col'>$reg[codigo]</td>                  
                  <td scope='col'>$reg[nombre_producto]</td>
                  <td scope='col'>$$reg[precio]</td>
                  <td scope='col'>$reg[cantidad]</td>  
                  <td><a href='comprar.php?id=$reg[id_producto]'>comprar</td>
                  </tr>";




	//$ResultadoPais[] = $registros["nombre_producto"];
	}
	//echo json_encode($ResultadoPais);
	/*echo'<script type="text/javascript">
    alert('.$newdata.');
    window.location.href="index.php";
    </script>';*/
	echo $newdata;
	}
// Cerramos la conexión con el servidor
$consultaDB->close();
?>
