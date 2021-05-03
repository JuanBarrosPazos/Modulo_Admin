<?php

	$errors = array();
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: <font color='#FF0000'>MAS DE 3 CARACTERES</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: <font color='#FF0000'>MAS DE 3 CARACTERES</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: <font color='#FF0000'>MAS DE 3 CARACTERES</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: <font color='#FF0000'>MAS DE 3 CARACTERES</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}
		
	elseif (!preg_match('/^[a-z 0-9 !¡?¿\._]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}


	if(strlen(trim($_POST['clave'])) == 0){
		$errors [] = "CLAVE: <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
		}
	
	elseif (strlen(trim($_POST['clave'])) < 3){
		$errors [] = "CLAVE: <font color='#FF0000'>MAS DE 2 CARACTERES</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};, !¡?¿\._:\*\s]+$/',$_POST['clave'])){
		$errors [] = "CLAVE: <font color='#FF0000'>CARACTERES NO VALIDOS</font>";
		}
		
	elseif (!preg_match('/^[a-z 0-9]+$/',$_POST['clave'])){
		$errors [] = "CLAVE: <font color='#FF0000'>MINUSCULAS Y NUMEROS</font>";
		}

?>