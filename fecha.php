<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
    .imga{
         background-color:#1e1e1e; 
       }
    .fuerte{
        background:#1e1e1e;
        color:white;
    }

    </style>
  </head>
    <?php
    $serverName = "localhost";
    $connectionInfo = array( "Database"=>"prueba", "UID"=>"sa", "PWD"=>"Naruto10");
    $conn = sqlsrv_connect( $serverName, $connectionInfo );
    ?>
  <body>
    <h1> Reportes de Ganacias </h1>
    <?php
      $inicial = $_GET['inicial'];
      $final = $_GET['final'];
      $inicial = date("d/m/Y", strtotime($inicial));
      $final = date("d/m/Y", strtotime($final));
    ?>
    <h2> Del  <?= $inicial; ?> al <?= $final; ?> </h2>
    <?php  
    
      $inicial = $_GET['inicial'];
      $final = $_GET['final'];
      $sql_dos = "select f.num_factura,fecha,nombre_consulta,precio from factura f inner join detalle_fac d 
          on f.num_factura = d.num_factura where fecha BETWEEN '$inicial' and '$final'";

      $stmt_dos = sqlsrv_query( $conn, $sql_dos );
    ?>
    <table border=1>
        <tr class="fuerte">
          <td><strong>ID Consulta</strong></td>
          <td><strong>Fecha</strong></td>
          <td><strong>Asunto</strong></td>
          <td><strong>Precio</strong></td>
          </tr>
        <?php
        $cont = 0;
        while($row = sqlsrv_fetch_array( $stmt_dos, SQLSRV_FETCH_ASSOC) ){
        echo  "<tr>";
        echo  "<td>".$row['num_factura']."</td>";
        echo  "<td>".$row['fecha']->format('d-m-y')."</td>";
        echo  "<td>".$row['nombre_consulta']."</td>";
        echo  "<td>".$row['precio']."</td>";
        echo  "</tr>";
        $cont = $cont+$row['precio'];
        
        }
        sqlsrv_free_stmt($stmt); 
        ?>
    <tr width="1000px"><th><strong style="color:red">Total: Q.</strong> <?= $cont ?></th></tr>
    </table>
  </body>
</html>
