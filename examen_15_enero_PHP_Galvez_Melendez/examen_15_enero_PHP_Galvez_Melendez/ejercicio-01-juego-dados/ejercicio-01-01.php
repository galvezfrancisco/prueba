<?php

session_name("ejercicio-01-01");
session_start();
  
$numeroDados = 6;
$puntuacionJugador1 = 0;
$puntuacionJugador2 = 0;

if (!isset($_SESSION["vecesJugadas"])  || !isset($_SESSION["vecesGanador1"]) || !isset($_SESSION["puntuacionExtra1"]) || !isset($_SESSION["vecesGanador2"]) || !isset($_SESSION["puntuacionExtra2"])){
      $_SESSION["vecesGanador1"] = 0;
      $_SESSION["puntuacionExtra1"] = 0;
      $_SESSION["vecesGanador2"] = 0;
      $_SESSION["puntuacionExtra2"] = 0;
      $_SESSION["vecesJugadas"] = 0;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Juego dados
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Juego dados</h1>
    
  <?php
        
        for ($i=0; $i<$numeroDados; $i++){
          $dadosJugador1[$i] = rand(1,6);
          $dadosJugador2[$i]  = rand(1,6);   
        }
      
        $_SESSION["vecesJugadas"]++;
    ?>

  <h3>Dados del Jugador 1</h3>
    <p>
      <?php

      $extraPar[]=0;
      $extraImpar[]=0;
      $i=0;
      $j=0;

      foreach ($dadosJugador1 as $dado) {
        print "<img src=\"img/". $dado  .".svg\" alt=\"1\" width=\"140\" height=\"140\">";

        if($dado%2==0){
          $extraPar[$i] = $dado;
          $i++;
        } else {
          $extraImpar[$j] = $dado;
          $j++;
        }
      }

      $puntuacionJugador1=array_sum($dadosJugador1);

      if(count($extraPar)<4){
        $puntuacionExtraPar = array_unique($extraPar);

        if(count($puntuacionExtraPar)==3){
          $_SESSION["puntuacionExtra1"]++;
          $puntuacionJugador1=$puntuacionJugador1 + 2;
        }
      } elseif (count($extraImpar)<4){
        $puntuacionExtraImpar = array_unique($extraImpar);

        if (count($puntuacionExtraImpar)==3){
          $_SESSION["puntuacionExtra1"]++;
          $puntuacionJugador1=$puntuacionJugador1 + 1;
        }
      }


      ?>

  <h3>Dados del Jugador 2</h3>
    <p>
      <?php

      $extraPar[]=0;
      $extraImpar[]=0;
      $i=0;
      $j=0;

      foreach ($dadosJugador2 as $dado) {
        print "<img src=\"img/". $dado  .".svg\" alt=\"1\" width=\"140\" height=\"140\">";

        if($dado%2==0){
          $extraPar[$i] = $dado;
          $i++;
        } else {
          $extraImpar[$j] = $dado;
          $j++;
        }
      }

      $puntuacionJugador2=array_sum($dadosJugador2);

      if(count($extraPar)<4){
        $puntuacionExtraPar = array_unique($extraPar);

        if(count($puntuacionExtraPar)==3){
          $_SESSION["puntuacionExtra2"]++;
          $puntuacionJugador2=$puntuacionJugador2 + 2;
        }
      } elseif (count($extraImpar)<4){
        $puntuacionExtraImpar = array_unique($extraImpar);

        if (count($puntuacionExtraImpar)==3){
          $_SESSION["puntuacionExtra2"]++;
          $puntuacionJugador2=$puntuacionJugador2 + 1;
        }
      }     


      ?>

  <h3>Puntuaciones:</h3>
    <p>Puntuación del jugador 1: <b><?php echo $puntuacionJugador1?></b></p>
    <p>Puntuación del jugador 2:  <b><?php echo $puntuacionJugador2?></b></p>

    <?php
      
      if ($puntuacionJugador1==$puntuacionJugador2){
        print "<p><b>Han empatado</b></p>";
      }elseif ($puntuacionJugador1>$puntuacionJugador2) {
        $_SESSION["vecesGanador1"]++;
        print "<p><b>Ha ganado el jugador 1</b></p>";
      }else{
        $_SESSION["vecesGanador2"]++;
        print "<p><b>Ha ganado el jugador 2</b></p>";
      }
    ?>

    <h3>Resumen:</h3>

    <p>Número de veces que han jugado: <b><?php echo $_SESSION["vecesJugadas"]?></b>
    <p>Número de veces que ha ganado el jugador 1: <b><?php echo $_SESSION["vecesGanador1"]?></b></p>
    <p>Número de veces que ha ganado el jugador 2: <b><?php echo $_SESSION["vecesGanador2"]?></b></p>
    <p>Número de veces que ha el jugador 1 ha obtenido puntuación extra: <b><?php echo $_SESSION["puntuacionExtra1"]?></b></p>
    <p>Número de veces que ha el jugador 2 ha obtenido puntuación extra: <b><?php echo $_SESSION["puntuacionExtra2"]?></b></p>


</body>
</html>