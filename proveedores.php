<?php
include("conexion/conect.php");
$sql="SELECT * FROM proveedor";
$sentencia=$mysqli->query($sql);
if(isset($_POST["guardarproveedor"])){
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$departamento = $_POST['departamento'];
$nit = $_POST['nit'];
$nrc = $_POST['nrc'];
$telefono = $_POST['telefono'];
$sql="INSERT INTO proveedor (codigo, nombre_proveedor, direccion, departamento, nit, nrc, telefono)
VALUES('$codigo','$nombre','$direccion','$departamento','$nit','$nrc','$telefono')";
$mysqli->query($sql);
echo "<script type='text/javascript'>alert('proveedor guardado con exito')</script>";
echo "<script>document.location.href='inicio.php?op=proveedores.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/master.css">
  </head>
  <body>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Por favor</strong> Ingresar el nit y el nrc sin guiones
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    <br><br><br>
    <div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
      <div class="border-dark card bg-light shadow p-3 rounded">
  <div class="card-header bg-dark text-light"><i class="fas fa-plus"> agregar Proveedores</i></div>
  <div class="card-body">
    <table>
      <form autocomplete="off" method="post">
      <div class="form-group">
        <label for="codigo">codigo proveedor</label>
        <input type="text" required name="codigo" class="form-control" id="codigo">
      </div>
      <div class="form-group">
        <label for="nombre">Nombre proveedor</label>
        <input type="text" required name="nombre" class="form-control" id="nombre">
      </div>
      <div class="form-group">
        <label for="direccion">Direccion</label>
        <input type="text" required name="direccion" class="form-control" id="direccion">
      </div>
      <div class="form-group">
        <label for="seccion">Elija la departamento</label>
        <select class="form-control"  required name="departamento">
        <option value='0'>seleccione el departamento</option>
        <option value='Santa Ana'>Santa Ana</option>
        <option value='Ahuachapan'>Ahuachapan</option>
        <option value='Sonsonate'>Sonsonate</option>
        <option value='Chalatenango'>Chalatenango</option>
        <option value='Cuscatlan'>Cuscatlan</option>
        <option value='San salvador'>San salvador</option>
        <option value='La libertad'>La libertad</option>
        <option value='Sam Vicente'>Sam Vicente</option>
        <option value='Morazan'>Morazan</option>
        <option value='Cabañas'>Cabañas</option>
        <option value='Morazan'>Morazan</option>
        <option value='San Miguel'>San Miguel</option>
        <option value='Usulutan'>Usulutan</option>
        <option value='La union'>La union</option>

        </select>
      </div>
      <div class="form-group">
        <label for="telefono">n° de nit</label>
        <input type="text" required name="nit" class="form-control" id="telefono">
      </div>
      <div class="form-group">
        <label for="telefono">nrc</label>
        <input type="text" required name="nrc" class="form-control" id="telefono">
      </div>
      <div class="form-group">
        <label for="telefono">Telefono</label>
        <input type="text" required name="telefono" class="form-control" id="telefono">
      </div>
      <center>
        <input type="submit" class="btn btn-info" name="guardarproveedor" value="enviar datos"></input></center>

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
          <th scope="col">Codigo</th>
          <th scope="col">Nombre de proveedor</th>
          <th scope="col">Direccion</th>
          <th scope="col">Departamento</th>
          <th scope="col">nit</th>
          <th scope="col">nrc</th>
          <th scope="col">Telefono</th>
          <th scope="col">Opciones</th>
        </tr>
        <?php
        while($reg=$sentencia->fetch_assoc()){
          echo "<tr>
                <td scope='col'><input type='checkbox' class='form-control' name='check_borrarcat[]' value='$reg[id_proveedor]' class='form-control' id='customCheck1'></td>
                <td scope='col'>$reg[codigo]</td>
                <td scope='col'>$reg[nombre_proveedor]</td>
                <td scope='col'>$reg[direccion]</td>
                <td scope='col'>$reg[departamento]</td>
                <td scope='col'>$reg[nit]</td>
                <td scope='col'>$reg[nrc]</td>
                <td scope='col'>$reg[telefono]</td>
                <td scope='col'><a class='text-success' href='#'><i class='fas fa-edit'>editar</i></a></td>
                </tr>";
        }
        ?>
    </table>
    </form>

  </div>

  </body>
</html>
