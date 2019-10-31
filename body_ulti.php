<!DOCTYPE html>
<?php
    include('conexion.php');
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
    <h1>Reporte de Consultas</h1> 
    <?php
      $inicial = $_GET['init'];
      $final = $_GET['end'];
      $inicial = date("d/m/Y", strtotime($inicial));
      $final = date("d/m/Y", strtotime($final));
    ?>
    <h2> Del  <?= $inicial; ?> al <?= $final; ?> </h2>
    <?php  
    
      $inicial = $_GET['init'];
      $final = $_GET['end'];
      $sql_dos = "select e.id_expediente, concat(primer_nombre,' ',segundo_nombre,' ', primer_apellido,' ', segundo_apellido) as nombre, c.asunto,
       c.fecha from paciente p inner join expediente e on p.id_paciente = e.id_paciente
      inner join consulta c ON c.id_expediente = e.id_expediente where c.fecha BETWEEN '$inicial' and '$final'";

      $stmt_dos = sqlsrv_query( $conn, $sql_dos );
    ?>
    <table border=1>
        <tr class="fuerte">
          <td width="50"><strong>Expediente</strong></td>
          <td width="150"><strong>Nombre</strong></td>
          <td width="150"><strong>Asunto</strong></td>
          <td width="50"><strong>Fecha</strong></td>
          </tr>
        <?php
        while($row = sqlsrv_fetch_array( $stmt_dos, SQLSRV_FETCH_ASSOC) ){
        echo  "<tr>";
        echo  "<td>".$row['id_expediente']."</td>";
        echo  "<td>".$row['nombre']."</td>";
        echo  "<td>".$row['asunto']."</td>";
        echo  "<td>".$row['fecha']->format('d-m-y')."</td>";
        echo "</tr>";
        
        }
        sqlsrv_free_stmt($stmt); 
        ?>
    </table>

  </body>

</html>
