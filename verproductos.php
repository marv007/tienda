<?php
include("conexion/conect.php");
$sql2="SELECT * FROM productos
INNER JOIN proveedor ON proveedor.id_proveedor = productos.id_proveedor
INNER JOIN categorias ON categorias.id_categorias = productos.id_categorias";
$sentencia2=$mysqli->query($sql2);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>sistema de inventario cadig</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/typeahead.js"></script>
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Sistema de inventario<small> CADIG</small></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=proveedores.php">proveedores</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=categorias.php">categorias</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          catalogo de productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="inicio.php?op=addproducto.php">Agregar productos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="verproductos.php">Ver productos</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=catalogo.php">ventas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inicio.php?op=clientes.php">clientes</a>
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
        <a class="nav-link" href="inicio.php?op=conexion/cerrar.php"><i class="fas fa-power-off">salir</i></a>
      </li>
    </ul>
  </div>
</nav>
    <div id="mostrar"></div>
    <br><br>
    <center>
    <h1>Inventario de productos</h1>
       <input type="text" class="form-control col-md-6" placeholder="buscar producto" id="buscar" name="buscar" onclick="filtrar()" onchange="filtrar()" onkeyup="filtrar()">
        <br><br>
    </form>
    <div class="table-responsive" id="all">
      <form class="" method="post">
        <table class="table bg-light" id="bod">

          <tr>
    				<th scope="col">fecha</th>
            <th scope="col">codigo</th>
            <th scope="col">proveedor</th>
            <th scope="col">categoria</th>
            <th scope="col">nombre producto</th>
            <th scope="col">cantidad</th>
            <th scope="col">precio</th>
            <th scope="col">precio con iva</th>
    				<th scope="col">precio de venta</th>
            <th scope="col">más opciones</th>
          </tr>

          <?php
          while($reg=$sentencia2->fetch_assoc()){
    				$fec=$reg['fecha'];
            $date = date_create($fec);
            $fecha=date_format($date, 'd-m-Y');
            echo "<tr class='datos'>
    							<td scope='col'>$fecha</td>
                  <td scope='col'>$reg[codigo]</td>
                  <td scope='col'>$reg[nombre_proveedor]</td>
                  <td scope='col'>$reg[nombre_categoria]</td>
                  <td scope='col'>$reg[nombre_producto]</td>
                  <td scope='col'>$reg[cantidad]</td>
                  <td scope='col'>$$reg[precio]</td>
                  <td scope='col'>$$reg[precioiva]</td>
    							<td scope='col'>$$reg[precioventa]</td>
                  <td scope='col'>
                  <a class='text-success' href='inicio.php?op=editarprod.php&id=$reg[id_producto]'><i class='fas fa-pen'></i> Editar Producto</a>
                  </td>
                  </tr>";
          }
          ?>
      </table>
      </form>

    </div>
    </center>
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
  <script>
  var bus;
      $(document).ready(function () {
          $('#buscar').typeahead({
              source: function (busqueda, resultado) {
                  $.ajax({
                      url: "search_ajax.php",
  					data: 'busqueda=' + busqueda,
            
                      dataType: "json",
                      type: "POST",
                      success: function (data) {
  						resultado($.map(data, function (item) {
  							return item;
                          }));
                      }
                  });
              }
          });
      
          
      });
      function filtrar(){
                var prod = $("#buscar").val();
             	
               $("tr").remove(".datos");
               
               
               $.ajax({
                url:"search_prod.php",
                method:"POST",                
                data: 'busqueda=' + prod,
                success:function(data){
                  
                  jQuery("table#bod").append(jQuery(data));
                  
                }
                });
              }

  </script>
</html>
