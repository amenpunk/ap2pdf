<!DOCTYPE html>
<?php include ("con.php"); ?>
  <html lang="es">
    <head>
      <meta charset="UTF-8"/>        
    </head>

    <style>
      .cabeza{
          color:red;
       }
    </style>

    <body>

      <table border="1"> 
        <thead>
          <th>
            Nombre Completo
          </th>
        </thead>
        <tbody>
<?php
$sql = "SELECT primer_nombre,primer_apellido FROM paciente";
$stmt = sqlsrv_query( $conn, $sql );
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

?>

        <tr> 
        <th>
<?php            
    echo $row['primer_nombre'].", ".$row['primer_apellido'];
?>
        </tr>


<?php } ?>
        </tbody>
      </table>
      <h1 class="cabeza">Reporte Paciente</h1>

    </body>
  </html>

