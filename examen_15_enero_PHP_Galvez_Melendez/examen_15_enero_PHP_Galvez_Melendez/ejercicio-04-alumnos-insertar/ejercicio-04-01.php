<?php


try{
  $mysql = 'mysql:host=localhost;dbname=dwes_ene2021';
  $usuario = 'root';
  $contrasena = '';
  $conexion = new PDO($mysql, $usuario, $contrasena);

}catch (PDOException $e){
  print "<p>" .$e->getMessage()."</p>";
  die();
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
  <h1>Listado de Alumnos</h1>

  <div>

  <?php
      // Obtenemos los empleados del departamento
      $consultaEmpleados = "SELECT e.id as id, e.nombre, apellidos, salario, hijos, p.nacionalidad as nacionalidad from Empleados as e INNER JOIN paises p on p.id=e.nacionalidad";

      $consulta = $conexion->prepare($consultaEmpleados);
      $consulta->execute();

      $numRegistros = $consulta->rowCount();
    ?>
    <table border="1" cellpadding="10">
      <thead>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Salario</th>
        <th>Hijos</th>
        <th>Nacionalidad</th>
      </thead>
      <tbody>
        <?php
          
          $consultaAlumnos="SELECT a.nombre as nombre, a.apellidos as apellidos, a.nota as nota, c.nombre as curso, i.nombre as itinerario 
          from itinerarios i, cursos c, alumnos a 
          where c.id = a.curso and i.id = c.itinerario";

          $consulta = $conexion->prepare($consultaAlumnos);
          $consulta->execute();

          while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            print "<tr>";
            print "<td>$row->nombre</td>";
            print "<td>$row->apellidos</td>";
            print "<td>$row->nota</td>";
            print "<td>$row->curso</td>";
            print "<td>$row->itinerario</td>";
            print"</tr>";
          }

          $consulta = null;
        ?>
      </tbody>
    </table>

  </div>
  
  <div style="margin: 1em 0;">
    <button onclick="window.location.href='ejercicio-04-02.php';">
      Añadir Alumno
    </button>
  </div>
</body>
</html>
