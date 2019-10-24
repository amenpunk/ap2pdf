<!DOCTYPE html>


<?php
$serverName = "localhost";
$connectionInfo = array( "Database"=>"prueba", "UID"=>"sa", "PWD"=>"Naruto10");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
?>

<html>
  <head>
    <body>
      <h1>
        HOLA MUNDO DESDE EL BODY
      </h1>
    <?php

    $id = $_GET['id'];
    echo var_dump($id);

    $sql = 'SELECT primer_nombre,primer_apellido FROM paciente where id_paciente='.$id;
    $stmt = sqlsrv_query( $conn, $sql );
      if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
      }
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        echo $row['primer_nombre'].", ".$row['primer_apellido']."<br />";
    }
    sqlsrv_free_stmt( $stmt); ?>

    </body>
  </head>
</html>
