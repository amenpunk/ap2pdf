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


    </style>  

  </head>
  <body>
    <h1>Reporte de Citas</h1>
    <?php
      $inicial = $_GET['cita_inicial'];
      $final = $_GET['cita_final'];
      $inicial = date("d/m/Y", strtotime($inicial));
      $final = date("d/m/Y", strtotime($final));
    ?>
    <h2> Del  <?= $inicial; ?> al <?= $final; ?> </h2>
    <?php  
    
      $inicial = $_GET['cita_inicial'];
      $final = $_GET['cita_final'];
      $sql_dos = "
      select fecha_inicio,estado,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido from cita c inner join paciente p
      ON c.id_paciente = p.id_paciente
      where fecha_inicio BETWEEN '$inicial' and '$final'";
      
      $stmt_dos = sqlsrv_query( $conn, $sql_dos );
    ?>

    <table border=1>
        <tr class="fuerte">
          <td><strong>Nombre</strong></td>
          <td><strong>Estado</strong></td>
          <td><strong>Fecha</strong></td>
          </tr>
        <?php
        while($row = sqlsrv_fetch_array( $stmt_dos, SQLSRV_FETCH_ASSOC) ){
        echo  "<tr>";
        echo  "<td>".$row['primer_nombre']." ".$row['segundo_nombre'] ." ".$row['primer_apellido'] ." ".$row['segundo_apellido'] ."</td>";

        //echo  "<td>".$row['estado']."</td>";

        switch ($row['estado']) {
        case 1:
            echo "<td>Pendiente</td>";
                break;
        case 2:
            echo "<td>Confirmada</td>";
                break;
        case 3:
            echo "<td>Aún no Confirmada</td>";
            break;
        case 4:
            echo "<td>En sala de espera</td>";
            break;
        case 5:
            echo "<td>En consulta</td>";
            break;
        case 6:
            echo "<td>Atendida</td>";
            break;
        case 7:
            echo "<td>Cancelada</td>";
            break;
        case 7:
            echo "<td>Aun no confirmada</td>";
            break;
        
        default:
            echo "<td></td>";
        }

        echo  "<td>".$row['fecha_inicio']->format('d-m-y')."</td>";
        echo  "</tr>";
        
        }
        sqlsrv_free_stmt($stmt); 
        ?>
    </table>
  </body>
</html>
