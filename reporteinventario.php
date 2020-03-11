<?php
include("conexion/conect.php");
include('fpdf/fpdf.php');
//consulta para total de productos
setlocale(LC_TIME,"es_MX");


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('arial','',10);
$pdf->Image('img/logo.jpg',10,8,15,8,'jpg');
$pdf->cell(18,10,'',0);
$pdf->cell(125,10,utf8_decode('Reporte de cierre de año'),0);
$pdf->SetFont('arial','',9);
$pdf->cell(50,10,strftime("%A %d de %B del %Y"),'',0);
$pdf->ln('15');
$pdf->SetFont('arial','B',15);
$pdf->cell(60,8,'',0);
$pdf->cell(75,10,'Inventario de productos',0);
$pdf->ln('23');
$pdf->SetFont('arial','B',9);
$pdf->cell(15,8,'codigo',0);
$pdf->cell(25,8,'categoria',0);
$pdf->cell(50,8,'nombre de producto',0);
$pdf->cell(40,8,'cantidad',0);
$pdf->cell(25,8,'precio',0);
$pdf->cell(25,8,'precio con iva',0);
$pdf->ln('8');
$pdf->SetFont('arial','',8);
//consulta
$sql2="SELECT * FROM productos
INNER JOIN proveedor ON proveedor.id_proveedor = productos.id_proveedor
INNER JOIN categorias ON categorias.id_categorias = productos.id_categorias";
$sentencia2=$mysqli->query($sql2);
while($reg=$sentencia2->fetch_assoc()){
	$pdf->cell(15,8,$reg['codigo'],0);
  $pdf->cell(25,8,$reg['nombre_categoria'],0);
	$pdf->cell(50,8,$reg['nombre_producto'],0);
	$pdf->cell(40,8,$reg['cantidad'],0);
	$pdf->cell(25,8,'$'.$reg['precio'],0);
	$pdf->cell(25,8,'$'.$reg['precioiva'],0);
	$pdf->ln('8');
  }
  $pdf->ln('8');
  $consulta="SELECT SUM(cantidad) as conteo FROM productos";
  $resultado=$mysqli -> query($consulta);
  $fila=$resultado-> fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
  $conteo= $fila['conteo'];
  $pdf->cell(130,8,'los productos totales en inventario son:',0);
  $pdf->cell(25,8,$fila['conteo'].' productos',0);
  $pdf->ln('8');
  // consulta para total de precios
  $consulta="SELECT SUM(precio) as TotalPrecios FROM productos";
  $resultado=$mysqli -> query($consulta);
  $fila=$resultado-> fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
  $TotalPrecios= $fila['TotalPrecios'];
  $pdf->cell(130,8,'el total del inventario es de:',0);
  $pdf->cell(25,8,'$'.$totalp = $conteo * $TotalPrecios,0);
  $pdf->ln('8');
  $pdf->ln('8');
  //precios con iva
  $consulta="SELECT SUM(precioiva) as preciosiva FROM productos";
  $resultado=$mysqli -> query($consulta);
  $fila=$resultado-> fetch_assoc(); //que te devuelve un array asociativo con el nombre del campo
  $preciosiva= $fila['preciosiva'];
  $pdf->cell(130,8,'el total del inventario en precios con iva es de:',0);
  $pdf->cell(25,8,'$'.$totalpiva= $conteo * $preciosiva,0);
  $pdf->ln('8');


$pdf->Output();
?>
