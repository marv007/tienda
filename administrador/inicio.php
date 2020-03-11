<?php
 session_start();
 $admin = $_SESSION["nombre"];
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Sistema de inventario cadig</title>
  </head>
  <body class="bg-info">
    <!--barra menu-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Sistema de inventario<small> CADIG</small></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          catalogo de productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="inicio.php?op=proveedores.php">proveedores</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="inicio.php?op=categorias.php">categorias</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="inicio.php?op=addproducto.php">Agregar productos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="inicio.php?op=verproductos.php">Ver productos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventario
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="inicio.php?op=addinventario.php">Crear inventario</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="inicio.php?op=reporteventas.php">Reportes de ventas</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=ver_compras.php">ventas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=usuarios.php">usuarios</a>
      </li>
      <li class="nav-item">
        <?php
        setlocale(LC_TIME,"es_MX");
        echo strftime("%A %d de %B del %Y");
        //echo strftime("Hoy es %A y son las %H:%M");
        //echo strftime("El año es %Y y el mes es %B");
         ?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=../conexion/cerrar.php"><i class="fas fa-power-off"></i></a>
      </li>
    </ul>
  </div>
</nav>
<a href="#"></a>
<!--barra menu-->
<div class="">

  <?php
        if(isset($_GET["op"])){
            include($_GET["op"]);
        }else{
            echo"
            <center>
            <p><h2>Bienvenido a sistema de inventario $admin </h2><br><br>
            <table>
              <tr>
                <td width='100%' height='300px' ></td>
              </tr>
            </table>
            </center>
            ";
        }
    ?>
    <br><br><br>
</div>
<footer class="page-footer font-small unique-color-dark text-light"  style="background-color:  #000000; height:200px; color: #ffffff;">
  <div style="background-color:  #EAB543; height:5px;">
  <div class="container">
          <div class="row py-4 d-flex align-items-center">
          </div>
        </div>
      </div>
      <div style="background-color: #182C61; height:10px;">
        <div class="container">
          <div class="row py-4 d-flex align-items-center">
          </div>
        </div>
      </div>
      <div class="container text-center text-md-left mt-5 " style="background-color: #7f8c8d; color: #000000;">
        <div class="row mt-3">
        </div>
      </div>
      <div class="footer-copyright py-3 text-center">© 2019 Copyright:
        <a class="text-light" href="#!">Cadig</a>
      </div>
    </footer>
</body>

  <script src="../js/jquery.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.js"></script>

</html>
