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

function obtenerValor($var){
  if (!isset($_REQUEST[$var])) {
    $value = "";
  } else {
    $value = trim(strip_tags($_REQUEST[$var]));
  }
  return $value;
}

$campo1 = obtenerValor("campo1");
$campo2 = obtenerValor("campo2");
$mensajeError="";
$ordenacion="";


if($campo1!=""){
  if($campo2==""){
    $ordenacion  = "order by $campo1";
  }elseif($campo1!=$campo2){
    $ordenacion = "order by $campo1, $campo2";
  }else{
    $mensajeError="Ha seleccionado el mismo campo para los dos desplegables. Deben ser distintos.";
  }
} else {
  if($campo2!=""){
    $mensajeError="No puede dejar el primer desplegable vacío";
  }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Alumnos - Ordenar
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Listado de Alumnos</h1>
  <div style="margin-bottom: 1em">
  	<fieldset style="width:50%">
  		<legend>Criterio de ordenación</legend>
  		<form name="filtrar" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  			
      <p>Primer campo: <select name="campo1">
  				<option value="">Seleccione el campo por el que desea ordenar</option>
  				<option value="nombre">Nombre</option>
  				<option value="apellidos">Apellidos</option>
  				<option value="nota">Nota</option>
  				<option value="curso">Curso</option>
  				<option value="itinerario">Itinerario</option>
  			</select>
  			</p>

        <p>Segundo campo: <select name="campo2">
  				<option value="">Seleccione el campo por el que desea ordenar</option>
  				<option value="nombre">Nombre</option>
  				<option value="apellidos">Apellidos</option>
  				<option value="nota">Nota</option>
  				<option value="curso">Curso</option>
  				<option value="itinerario">Itinerario</option>
  			</select>
  			</p>
  			
        <input type="submit" value="Ordenar">
  		</form>
  	</fieldset>
  </div>
  <div>

  <?php
  print"<p>";
  print $mensajeError;
  if($mensajeError==""){
      if($campo2=="" && $campo1==""){
        print "";
      }elseif($campo2=="" && $campo1!=""){
        print "Listado ordenado por: El campo $campo1";
      }else{
      print "Listado ordenado por: El campo $campo1 y luego por el campo $campo2";
    }
  }
    print"</p>";
  ?>

  <table border="1" cellpadding="10">
      <thead>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Nota</th>
        <th>Curso</th>
        <th>Itinerario</th>
      </thead>
      <tbody>
        <?php
          $consultaAlumnos="SELECT a.nombre as nombre, a.apellidos as apellidos, a.nota as nota, c.nombre as curso, i.nombre as itinerario 
          from itinerarios i, cursos c, alumnos a 
          where c.id = a.curso and i.id = c.itinerario
          $ordenacion";

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
</body>
</html>
