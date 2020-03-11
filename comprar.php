<?php
$id_producto= $_GET["id"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sistema de inventario cadig</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body class="bg-info">
	<br><br><br>
	<div class="row">
		<div class="col-md-3">

		</div>
		<div class="col-md-6">
			<form method="post" autocomplete="off" name="f1">
			<table class="table bg-light" align="center">
			<tr>
			<td align=center  bgcolor='#C0C0C0' colspan=6>Productos</td>
			</tr>
			<tr align=center>
			<!--<td>Total</td>
			<td>Total a cancelar</td> -->
			<?php
			if(!isset($_GET["id"])){

				echo "no hay id";
				/*echo"<script>document.location.href='catalogo.php';</script>";*/
				}


			/*include("cn.php");
			$mostrar=mysql_query("SELECT * FROM productos INNER JOIN categoria ON productos.id_categoria=categoria.id_categoria where id_producto='$_GET[id]'");
			while($reg=mysql_fetch_array($mostrar)){
				echo"<tr>
				<td><input type='text' name='id_prod' value='$reg[id_producto]'></td>
				<td><input type='text' name='precio' value='$reg[precio]'></td>
				<td><input type='text' name='can_fact' size=2></td>
				<td><input type='text' name='nombre' value='$reg[nombre]'></td>
				<td><img src='$reg[imagen]' width='100px' height='100px'><br>
				<input type=text name=ima value='$reg[imagen]'>
				</td>
				</tr>";
				}*/

			        //acualizar php 5


			      $mysqli = new mysqli("localhost","root","","cadig");
			$sql="SELECT * FROM productos where id_producto='$id_producto'";

			$sentencia=$mysqli->query($sql);
			      while($reg=$sentencia->fetch_assoc()){

							echo"
							<tr>
							<td>Codigo Producto: <input type='text' class='form-control' name='id_prod' hidden readonly value='$reg[id_producto]'>
							<input type='text' class='form-control' name='cod_prod' readonly value='$reg[codigo]'></td></tr>
							<tr><td>Precio: <input type='text' class='form-control' name='precio' readonly value='$reg[precioventa]'></td></tr>
							<tr><td>cantidad disponible: <input type='text' class='form-control' name='cant_dis'readonly value='$reg[cantidad]'></td></tr>
							<tr><td>Cantidad a pedir<input type='text' required class='form-control' name='can_fact' size=2></td></tr>
							<tr><td>
							Descuentos
							<input type='radio' name='descuento' value='0.05'> 5%
							<input type='radio' name='descuento' value='0.10'> 10%
							<input type='radio' name='descuento' value='0.15'> 15%
							<input type='radio' name='descuento' value='0.20'> 20%
							</td></tr>
							<tr><td>Nombre de producto<input type='text' class='form-control' name='nombre' readonly value='$reg[nombre_producto]'></td></tr>";

			      }

				    //fin actualizar php5
						setlocale(LC_ALL, 'es_ES');
						$fecha = strftime("%y/%m/%d");
			?>
			</tr>
			<tr>
			<!--<td><input type="text" name="campo5" /></td>
			<td><input type="text" name="campo6" /></td>-->
			</tr>
			<tr>
			<td align=center colspan=6><input class="btn btn-success" type="submit" name="ok" value="agregar a carrito" />
			</td>
			</tr>
			</table>



			<?php
			@session_start();
			if(isset($_POST["ok"])){

				// descuentos
				$descuento = $_POST["descuento"];
				$precioventa = $_POST["precio"];
				if ($descuento == "0.05") {
					$precion = $precioventa * 0.05;
					$pdes =$precioventa - $precion;
				}
				elseif ($descuento == "0.10") {
					$precion = $precioventa * 0.10;
					$pdes =$precioventa - $precion;
				}
				elseif($descuento == "0.15") {
					$precion = $precioventa * 0.15;
					$pdes =$precioventa - $precion;
				}
				elseif ($descuento == "0.20") {
					$precion = $precioventa * 0.20;
					$pdes =$precioventa - $precion;
				}
				else {
					$precion = "0";
					$pdes = $precioventa;
				}
				//codigo carrito

			    $contador=0;
			    $id=0;

			    if(isset($_SESSION["id"])){
			        $id=$_SESSION["id"]++;
			        $id=$id;

			        }else{
			            $_SESSION["id"]=0;
						 $id=$_SESSION["id"];
			            }
			            echo "ID:$id<br>";
			           //almacenar datos
			       if(isset($_SESSION['datos'])){
			$carro=$_SESSION['datos'];
			}
			$fecham = $fecha;
			$descuento = $_POST["descuento"];
			$codigo =$_POST["cod_prod"];
			$id_prod=$_POST["id_prod"];
			$can_fact=$_POST["can_fact"];
			//$id_client=$_POST["id_client"];
			$precio=$_POST["precio"];
			$nombre=$_POST["nombre"];
			$total=0;
			$totalcan=0;

			$carro[$id_prod]=array(
			'identificador'=>$id_prod,

			'codigo'=>$codigo,
			'cantidad_fact'=>$can_fact,
			'descuento'=>$descuento,
			'pdes'=>$pdes,
			'nombre'=>$nombre,
			'total'=>$total,
			'precio'=>$precio,
			'fecha'=>$fecham);

			$_SESSION['datos']=$carro;

			echo"<script>document.location.href='productos.php';</script>";
			}
			?>
		</div>
		<div class="col-md-3">

		</div>
	</div>

</body>
</html>
