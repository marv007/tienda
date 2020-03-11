<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
	<br><br><br>

<table class="table bg-light" align="center">
<body><form action="catalogo.php" method="post" name="f1">
	<tr>
	<th colspan="3" class="text-center"><h1>ventas de productos</h1></th>
	</tr>
	<tr>
	<td>ventas</td>
	<td>Fecha</td>
	<td>detalles</td>
	</tr>
<?php

//actualizar a php5
$mysqli = new mysqli("localhost","root","","cadig");
$sql="SELECT * FROM venta order by fecha";
$sentencia=$mysqli->query($sql);
  while($reg=$sentencia->fetch_assoc()){
		$fec=$reg['fecha'];
		$date = date_create($fec);
		$fecha=date_format($date, 'd-m-Y');
	echo"<tr>
	<td>$reg[id_venta]</td>
	<td>$fecha</a></td>
	<td><a href='detalle_compra.php?id=$reg[id_venta]'>detallar compra</td
	</tr>";
}
?>
</table>
</body>
</html>
