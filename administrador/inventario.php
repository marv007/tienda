<div class="table-responsive bg-light">
  <form  method="post">
    <table class="table">

      <tr class="bg-dark text-light">
        <th></th>
        <th scope="col">codigo</th>
        <th scope="col">Nombre de proveedor</th>
        <th scope="col">Opciones</th>
      </tr>
      <?php
      while($reg=$sentencia->fetch_assoc()){
        echo "<tr>
              <td scope='col'><input type='checkbox' name='check_borrarcat[]' value='$reg[id_grado]' class='form-control' id='customCheck1'></td>
              <td scope='col'>$reg[id_grado]</td>
              <td scope='col'>$reg[nombregrado]</td>
              <td scope='col'><a class='btn btn-success' href='#'><i class='fas fa-edit'></i></a></td>
              </tr>";
      }

      if(isset($_POST["borrar"])){
        foreach($_POST["check_borrarcat"] as $cod_borrar)
        {
          $sql_borrar ="delete from grados where id_grado = $cod_borrar";
          $sentenciaborrar=$mysqli->query($sql_borrar);
        }
        echo "<script> document.location.href='index.php?op=grados.php'</script>";
      }

      ?>
      <tr class="">
        <th class="text-center" colspan="4"> <input  type="submit" class="btn btn-danger" value='borrar grado' name="borrar"></th>
      </tr>
  </table>
  </form>

</div>
