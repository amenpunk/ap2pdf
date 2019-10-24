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
    </body>
  </head>
</html>
