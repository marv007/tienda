<?php
//include("../conexion/conect.php");
include('fpdf/fpdf.php');

setlocale(LC_TIME,"es_ES"); 

$pdf = new FPDF();
@session_start();
if(isset($_SESSION["datos"])){
    $pdf->AddPage();
    $pdf->SetFont('arial','',11);
    $total=0;
    $pdf->Cell(150,40,'',0,1,'C');
    $pdf->Cell(25);
    $pdf->Cell(60,9,utf8_decode($_SESSION['nombrec']),0, 0);
    $pdf->Cell(50);
    $pdf->Cell(30,9,utf8_decode(strftime("%d/%m/%y")),0, 1);
    $pdf->Cell(25);
    $pdf->MultiCell(80,9,utf8_decode($_SESSION['direccion']),0, 1);
    $pdf->Cell(15,9,'',0,1,'C');  
    $pdf->Cell(135);
    $pdf->Cell(30,9,utf8_decode($_SESSION['nrc']),0, 1);
    $pdf->Cell(135);
    $pdf->Cell(30,9,utf8_decode($_SESSION['nit']),0, 1);
    $pdf->Cell(15,35,'',0,1,'C');
    $espacio=0; 
    foreach($_SESSION['datos'] as $ver){
        $espacio+=9;
        $pdf->cell(7,9,$ver['cantidad_fact'],0, 0, 'C');
        $pdf->cell(120,9,utf8_decode($ver['nombre']),0, 0); 
        $pdf->cell(25,9,$ver['precio'],0, 0);
        $pdf->cell(12,9,$ver['precio']*$ver['cantidad_fact'],0, 1);         
      //<td><input type='checkbox' name='eli[]' value='$ver[identificador]' /></td>
      
      
      //<td>$ver[descuento]%</td>
     // <td>$ $ver[pdes]</td>
    
        //td>$".($ver["cantidad_fact"]*$ver["pdes"])."</td>
        //</tr>
        
        $total+=($ver["cantidad_fact"]*$ver["pdes"]);
      $piva = $total * 13/100;
      $pconiva = $total + $piva;
      $p = round($total, 2);
      $pp = round($piva, 2);
      $ppp = round($pconiva, 2);
      }
      $espacio=70-$espacio;
      $pdf->Cell(15,$espacio,'',0,1);
      $pdf->Cell(152);
      $pdf->cell(25,7,$p,0, 1);
      $pdf->Cell(152);
      $pdf->cell(25,7,$pp,0, 1);
      $pdf->Cell(152);
      $pdf->cell(25,7,$ppp,0, 1);
      $pdf->Cell(15,20,'',0,1);
      $pdf->Cell(152);
      $pdf->SetFont('Arial','B',12);
      $pdf->cell(25,7,'$'.$ppp,0, 1);

}else{
    $pdf->AddPage();
    $pdf->SetFont('arial','',15);
    $pdf->cell(150,12,'No hay datos para mostrar :( ',0, 1); 
}


$pdf->Output();
$_SESSION['datos']="";

?>