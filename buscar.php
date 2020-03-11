<?php

//Recogemos la cadena
$busqueda=$_POST['cadena'];
include("conexion/conect.php");
//Aquí hacer la consulta para la busqueda con LIKE $busqueda
$query = "SELECT * FROM producto WHERE nombre_producto LIKE '%".$busqueda."%'";
$consulta = mysql_query($query);
$reg=$consulta->fetch_assoc()
        //GetSQLValueString("%" . $busqueda . "%", "text")); //Función GetSQLValueString al fina del tema

//Esto se pega en la div #mostrar
//echo 'Demo'.$reg;
echo "$reg"; //Mostrar los resultados aquí

?>
