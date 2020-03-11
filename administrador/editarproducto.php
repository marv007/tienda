<?php
include("conexion/conect.php");
$idalumno= $_GET["id"]; ?>
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
      <div class="border-danger card bg-light shadow p-3 rounded">
    <div class="card-header bg-danger text-light">editar alumnos</div>
    <div class="card-body">
    <table>
      <form method="post" autocomplete="off">
      <div class="form-group">
        <label for="seccion">elija la seccion del alumno</label>
        <select class="form-control"  name="seccion">
          <?php
          $sql="SELECT * FROM grados Where id_grado = '$idalumno'";
          $sentencia=$mysqli->query($sql);
          
          echo "<option value='0'>seleccione un grado</option>";
            while($reg=$sentencia->fetch_assoc()){
          echo"<option value='$reg[id_grado]'>$reg[nombregrado]</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="nombre">agregar alumno</label>
        <input type="text" name="nombre" class="form-control" id="nombre">
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
