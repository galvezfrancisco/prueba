<?php
  session_name("sesion-04");
	session_start();

	try{
    	$mysql = 'mysql:host=localhost;dbname=dwes_ene2021';
    	$usuario = 'root';
    	$contrasena = '';
    	$conexion = new PDO($mysql, $usuario, $contrasena, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
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
	
	$_SESSION['mensajeError'] = "";

	$nombreOK = False;
	$apellidosOK = False;
	$notaOK = False;
	$cursoOK = False;

	$nombre = obtenerValor("nombre");
	$apellidos =  obtenerValor("apellidos");
	$nota =  obtenerValor("nota");
	$curso =  obtenerValor("curso");

	$_SESSION['nombre'] = $nombre;
	$_SESSION['apellidos'] = $apellidos;
	$_SESSION['nota'] = $nota;
	$_SESSION['curso'] = $curso;

	if ($nombre == "") {
		$_SESSION['mensajeError'] .="<p>No ha escrito un nombre.</p>";
	} else{
		$nombreOK = True;
  }
  
	if ($apellidos == "") {
		$_SESSION['mensajeError'] .="<p>No ha escrito el/los apellidos.</p>";
	} else {
		$apellidosOK = True;
  }
  
  if ($nota == "") {
		$_SESSION['mensajeError'] .="<p>No ha escrito ninguna nota.</p>";
	} else {
		$notaOK = True;
	}

	if ($curso == "") {
		$_SESSION['mensajeError'] .="<p>No ha seleccionado el curso.</p>";
	} else {
		$cursoOK = True;
	}
	
	if ($nombreOK && $apellidosOK && $notaOK && $cursodOK){
		unset($_SESSION['mensajeError']);
		$consulta = "insert into alumnos (nombre, apellidos, nota, curso) values(:nombre, :apellidos, :nota, :curso)";
		$insert = $conexion->prepare($consulta);
		$insert->execute(array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':nota'=>$nota, ':curso'=>$curso));
		
		$insert = null;
		header("Location: ejercicio-04-01.php");
		
	}else{
		header("Location: ejercicio-04-02.php");
	}
	
	$conexion =null;


?>