<?php

$connectionInfo = array("UID" => "clinica", "pwd" => "umg$1818", "Database" => "dbclinica", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:mssqlcli.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

?>

