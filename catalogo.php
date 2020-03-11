<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Documento sin título</title>
</head>

<body>
<br><br><center>
<input type="text"  class="form-control col-md-6" placeholder="buscar producto" id="buscar" name="buscar" onclick="filtrar()" onchange="filtrar()" onkeyup="filtrar()">
 </center>       
	<br><br>
<table class="table bg-light" id="bod" align="center">
<body><form action="catalogo.php" method="post" name="f1">
	<tr>
	<td>codigo</td>
	<td>nombre</td>
	<td>precio</td>
	<td>Existencia de producto</td>
	<td></td>
	</tr>
<?php

//actualizar a php5
$mysqli = new mysqli("localhost","root","","cadig");
$sql="SELECT * FROM productos";

$sentencia=$mysqli->query($sql);
      while($reg=$sentencia->fetch_assoc()){

        echo"<tr class='datos'>
				<td>$reg[codigo]</td>
				<td>$reg[nombre_producto]</td>
				<td>$$reg[precioventa]</td>
				<td>$reg[cantidad]</td>
				<td><a href='comprar.php?id=$reg[id_producto]'>comprar</td>
				</tr>";

      }
//fin actualizar a php5

/*
include("cn.php");
$mostrar=mysql_query("SELECT * FROM productos INNER JOIN categoria ON productos.id_categoria=categoria.id_categoria");
while($reg=mysql_fetch_array($mostrar)){
	echo"<tr>
	<td>$reg[nombre]</td><td>$reg[precio]</td><td>$reg[descripcion]</td><td><a href='comprar.php?id=$reg[id_producto]'><img src='$reg[imagen]' width='100px' height='100px'></td>
	</tr>";
	}
	*/
?>
</table>
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
                url:"search_prod_ca.php",
                method:"POST",                
                data: 'busqueda=' + prod,
                success:function(data){
                  
                  jQuery("table#bod").append(jQuery(data));
                  
                }
                });
              }

  </script>
</body>
</html>
