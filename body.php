<!DOCTYPE html>

<?php
$serverName = "localhost";
$connectionInfo = array( "Database"=>"prueba", "UID"=>"sa", "PWD"=>"Naruto10");
$conn = sqlsrv_connect( $serverName, $connectionInfo );
?>

<html>
  <head>
   <style type="text/css">  

     #titulo{
        background:#1e1e1e;
        padding:10px;
        color:white;
        height:100%;
     }

    </style>  
  </head>
<?php

$id_paciente = $_GET['id_paciente'];
$id_exp = $_GET['id_exp'];
$sql_dos = 'SELECT * FROM expediente where id_paciente='.$id_paciente.'AND id_expediente='.$id_exp;
$stmt_dos = sqlsrv_query( $conn, $sql_dos );

?>

    <body>
<?php 
while( $row = sqlsrv_fetch_array( $stmt_dos, SQLSRV_FETCH_ASSOC) ) {
    //echo var_dump($row);
    echo "<h1 class=titulo> Expediente:<strong>". $row['fecha_gen']->format('d-m-y'). "-".$row['id_expediente']."</strong></h1>";
}
?> 
    <!--- fin del encabezado -->
<?php

$sql = 'SELECT primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,numero_tel,fecha_nacimiento FROM paciente where id_paciente='.$id_paciente;
$stmt = sqlsrv_query( $conn, $sql );

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    echo "<p> <strong>Nombre Completo:</strong> ". $row['primer_nombre']." ".$row['segundo_nombre']." ".$row['primer_apellido']." ".$row['segundo_apellido']." <strong> Número de telefono </strong> ".$row['numero_tel']."</p>";
    echo "<hr style=width:100%>";
}
sqlsrv_free_stmt($stmt); ?>
    <h2>Consultas del expediente</h2>

    <table border="1" width="auto">
        <tr> 
      <td><strong>Id</strong></td>
      <td><strong>Asunto Consulta</strong></td>
      <td><strong>Monto</strong></td>
       </tr>

<?php
$consulta = 'SELECT id_consulta,asunto,monto_caja from consulta where id_expediente='.$id_exp;
$stmt = sqlsrv_query( $conn, $consulta );

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>";
    echo   "<td>".$row['id_consulta']."</td>";
    echo "<td>".$row['asunto']."</td>";
    echo "<td>".$row['monto_caja']."</td>";
    echo   "</tr>";
}
sqlsrv_free_stmt($stmt); 
?>
    </table>

    </body>
</html>
