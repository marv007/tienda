<?php
include("conexion/conect.php");
include('fpdf/fpdf.php');
//consulta para total de productos
setlocale(LC_TIME,"es_MX");
$pdf = new FPDF('P', 'mm', array(215.9,279.4));
$pdf->AddPage();
$pdf->SetFont('arial','B',10);
$pdf->cell(125,10,strftime("%A %d de %B del %Y"),'',0);
$pdf->ln('5');
$pdf->cell(130,10,utf8_decode('Señores'),0);
//comienza direccion
$pdf->SetFont('arial','',7);
$pdf->cell(25,10,utf8_decode('Av. independecia sur callejon pte. a'),0);
//siguente linea de direccion
$pdf->ln('3');
$pdf->cell(130,10,strftime(""),'',0);
$pdf->cell(25,10,utf8_decode('Iglesia el Carmen, Santa Ana'),0);
//siguente linea de direccion
$pdf->ln('3');
$pdf->cell(130,10,strftime(""),'',0);
$pdf->SetTextColor(0,0,255);
$pdf->cell(25,10,utf8_decode('Email: cadigsadesv@yahoo.com'),0);
//siguente linea de direccion
$pdf->ln('3');
$pdf->cell(130,10,strftime(""),'',0);
$pdf->cell(25,10,utf8_decode('         cadigsadesv@hotmail.com'),0);
$pdf->Image('img/logo.jpg',145,32,30,10,'jpg');
$pdf->ln('10');
$pdf->SetFont('arial','',12);
$pdf->SetTextColor(0,0,0);

$pdf->ln('5');
$pdf->SetFont('arial','B',10);
$pdf->cell(60,8,utf8_decode('Estimados Señores'),0);
$pdf->ln('5');
$pdf->SetFont('arial','',9);
$pdf->cell(60,8,'CADIG S.A DE C.V: pone a dispocisionla oferta segun',0);
$pdf->ln('5');
$pdf->SetFont('arial','',9);
$pdf->cell(60,8,'el siguiente detalle:',0);
$pdf->ln('15');
$pdf->SetFont('arial','B',9);


    $pdf->ln('8');
$pdf->cell(5,8,'',1);
$pdf->cell(120,8,'nombre de producto',1);
$pdf->cell(25,8,'precio uni',1);
$pdf->cell(25,8,'total',1);
$pdf->ln('8');
$pdf->SetFont('arial','',8);


@session_start();
//2014-05-13
$fecha=date("Y-m-d");
$total=0;
//ver los datos
@session_start();
  if(isset($_SESSION['datos'])){

  foreach($_SESSION['datos'] as $ver){
    $pdf->cell(5,8,$ver['cantidad_fact'],1);
    $pdf->SetTextColor(0,5,255);
    $pdf->cell(120,8,$ver['nombre'],1);
    $pdf->SetTextColor(0,0,0);
    $pdf->cell(25,8,'$'.$ver['precio'],1);
    $pdf->cell(25,8,'$'.$ver["cantidad_fact"]*$ver["precio"],1);
	  $total+=($ver["cantidad_fact"]*$ver["precio"]);
    $pdf->ln('8');
  }
  $pdf->ln('50');
$pdf->cell(150,8,'total:',1);
$pdf->cell(25,8,'$'.$total,1);
  $sesion=$_SESSION['datos'];
  }
//consulta
$pdf->ln('8');
$pdf->cell(175,8,'"Las Existencias son  a la fecha de cotizacionestan sujetas a cambios"',1);
// forma de pago
$pdf->ln('8');
$pdf->SetFont('arial','',10);
$pdf->cell(5,10,'',0);
$pdf->cell(175,8,'FORMA DE PAGO: contado',0);
// forma de pago
$pdf->ln('8');
$pdf->SetFont('arial','B',8);
$pdf->cell(5,10,'todos nuestros productos incluyen iva',0);
$pdf->ln('8');
$pdf->SetFont('arial','',10);
$pdf->cell(175,8,'VALIDEZ DE LA OFERTA:               5 dias mientras duren existencias',0);
$pdf->ln('15');
// ENCARGADO
$pdf->SetFont('arial','B',7);
$pdf->cell(5,10,'atte.',0);
$pdf->ln('5');
$pdf->cell(5,10,'Ing. Elvis Carolina Calderon.',0);
$pdf->ln('5');
$pdf->cell(5,10,'CADIG. S.A DE C.V',0);
$pdf->ln('5');
$pdf->cell(5,10,'TEL: 2441-5402',0);
$pdf->ln('5');
$pdf->SetFont('arial','',10);
$pdf->cell(5,10,'Emitir cheque a nombre de: CADIG S.A DE C.V',0);
$pdf->Output();
?>
