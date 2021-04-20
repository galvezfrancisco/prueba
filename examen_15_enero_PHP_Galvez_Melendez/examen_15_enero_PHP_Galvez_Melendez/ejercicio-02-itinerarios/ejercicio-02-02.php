<?php

session_name("ejercicio-02");
session_start();

if (isset($_REQUEST["curso"])) {
  $_SESSION["curso"] = $_REQUEST["curso"];
}

$curso = $_SESSION["curso"];

try {
  $host = "localhost";
  $user = "root";
  $dbname = "dwes_ene2021";
  $conexion = new mysqli ($host, $user, '', $dbname);
}catch (mysqli_sql_exception $e) {
  print "<p>Error: No puede conectarse con la base de datos.</p>";
  print "<p>Error: ".$e->getMessage()."</p>";
  exit();
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Itinerario - Cursos
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  
  <h2>Listado de <?php echo"$curso"?></h2>

  <div>

  <table border="1" cellpadding="10">
      <thead>
        <th>Nombre</th>
        <th>Numero de grupos</th>
        <th>Numero de alumnos</th>
      </thead>
      <tbody>
        <?php
         
          
          $consultaCentros = "SELECT c.id as id, c.nombre as nombre, c.grupos as grupos, count(a.id) as numAlumnos from alumnos a, cursos c where c.id = a.curso and c.itinerario = $curso group by id";
          $resultado = $conexion->query($consultaCentros);
         
          while($row = $resultado->fetch_object()){
            print "<tr>";
            print "<td>$row->nombre</td>";
            print "<td>$row->grupos</td>";
            print "<td><a href=\"ejercicio-02-02.php?curso=$row->id\">$row->numAlumnos</a></td>";
            print"</tr>";
          }

          $resultado->free();

          $conexion->close();
        ?>
      </tbody>
    </table>

    <p>
      <a href="ejercicio-02-01.php">Volver</a>
    </p>
  </div>
</body>
</html>
