<?php

    global $ruta;
    global $rutacam;
    
    global $db;
    global $db_name;

    global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

    $sqlu =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`ref` = '$_GET[pin]' ";
    $qpu = mysqli_query($db, $sqlu);
    global $contu;
    $contu = mysqli_num_rows($qpu);
    global $rowu;
    $rowu = mysqli_fetch_assoc($qpu);

?>