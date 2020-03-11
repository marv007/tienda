<?php
include("../conexion/conect.php");
$sql="SELECT * FROM categorias";
$sentencia=$mysqli->query($sql);
if(isset($_POST["guardarcat"])){
$categoria = $_POST['cat'];
$sql="INSERT INTO categorias (nombre_categoria)
VALUES('$categoria')";
$mysqli->query($sql);
echo "<div class='alert alert-success'>
  <strong><script type='text/javascript'>alert('categoria guardada con exito')</script></strong>
</div>";
echo "<script>document.location.href='inicio.php?op=categorias.php'</script>";
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
  <div class="card-header bg-dark text-light"><i class="fas fa-plus"> agregar categorias</i></div>
  <div class="card-body">
    <table>
      <form autocomplete="off" method="post">
      <div class="form-group">
        <label for="nombre">Nombre categoria</label>
        <input type="text" name="cat" class="form-control" id="nombre">
      </div>
      <center>
        <input type="submit" class="btn btn-info" name="guardarcat" value="enviar datos"></input></center>

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
          <th scope="col">#</th>
          <th scope="col">categoria</th>
          <th scope="col">Opciones</th>
        </tr>
        <?php
        while($reg=$sentencia->fetch_assoc()){
          echo "<tr>
                <td scope='col'><input type='checkbox' name='check_borrarcat[]' value='$reg[id_categorias]' id='customCheck1'></td>
                <td scope='col'>$reg[id_categorias]</td>
                <td scope='col'>$reg[nombre_categoria]</td>
                <td scope='col'><a class='text-success' href='#'><i class='fas fa-edit'>editar categoria</i></a></td>
                </tr>";
        }

        if(isset($_POST["borrar"])){
          foreach($_POST["check_borrarcat"] as $cod_borrar)
          {
            $sql_borrar ="delete from categorias where id_categorias = $cod_borrar";
            $sentenciaborrar=$mysqli->query($sql_borrar);
          }
          echo "<script> document.location.href='inicio.php?op=categorias.php'</script>";
        }

        ?>
        <tr class="">
          <th class="text-center" colspan="4"><input type="submit" class=" btn btn-danger" value='borrar categoria' name="borrar"></th>
        </tr>
    </table>
    </form>

  </div>

  </body>
</html>
