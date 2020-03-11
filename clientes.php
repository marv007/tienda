<?php
include("conexion/conect.php");
if(isset($_POST["enviar"])){
  $estado = $_POST['estado'];
  $nombre = $_POST['nombre'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST['telefono'];
  $dui = $_POST['dui'];
  $nrc = $_POST['nrc'];
  $nit = $_POST['nit'];
$sql=" INSERT INTO clientesiva (nrc,dui, nit, nombre_cliente, direccion, telefono, estado)
VALUES('$nrc','$dui','$nit','$nombre','$direccion','$telefono','$estado')";
//$mysqli->query($sql);
//echo "<script type='text/javascript'>alert('cliente guardado con exito')</script>";
//echo "<script>document.location.href='inicio.php?op=clientes.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body> <br><br>
    <div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
      <div class="border-dark card bg-light shadow p-3 rounded">
  <div class="card-header bg-dark text-light">agregar cliente</div>
  <div class="card-body">
    <table>
      <form method="post" autocomplete="off">
      <div class="form-group">
        <label for="cantidad">tipo de cliente</label>
        <SELECT class="form-control" name="estado" onchange="
        if(this.value=='1')
        {
          document.getElementById('nrc').disabled = false,
          document.getElementById('nit').disabled = false
        }
        else {
          document.getElementById('nrc').disabled = true
          document.getElementById('nit').disabled = true
        }" >
        <OPTION selected>Ninguno</OPTION>
        <OPTION value="0">sin iva</OPTION>
        <OPTION value="1">iva</OPTION>
        </SELECT>
      </div>
      <div class="form-group">
        <label for="cantidad">nombre completo </label>
        <input class="form-control" type="text" id="nombre" name="nombre" size="12" >
      </div>
      <div class="form-group">
        <label for="cantidad">direccion</label>
        <input class="form-control" type="text" id="direccion" name="direccion" size="12" >
      </div>
      <div class="form-group">
        <label for="cantidad">telefono</label>
        <input class="form-control" type="text" id="telefono" name="telefono" size="12" >
      </div>
      <div class="form-group">
        <label for="dui">dui</label>
        <input class="form-control" type="text" id="dui" name="dui" size="12" >
      </div>
      <div class="form-group">
        <label for="nrc">nrc</label>
        <input class="form-control" type="text" id="nrc" name="nrc" size="12" value="0" disabled >
      </div>
      <div class="form-group">
        <label for="nit">nit</label>
        <input class="form-control" type="text" id="nit" name="nit" size="12" value="0" disabled >
      </div>
      <center><input type="submit" class="btn btn-primary" name="enviar" value="enviar datos"></center>

  </form>
  <a href="verclientes.php" class="btn btn-link">ver catalogo de clientes --></a>
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
