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
    .fuerte{
        background:#1e1e1e;
        color:white;
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
        <tr class="fuerte"> 
      <td><strong>ID Consulta</strong></td>
      <td><strong>Asunto Consulta</strong></td>
      <td><strong>Monto</strong></td>
       </tr>

<?php
$consulta = 'SELECT id_consulta,asunto,monto_caja from consulta where id_expediente='.$id_exp;
$stmt = sqlsrv_query( $conn, $consulta );
$cont = 0;

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>";
    echo   "<td>".$row['id_consulta']."</td>";
    echo "<td>".$row['asunto']."</td>";
    echo "<td>".$row['monto_caja']."</td>";
    echo   "</tr>";
    $cont = $cont+$row['monto_caja'];
}

sqlsrv_free_stmt($stmt); 
?>

    <tr width="1000px"><th><strong style="color:red">Total:</strong> <?= $cont ?></th></tr>
    </table>
    
    <h2>Ordenes de laboratorio</h2>
    <table border="1" width="auto">
        <tr class="fuerte"> 
      <td><strong>ID Consulta</strong></td>
      <td><strong>Nombre Examen</strong></td>
       </tr>
<?php
$consulta = '
select  c.id_consulta,o.nombre_examen from expediente e 
inner join consulta c ON e.id_expediente = c.id_expediente
inner join orden_lab o ON o.id_consulta = c.id_consulta 
where e.id_expediente ='.$id_exp;
$stmt = sqlsrv_query( $conn, $consulta );

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>";
    echo   "<td>".$row['id_consulta']."</td>";
    echo "<td>".$row['nombre_examen']."</td>";
    echo   "</tr>";
}

sqlsrv_free_stmt($stmt); 
?>

    </table>
    
    <h2>Diagnostico</h2>
    <table border="1" width="auto">
        <tr class="fuerte"> 
      <td><strong>ID Consulta</strong></td>
      <td><strong>Diagnostico</strong></td>
       </tr>
<?php
$consulta = 'select  c.id_consulta,d.id_cie from expediente e 
    inner join consulta c ON e.id_expediente = c.id_expediente
    inner join diagnostico d ON d.id_consulta = c.id_consulta 
    where e.id_expediente ='.$id_exp;
$stmt = sqlsrv_query( $conn, $consulta );

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>";
    echo   "<td>".$row['id_consulta']."</td>";
    echo "<td>".$row['id_cie']."</td>";
    echo   "</tr>";
}

sqlsrv_free_stmt($stmt); 
?>

    </table>
    <h2>Recetas Médicas</h2>
    <table border="1" width="auto">
        <tr class="fuerte">  
      <td class="fuerte"><strong>ID Consulta</strong></td>
      <td class="fuerte"><strong>ID Receta</strong></td>
      <td class="fuerte"><strong>Medicamento</strong></td>
      <td class="fuerte"><strong>Cantidad</strong></td>
      <td class="fuerte"><strong>Dosis</strong></td>
       </tr>
<?php
$consulta = 'select c.id_consulta ,r.id_receta,d.medicamento,d.cantidad,d.dosis from des_receta d inner join receta r
    on d.id_receta = r.id_receta inner join consulta c 
    ON r.id_consulta = c.id_consulta inner join 
    expediente e ON c.id_expediente = e.id_expediente 
    where  e.id_expediente ='.$id_exp;
$stmt = sqlsrv_query( $conn, $consulta );

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
    echo "<tr>";
    echo   "<td>".$row['id_consulta']."</td>";
    echo   "<td>".$row['id_receta']."</td>";
    echo   "<td>".$row['medicamento']."</td>";
    echo   "<td>".$row['cantidad']."</td>";
    echo   "<td>".$row['dosis']."</td>";
    echo "</tr>";
}

sqlsrv_free_stmt($stmt); 
?>

    </table>
 


    </body>
</html>
