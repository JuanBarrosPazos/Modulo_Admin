<?php

	global $db;
    global $db_name;

mysqli_report(MYSQLI_REPORT_OFF);
$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if (!$db){ /*die*/ ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
            }
            
?>