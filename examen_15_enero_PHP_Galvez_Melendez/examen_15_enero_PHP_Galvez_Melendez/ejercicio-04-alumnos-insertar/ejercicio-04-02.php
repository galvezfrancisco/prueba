<?php

session_name("sesion-04");
session_start();

try{
  $mysql = 'mysql:host=localhost;dbname=dwes_ene2021';
  $usuario = 'root';
  $contrasena = '';
  $conexion = new PDO($mysql, $usuario, $contrasena);

}catch (PDOException $e){
  print "<p>" .$e->getMessage()."</p>";
  die();
}

$nombre = "";
$apellidos = "";
$nota =  "";
$curso =  -1;
$mensaje = "";

if(isset($_SESSION['mensajeError'])){
  $mensaje = $_SESSION['mensajeError'];
  $nombre = $_SESSION['nombre'];
  $apellidos = $_SESSION['apellidos'];
  $nota = $_SESSION['nota'];
  $curso = $_SESSION['curso'];

  unset($_SESSION['mensajeError']);
  unset($_SESSION['nombre']);
  unset($_SESSION['apellidos']);
  unset($_SESSION['nota']);
  unset($_SESSION['curso']);
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Alumnos - Insertar
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Insertar Alumno</h1>

  <div>
    <form action="ejercicio-04-03.php" method="post">

      <p><label>Nombre: <input type="text" name="nombre" value="<?php echo $nombre?>"></label></p>
      <p><label>Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos?>"></label></p>
      <p><label>Nota: <input type="number" min=1 max=10 name="nota" value="<?php echo $nota?>"></label></p>

      <p>Curso: <select name="curso">
        <option value="">Seleccione curso</option>
        <?php
          $consulta = "select c.nombre as nombre, i.nombre as itinerario from cursos c, itinerarios i order by c.id";
          
          foreach ($conexion->query($consulta) as $row) {  
            $selectedCurso = "";
            if ($row['id']==$curso){
              $selectedCurso = "selected";
            }
            print "<option value='".$row['id'] . "' $selectedCurso>".$row['nombre']. "-" . $row['itinerario'] ."</option>";
          }

          $conexion = null;

        ?>
        </select>
      </p>
      <?php
        if (!empty($mensaje)){
          print "<p>$mensaje</p>";
        }
      ?>
     
      <p>
        <input type="submit" value="Guardar">
      </p>
    </form>
    <p>
      <a href="ejercicio-04-01.php">Volver</a>
    </p>
  </div>
</body>
</html>
