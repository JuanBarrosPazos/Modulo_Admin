<?php

$errors = array();
	
if ( (strlen(trim($_POST['Nombre'])) == 0) && (strlen(trim($_POST['Apellidos'])) == 0) ){
    $errors [] = " <font color='#FF0000'>UNO DE LOS DOS CAMPOS OBLIGATORIO</font>";
    }

elseif (!preg_match('/^[a-z A-Z \s]*$/',$_POST['Nombre'])){
    $errors [] = "<font color='#FF0000'>¡¡ CARÁCTERES NO VALIDOS !!</font>";
    }

elseif (!preg_match('/^[a-z A-Z \s]*$/',$_POST['Apellidos'])){
    $errors [] = "<font color='#FF0000'>¡¡ CARÁCTERES NO VALIDOS !!</font>";
    }

?>