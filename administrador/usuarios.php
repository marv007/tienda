<?php
include("../conexion/conect.php");
if(isset($_GET["est"])){
  $id_promo=$_GET["id"];
  $estado = $_GET["est"];
  if( $estado == 0 ){
    $estado = 1;
  }else {
    $estado = 0;
  }
  $editar=" Update usuarios Set
  estado ='$estado'
  Where id_usuario='$id_promo'";
  $mysqli->query($editar);
}
$sql="SELECT * FROM usuarios";
$sentencia=$mysqli->query($sql);
if(isset($_POST["guardarusuario"])){
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$pas = $_POST['pas'];
$estado = '0';
$sql="INSERT INTO usuarios (nombre, usuario, pass, estado)
VALUES('$nombre','$usuario','$pas','$estado')";
$mysqli->query($sql);
echo "<script type='text/javascript'>alert('usuario guardado con exito')</script>";
echo "<script>document.location.href='inicio.php?op=usuarios.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/master.css">
  </head>
  <body>
    <br><br><br>
    <div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
      <div class="border-dark card bg-light shadow p-3 rounded">
  <div class="card-header bg-dark text-light"><i class="fas fa-plus"> agregar usuario</i></div>
  <div class="card-body">
    <table>
      <form autocomplete="off" method="post">
      <div class="form-group">
        <label for="codigo">Nombre completo</label>
        <input type="text" required name="nombre" class="form-control" id="codigo">
      </div>
      <div class="form-group">
        <label for="nombre">usuario</label>
        <input type="text" required name="usuario" class="form-control" id="nombre">
      </div>
      <div class="form-group">
        <label for="direccion">contraseña</label>
        <input type="password" required name="pas" class="form-control" id="direccion">
      </div>
      <center>
        <input type="submit" class="btn btn-info" name="guardarusuario" value="enviar datos"></input></center>

  </form>
    </table>
  </div>

    </div>
      </div>
    <div class="col-md-3">

    </div>
  </div>
  <br><br>
  <div class="table-responsive bg-light">
    <form  method="post">
      <table class="table">

        <tr class="bg-dark text-light">
          <th></th>
          <th scope="col">nombre completo</th>
          <th scope="col">usuario</th>
          <th scope="col">contraseña</th>
          <th scope="col">Opciones</th>

        </tr>
        <?php
        while($reg=$sentencia->fetch_assoc()){
          $estado = "";
          $letrasestado = "";
          if ($reg["estado"] == 1) {
            $estado = "btn btn-link";
            $letrasestado = "activo";
          }else{
            $estado = "btn btn-link";
            $letrasestado = "no activo";
          }
          echo "<tr>
                <td scope='col'><input type='checkbox' name='check_borrarcat[]' value='$reg[id_usuario]' id='customCheck1'></td>
                <td scope='col'>$reg[nombre]</td>
                <td scope='col'>$reg[usuario]</td>
                <td scope='col'>$reg[pass]</td>
                <td scope='col'><a class='text-success' href='#'><i class='fas fa-edit'>reestablecer contraseña </i></a> | <a class='$estado' href='inicio.php?op=usuarios.php&id=$reg[id_usuario]&est=$reg[estado]'><i class='fas fa-check'>$letrasestado</i></td>
                </tr>";
        }

        if(isset($_POST["borrar"])){
          foreach($_POST["check_borrarcat"] as $cod_borrar)
          {
            $sql_borrar ="delete from usuarios where id_usuario = $cod_borrar";
            $sentenciaborrar=$mysqli->query($sql_borrar);
          }
          echo "<script> document.location.href='inicio.php?op=usuarios.php'</script>";
        }

        ?>
        <tr class="">
          <th class="text-center" colspan="9"> <input  type="submit" class="btn btn-dark" value='borrar proveedor' name="borrar"></th>
        </tr>
    </table>
    </form>

  </div>

  </body>
</html>
