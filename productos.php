<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>Sistema de inventario cadig</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
</head>

<body class="bg-info">
  <form action="productos.php" method="post" name="f1">




<?php
include("conexion/conect.php");
@session_start();
//2014-05-13
$fecha=date("Y-m-d");
$total=0;
//ver los datos
@session_start();
  if(isset($_SESSION['datos'])){
    $nombre="";
    $direccion="";
    $telefono="";
    $nrc="";
    if(isset($_SESSION['nrc'])){
      $nombre=$_SESSION['nombrec'];
      $direccion=$_SESSION['direccion'];
      $telefono=$_SESSION['telefono'];
      $nrc=$_SESSION['nrc'];
    }
    

    if(isset($_POST['nrc'])){
      if($_POST['nrc']!=""){
        $nrc=$_POST['nrc'];
        $sql="SELECT * FROM clientes WHERE nrc=".$nrc;
      
        $sentencia=$mysqli->query($sql);
        $reg=$sentencia->fetch_assoc();

        $nombre=$reg['nombre_cliente'];
        $direccion=$reg['direccion'];
        $telefono=$reg['telefono'];

        $_SESSION['nombrec']=$nombre;
        $_SESSION['direccion']=$direccion;
        $_SESSION['telefono']=$telefono;
        $_SESSION['nrc']=$nrc;
        $_SESSION['nit']=$reg['nit'];
      }
    }

     
 ?>    <br><br>
      <table class="table bg-light" align=center>
        <tr>
          <td colspan="6">Tipo de cliente:<br>
          <input type="radio" id="coniva" name="tipocliente" value="coniva" checked onclick="checkIva()">
          <label for="coniva">Con IVA</label>
          <input type="radio" id="siniva" name="tipocliente" value="siniva" onclick="checkNoIva()">
          <label for="siniva">Sin IVA</label>
          </td>
          
          <td colspan="1" id="tdnrc">Número de registro(NRC): <input type='text' id="nrc" class='form-control' name='nrc' value=<?php echo $nrc; ?>></td>
        </form>
        <form name="frm" method="post">
        </tr>
        <tr>
          <td colspan="5">Nombre: <input type='text' readonly class='form-control' id="ncliente" name='nombre' value="<?php echo $nombre; ?>"></td>
          <td colspan="2">Dirección: <input type='text' readonly class='form-control' id="dcliente" name='direcion' value="<?php echo $direccion; ?>"></td>
          <td colspan="2">Teléfono: <input type='text' readonly class='form-control' id="tcliente" name='tel' value="<?php echo $telefono; ?>"></td>
        </tr>
    <tr class="header" align="center">
    <td align=center>X</td>
    <td>Fecha</td>
    <td>Codigo</td>
    <td align="center">Cantidad a facturar</td>
    <td>Nombre</td>
    <td align="center">Precio normal</td>
    <td align="center">descuento aplicado </td>
    <td align="center">precio con descuento</td>
    <td>Total</td>
    </tr>

 <?php
$p = "";
$pp = "";
$ppp = "";
 

  foreach($_SESSION['datos'] as $ver){
    echo"
    <tr>
  <td><input type='checkbox' name='eli[]' value='$ver[identificador]' /></td>
	<td>$ver[fecha]</td>
  <td>$ver[codigo]</td>
	<td>$ver[cantidad_fact]</td>
	<td>$ver[nombre]</td>
  <td>$ $ver[precio]</td>
  <td>$ver[descuento]%</td>
  <td>$ $ver[pdes]</td>

	<td>$".($ver["cantidad_fact"]*$ver["pdes"])."</td>
    </tr>
    ";
	$total+=($ver["cantidad_fact"]*$ver["pdes"]);
  $piva = $total * 13/100;
  $pconiva = $total + $piva;
  $p = round($total, 2);
  $pp = round($piva, 2);
  $ppp = round($pconiva, 2);
  }
  echo"
  <tr>
<td align=right colspan=9><h4>Total: $$p</h4>
</td>
</tr>
<tr>
<td align=right class='text-warning' colspan=9><h4>IVA: $$pp</h4>
</td>
</tr>
<tr>
<td align=right class='text-success' colspan=9><h4> Total a cancelar: $$ppp</h4>
</td>
</tr>
  <tr>
<td align=center colspan=9><input type=submit class='btn btn-danger' name=bo value=Eliminar />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=submit class='btn btn-success' name=buy value=Comprar />
<a href='cotizacion.php' target='_blank' class='btn btn-warning'>imprimir cotizacion</a>
<a href='inicio.php?op=catalogo.php' class='btn btn-link'>ir al catalogo</a>
</td>
</tr>";
  $sesion=$_SESSION['datos'];
  }

  if(isset($_POST["bo"])){
    if($_POST["bo"]=="Eliminar"){
	  foreach($_POST["eli"] as $codigo){
		   unset($sesion[$codigo]);
 $_SESSION['datos']=$sesion;
 echo"<script language=javascript>document.location='productos.php'</script>";
		  }


    }
  }
if(isset($_POST["buy"])){

//venta php 5
  $mysqli = new mysqli("localhost","root","","cadig");
	foreach($_SESSION['datos'] as $ver){
	$guardar="INSERT INTO venta (fecha,codigo,nombre,cantidad,preciou,total)
  VALUES('$ver[fecha]','$ver[codigo]','$ver[nombre]','$ver[cantidad_fact]','$ver[precio]','$ppp')"
  or die(mysql_error());
  $mysqli->query($guardar);
  
  $update="UPDATE productos SET cantidad=cantidad-$ver[cantidad_fact] WHERE codigo=$ver[codigo]";
  $mysqli->query($update);
}

echo"<script language=javascript>
$(document).ready(function(){
  $('#modalimp').modal('show');
});
</script>"; 
//echo"<script language=javascript>document.location='inicio.php?op=catalogo.php'</script>";
	}

?>
<script>
function checkNoIva(){  
  $("#tdnrc").hide();
  document.getElementById("ncliente").removeAttribute("readonly");
  document.getElementById("dcliente").removeAttribute("readonly");
  document.getElementById("tcliente").removeAttribute("readonly");
}

function checkIva(){
  $("#tdnrc").show();
  document.getElementById("ncliente").setAttribute("readonly", "");
  document.getElementById("dcliente").setAttribute("readonly", "");
  document.getElementById("tcliente").setAttribute("readonly", "");
}
/*
// Get the input field
var input = document.getElementById("nrc");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    //event.preventDefault();
    // Trigger the button element with a click
    //document.getElementById("nrc").click();
    document.location='?nrc=true';


  }
}); */
</script>
<!-- Modal -->
<div class="modal fade" id="modalimp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">¿Imprimir?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>¿Desea Imprimir esta compra?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="modalSi()" data-dismiss="modal">Imprimir</button>
        <button type="button" class="btn btn-secondary" onclick="modalNo()" data-dismiss="modal">Guardar sin imprimir</button>
        
      </div>
    </div>
  </div>
</div>

<script>
function modalSi(){
  $('#modalImp').modal('hide');
  window.open('imp_factura.php', '_blank');
  document.location='inicio.php?op=catalogo.php';

}

function modalNo(){
  $('#modalImp').modal('hide');
}
</script>
</body>
</html>
