<?php
include("conexion/conect.php");
$idproducto= $_GET["id"];
$sql="SELECT * from productos WHERE id_producto = $idproducto";
$sentencia=$mysqli->query($sql);
$reg=$sentencia->fetch_assoc();
$cantidad = "$reg[cantidad]";
$precio = "$reg[precioventa]";
if(isset($_POST["enviar"])){
$ncantidad = $_POST['ncantidad'];
$cantidadn = $cantidad + $ncantidad ;
$nprecio = $_POST['nprecio'];
$precion = ($precio + $nprecio) / 2;
$editar=" Update productos Set
cantidad ='$cantidadn',
precioventa ='$precion'
Where id_producto='$idproducto'";
$mysqli->query($editar);
echo "<script type='text/javascript'>alert('cantidad actualizada con exito')</script>";
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
    <div class="card-header bg-dark text-light">Editar producto: <?php
    echo "$reg[nombre_producto]<br><label class='text-danger'></label>";
     ?>
   </div>
   <div class="card-body">
    <table>
      <form method="post" autocomplete="off">
        <div class="form-group">
          <label for="nombre">Existencia de producto</label>
          <?php echo "<h4><label class='text-danger' for='nombre'>$reg[cantidad]</label></h4> "; ?>
        </div>
      <div class="form-group">
        <label for="nombre">nueva cantidad</label>
        <input name="ncantidad"  type="text" class="form-control">
      </div>
      <div class="form-group">
        <label for="nombre">Precio de producto</label>
        <?php echo "<h4><label class='text-danger' for='nombre'>$$reg[precioventa]</label></h4> "; ?>
      </div>
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
