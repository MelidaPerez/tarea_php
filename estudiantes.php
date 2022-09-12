<!doctype html>
<html lang="en">

<head>
  <title>ESTUDIANTES</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <?php include 'index.php';?> 
    <h1>FORMULARIO ESTUDIANTES</h1>
    <div class="container">
<form class="d-flex" action="crud_estudiantes.php" method="post">
    <div class="col">
        <div class="mb-3">
            <label for="lbl_id" class="form-label"><b>ID</b></label>
            <input type="text" name="txt_id" id="txt_id" class="form-control" value="0" readonly>
        </div>

        <div class="mb-3">
            <label for="lbl_carne" class="form-label"><b>Carne</b></label>
            <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="Carne:202250758" required>
        </div>

        <div class="mb-3">
            <label for="lbl_codigo" class="form-label"><b>Nombres</b></label>
            <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Nombres: Nombre1 Nombre2" required>
        </div>

        <div class="mb-3">
            <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
            <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Apellidos: Apellido1 Apellido2" required>
        </div>
        
        <div class="mb-3">
            <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
            <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Direccion: #casa calle avenida lugar" required>
        </div>
              
        <div class="mb-3">
            <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
            <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Telefono: 55552222" required>
        </div>

        <div class="mb-3">
            <label for="lbl_correo" class="form-label"><b>Correo Electronico</b></label>
            <input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="correo@gmail.com" required>
        </div>

        <div class="mb-3">
            <label for="lbl_tipo_sangre" class="form-label"><b>Puesto</b></label>
            <select class="form-select" name="drop_tipo_sangre" id="drop_tipo_sangre">
                <option value=0> ---- TIPO SANGRE ---- </option>
                <?php 
                   include("datos_conexion.php");
                   $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                   $db_conexion -> real_query ("SELECT id_tipo_sangre as id,sangre FROM tipos_sangre;");
                  $resultado = $db_conexion -> use_result();
                  while ($fila = $resultado ->fetch_assoc()){
                    echo "<option value=". $fila['id'].">". $fila['sangre']."</option>";

                  }
                  $db_conexion ->close();

                  ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="lbl_fn" class="form-label"><b>Fecha Nacimiento</b></label>
            <input type="date" name="txt_fn" id="txt_fn" class="form-control" placeholder="aaaa-mm-dd" required>
        </div>
        
        <div class="mb-3">
                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value = "Agregar">
                <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value = "Modificar">
                <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" value = "Eliminar">
        </div>
    </div>
</form>
<table class="table table-striped table-inverse table-responsive">
      <thead class="thead-inverse">
        <tr>
          <th>Carne</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th>Correo</th>
          <th>Puesto</th>
          <th>Nacimiento</th>
        </tr>
        </thead>
        <tbody id="tbl_estudiantes">
        <?php 
          include("datos_conexion.php");
          $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
          $db_conexion -> real_query ("SELECT e.id_estudiante as id,e.carne,e.nombres,e.apellidos,e.direccion,e.telefono,e.correo_electronico,p.sangre,e.fecha_nacimiento,e.id_tipo_sangre FROM estudiantes as e inner join tipos_sangre as p on e.id_tipo_sangre = p.id_tipo_sangre;");
          $resultado = $db_conexion -> use_result();
          while ($fila = $resultado ->fetch_assoc()){
          echo "<tr data-id=". $fila['id']." data-idp=". $fila['id_tipo_sangre'].">";
          echo "<td>". $fila['carne']."</td>";
          echo "<td>". $fila['nombres']."</td>";
          echo "<td>". $fila['apellidos']."</td>";
          echo "<td>". $fila['direccion']."</td>";
          echo "<td>". $fila['telefono']."</td>";
          echo "<td>". $fila['correo_electronico']."</td>";
          echo "<td>". $fila['sangre']."</td>";
          echo "<td>". $fila['fecha_nacimiento']."</td>";
          echo "</tr>";

        }
        $db_conexion ->close();
        ?>
        </tbody>
    </table>
    </div>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous">    
  </script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>
  
        <script>
    $('#tbl_estudiantes').on('click','tr td',function(evt){
        var target,id,idp,carne,nombres,apellidos,direccion,telefono,correo,nacimiento;
        target = $(event.target);
        id = target.parent().data('id');
        idp = target.parent().data('idp');
        carne = target.parent("tr").find("td").eq(0).html();
        nombres = target.parent("tr").find("td").eq(1).html();
        apellidos =  target.parent("tr").find("td").eq(2).html();
        direccion = target.parent("tr").find("td").eq(3).html();
        telefono = target.parent("tr").find("td").eq(4).html();
        correo = target.parent("tr").find("td").eq(5).html();
        nacimiento  = target.parent("tr").find("td").eq(7).html();
        $("#txt_id").val(id);
        $("#txt_carne").val(carne);
        $("#txt_nombres").val(nombres);
        $("#txt_apellidos").val(apellidos);
        $("#txt_direccion").val(direccion);
        $("#txt_telefono").val(telefono);
        $("#txt_correo").val(correo);
        $("#drop_tipo_sangre").val(idp);
        $("#txt_fn").val(nacimiento);

    });
    </script>
</body>

</html>