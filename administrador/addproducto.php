<?php
include("../conexion/conect.php");
if(isset($_POST["enviar"])){
  $codigo = $_POST['codigo'];
  $categoria = $_POST['categoria'];
  $proveedor = $_POST['proveedor'];
  $nombre = $_POST['nombre'];
  $cantidad = $_POST['cantidad'];
  $precio = $_POST['precio'];
  $iva = $_POST['iva'];
  if ($iva == "iva") {
    $precioiva = $precio * 1.13;
  }
  else {
    $precioiva = "0";
  }
$sql=" INSERT INTO productos (codigo, id_categorias, id_proveedor, nombre_producto, cantidad, precio, precioiva)
VALUES('$codigo','$categoria','$proveedor','$nombre','$cantidad','$precio','$precioiva')";
$mysqli->query($sql);
echo "<script type='text/javascript'>alert('producto guardado con exito')</script>";
echo "<script>document.location.href='inicio.php?op=addproducto.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="../css/master.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title></title>
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
        <input type="text" required name="precio" class="form-control" id="precio">
      </div>
      <div class="form-group">
        <label for="iva">iva</label><br>
        <input type="radio" name="iva" value="iva"> incluye iva<br>
        <input type="radio" name="iva" value="noiva"> no incluye iva<br>
      </div>
      <center><input type="submit" class="btn btn-primary" name="enviar" value="enviar datos"></center>

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
