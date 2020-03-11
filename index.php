<?php
include("conexion/conect.php");
session_start();
if(isset($_POST["inicio"])) {
  $nombre= $_POST["user"];
  $contra= $_POST["pass"];
  $sql="SELECT * FROM usuarios WHERE usuario = '$nombre' and pass = '$contra' and estado ='1'";
  $sentencia=$mysqli->query($sql);
  $rows = $sentencia->num_rows;
  $row = $sentencia->fetch_assoc();
  if($rows > 0) {
        $_SESSION["nombre"] = $nombre;
        header('location: inicio.php');
  			} else {
          echo "<div class='alert alert-danger' role='alert'>
          Usted no es un usuario registrado en la pagina
          </div>";
  		}
  	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title></title>
  </head>
  <body class="bg-light">
    <br><br><br><br><br><br>
    <div class="row">
      <div class="col-md-3">

      </div>
      <div class="col-md-6">
        <center>
        <div class=" card shadow p-3 mb-5 bg-light rounded border-success text-dark" style="width: 100%;">
          <img src="img/logo.jpg" class="img-fluid text-center" width="150px" height="100px" alt="">
          <h3>inicio de sesion</h3>
        <div class="">
          <table class="card-body">
            <tr>
              <td>
                <form method="post" autocomplete="off">
                <div class="form-group">
                  <label for="nombre" class="text-info">nombre</label>
                  <input type="text" name="user" class="form-control border-info bg-light text-info" id="nombre">
                <div class="form-group">
                  <label for="pass" class="text-info">contraseña</label>
                  <input type="password" name="pass" class="form-control border-info bg-light text-info" id="pass">
                </div>
                <input class="btn btn-outline-success rounded" type="submit" name="inicio" value="inicio de sesion">
              </form>
              </td>
            </tr>
          </table>
        </div>
        </div>
      </center>
      </div>
      <div class="col-md-3">

      </div>

    </div>

  </body>
</html>
