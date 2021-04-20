<?php


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
    Itinerarios - Cursos
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Itinerarios Formativos</h1>

  <div>

  <table border="1" cellpadding="10">
      <thead>
        <th>Itinerario</th>
        <th>Numero de cursos</th>
      </thead>
      <tbody>
        <?php
         
          
          $consultaCentros = "SELECT i.id as id, i.nombre as nombre, count(c.nombre) as numCursos from itinerarios i, cursos c where i.id = c.itinerario group by id";
          $resultado = $conexion->query($consultaCentros);
         
          while($row = $resultado->fetch_object()){
            print "<tr>";
            print "<td>$row->nombre</td>";
            print "<td><a href=\"ejercicio-02-02.php?curso=$row->id\">$row->numCursos</a></td>";
            print"</tr>";
          }

          $resultado->free();

          $conexion->close();
        ?>
      </tbody>
    </table>
    
  </div>
</body>
</html>
