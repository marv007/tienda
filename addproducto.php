<?php
include("conexion/conect.php");
if(isset($_POST["enviar"])){
  $fecha = $_POST['fecha'];
  $codigo = $_POST['codigo'];
  $categoria = $_POST['categoria'];
  $proveedor = $_POST['proveedor'];
  $nombre = $_POST['nombre'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
  $iiva = $_POST['iiva'];
  $iva = $_POST['iva'];
  $pconiva = $_POST['pconiva'];
  $precioventa = $_POST['precioventa'];
  if ($iva == "iva") {
    $precion = $precioventa * 13/100;
    $preciveniva = $precion + $precioventa;
  }
  else {
    $preciveniva = "0";
  }
$sql=" INSERT INTO productos (fecha,codigo, id_categorias, id_proveedor, nombre_producto, cantidad, precio, iva, precioiva, precioventa, preciveniva)
VALUES('$fecha','$codigo','$categoria','$proveedor','$nombre','$cantidad','$precio','$iiva','$pconiva','$precioventa','$preciveniva')";
echo "INSERT INTO productos (fecha,codigo, id_categorias, id_proveedor, nombre_producto, cantidad, precio, iva, precioiva, precioventa, preciveniva)
VALUES('$fecha','$codigo','$categoria','$proveedor','$nombre','$cantidad','$precio','$iiva','$pconiva','$precioventa','$preciveniva')";
$mysqli->query($sql);
echo "<script type='text/javascript'>alert('producto guardado con exito')</script>";
echo "<script>document.location.href='inicio.php?op=addproducto.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="css/master.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title></title>

<script type="text/javascript">
function priva(){

var n1 = document.getElementById('precio').value;
var piva = parseFloat(n1)*13/100;
var prconiva = parseFloat(piva) + parseFloat(n1);
document.getElementById("iva").value = parseFloat(piva);
document.getElementById("resultado").value = parseFloat(prconiva);
}
</script>

  </head>
  <body>
    <br><br><br>
    <div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
      <div class="border-dark card bg-light shadow p-3 rounded">
  <div class="card-header bg-dark text-light">agregar Productos</div>
  <div class="card-body">
    <table>
      <form method="post" autocomplete="off">
        <div class="form-group">
          <label for="nombre">Fecha</label>
          <input type="date" name="fecha" required class="form-control" id="fecha">
        </div>
        <div class="form-group">
          <label for="seccion">Elija la proveedor</label>
          <select class="form-control" name="proveedor">
            <?php
            $sql="SELECT * FROM proveedor";
            $sentencia=$mysqli->query($sql);
            echo "<option value='0'>seleccione el proveedor</option>";
              while($reg=$sentencia->fetch_assoc()){
            echo"<option value='$reg[id_proveedor]'>$reg[nombre_proveedor]</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="codigo">Codigo de producto</label>
          <input type="text" required  name="codigo" class="form-control" id="codigo">
        </div>
      <div class="form-group">
        <label for="seccion">Elija la categoria</label>
        <select class="form-control" name="categoria">
          <?php
          $sql="SELECT * FROM categorias";
          $sentencia=$mysqli->query($sql);
          echo "<option value='0'>seleccione una categoria</option>";
            while($reg=$sentencia->fetch_assoc()){
          echo"<option value='$reg[id_categorias]'>$reg[nombre_categoria]</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="nombre">Nombre producto</label>
        <input type="text" required name="nombre" class="form-control" id="nombre">
      </div>
      <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="text" required name="cantidad" class="form-control" id="cantidad">
      </div>
      <div class="form-group">
        <label for="precio">Precio</label>
        <input type="text" required name="precio" class="form-control"  id="precio">
      </div>

      <div class="form-group">
        <label for="precio" >iva</label>
        <input type="text" id="iva" required name="iiva" readonly class="form-control" >
      </div>
      <div class="form-group">
        <label for="precio" >Precio con iva</label>
        <input type="text" id="resultado" required name="pconiva" readonly class="form-control" >
      </div>
      <div class="form-group">
        <label for="precio">Precio de venta</label>
        <input type="text" required name="precioventa" class="form-control" id="precioventa">
      </div>
      <div class="form-group">
        <label for="iva">Precio de venta con iva</label><br>
        <input type="radio" name="iva" value="iva"> incluye iva<br>
        <input type="radio" name="iva" value="noiva"> no incluye iva<br>
      </div>
      <center>
        <input type="button" class="btn btn-warning" onclick="priva();" name="enviar" value="calcular precio">
        <input type="submit" class="btn btn-primary" name="enviar" value="enviar datos">
      </center>

  </form>
    </table>
  </div>

    </div>
      </div>
    <div class="col-md-3">

    </div>
  </div>
<br><br>
  </body>
</html>
