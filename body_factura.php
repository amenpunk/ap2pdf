
<!DOCTYPE html>
<?php
$serverName = "localhost";
$connectionInfo = array( "Database"=>"clinica", "UID"=>"sa", "PWD"=>"Naruto10");
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
    #space{
       height:50px;
    }
    table,th,td,li{
      padding:10px;
      text-align:center;
    }

    #der{
      padding-left:645px;
      background:#1e1e1e;
      padding-top:10px;
      padding-bottom:10px;
      color:white;
    }
    </style>  
  </head>

  <body>

    <?php
    
    $id_exp = $_GET['id'];
    if(isset( $_GET['nit'] )){
      $nit = $_GET['nit'];
    }
    else{
      $nit = "CF";
    }

    $sql_dos ="select CONCAT(p.primer_nombre,' ', p.segundo_nombre ,' ', p.primer_apellido,' ',p.segundo_apellido ) as nombre from expediente e inner join
    paciente p ON e.id_paciente = p.id_paciente 
    where e.id_expediente =".$id_exp;
    //$stmt_dos = sqlsrv_query( $conn, $sql_dos );
    $stmt_dos = sqlsrv_query( $conn, $sql_dos );
    //
    ?>

    <h1>Clinica Medica UMG</h1> 
    <hr>
    <div id="space"> </div>

    <h2>Factura expediente </h2>
<?php 
while( $row = sqlsrv_fetch_array( $stmt_dos, SQLSRV_FETCH_ASSOC) ) {
    //echo var_dump($row);
    echo  "<p><strong>Paciente: </strong>".$row['nombre']."  <strong>NIT: </strong>".$nit."</p>";
    echo "<hr>";
}
?> 

<col width="250">
<table border="1" width="auto">
        <tr class="fuerte"> 
      <td width="150"><strong>Cantidad</strong></td>
      <td width="375"><strong>Asunto Consulta</strong></td>
      <td width="65"><strong>Monto</strong></td>
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
    echo   "<td>1</td>";
    echo "<td>".$row['asunto']."</td>";
    echo "<td>Q.".$row['monto_caja']."</td>";
    echo   "</tr>";
    $cont = $cont+$row['monto_caja'];
}

sqlsrv_free_stmt($stmt); 
?>

    </table>
    <div id="der"><strong> Total: </strong> Q.<?= $cont ?></div>
    



 </body>

</html>
