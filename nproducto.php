<?php
include("conexion/conect.php");
$idproducto= $_GET["id"];
$sql="SELECT * from productos WHERE id_producto = $idproducto";
$sentencia=$mysqli->query($sql);
$reg=$sentencia->fetch_assoc();
$precio = "$reg[precio]";
if(isset($_POST["enviar"])){
$nprecio = $_POST['nprecio'];
$precion = ($precio + $nprecio) / 2;
$sql=" INSERT INTO precioregulado (id_producto, precionormal, precionormalizado)
VALUES('$idproducto','$precio','$precion')";
$mysqli->query($sql);
echo "<script type='text/javascript'>alert('precio regulado con exito')</script>";
echo "<script>document.location.href='inicio.php?op=verproductos.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <br><br><br>
    <div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
      <div class="border-dark card bg-light shadow p-3 rounded">
    <div class="card-header bg-dark text-light">regular precio <?php
    echo "$reg[nombre_producto]<br><label class='text-light'><h3>El precio del producto existente es de: $$precio</h3></label>";
     ?>
   </div>
   <div class="card-body">
    <table>
      <form method="post" autocomplete="off">
      <div class="form-group">
        <label for="nombre">nuevo precio</label>
        <input name="nprecio"  type="text" class="form-control" value="">
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
  </body>
</html>
