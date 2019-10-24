<!DOCTYPE html>


<?php
$serverName = "localhost";
$connectionInfo = array( "Database"=>"prueba", "UID"=>"sa", "PWD"=>"Naruto10");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
?>

<html>
  <head>
   <style>  
     #titulo{
        background:#1e1e1e;
        padding:10px;
        color:white;
        height:100%;
     }
  </style>  
  </head>
    <body>
      <h1 id="titulo">
        Expediente NO:
      </h1>
    <?php

    $id_paciente = $_GET['id_paciente'];
    $id_exp = $_GET['id_exp'];
    $sql = 'SELECT primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,numero_tel,fecha_nacimiento FROM paciente where id_paciente='.$id_paciente;
    $stmt = sqlsrv_query( $conn, $sql );
      if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
      }
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        echo "<p> <strong>Nombre Completo:</strong> ". $row['primer_nombre']." ".$row['segundo_nombre']." ".$row['primer_apellido']." ".$row['segundo_apellido']." <strong> Número de telefono </strong> ".$row['numero_tel']."</p>";
        echo "<hr style=width:100%>";
    }
    sqlsrv_free_stmt($stmt); ?>

    </body>
</html>
