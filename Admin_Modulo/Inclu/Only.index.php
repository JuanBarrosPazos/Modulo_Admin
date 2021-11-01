<?php


if((isset($_POST['Usuario'])&&(isset($_POST['Password'])))){

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sql =  "SELECT * FROM $table_name_a WHERE `Usuario` = '$_POST[Usuario]' AND `Pass` = '$_POST[Password]'";
	$q = mysqli_query($db, $sql);
	global $row;
	$row = mysqli_fetch_assoc($q);
	global $countq;
	$countq = mysqli_num_rows($q);
	global $userid;
	global $uservisita;

	if($countq < 1){ }
	elseif(password_verify($_POST['Password'], $row['Password'])){
	$_SESSION['id'] = $row['id'];
	$_SESSION['ref'] = $row['ref'];
	$_SESSION['Nivel'] = $row['Nivel'];
	$_SESSION['Nombre'] = $row['Nombre'];
	$_SESSION['Apellidos'] = $row['Apellidos'];
	$_SESSION['myimg'] = $row['myimg'];
	$_SESSION['dni'] = $row['dni'];
	$_SESSION['Email'] = $row['Email'];
	$_SESSION['Usuario'] = $row['Usuario'];
	$_SESSION['Password'] = $row['Password'];
	$_SESSION['Pass'] = $row['Pass'];
	$_SESSION['Direccion'] = $row['Direccion'];
	$_SESSION['Tlf1'] = $row['Tlf1'];
	$_SESSION['Tlf2'] = $row['Tlf2'];
	$_SESSION['lastin'] = $row['lastin'];
	$_SESSION['lastout'] = $row['lastout'];
	$_SESSION['visitadmin'] = $row['visitadmin'];

	$userid = $_SESSION['id'];
	$uservisita = $_SESSION['visitadmin'];

	global $onlyindex;
	$onlyindex = 1;

			// VERIFICO EL HASH DEL PASSWORD RETORNA BOOLEAN
			// password_verify(PRIMER ARGUMENTO EL PASSWORD, SEGUNDO EL HASH){}else{}
				/* 	
					if(password_verify($_POST['Password'], $row['Password'])){
						//echo "* EL PASSWORD ES VÁLIDO";
					} else {
						//echo "* EL PASSWORD NO ES CORRECTO";
					}
				*/		
			// FIN VERIFICACIÓN HASH BOOLEAN.

		}// FIN ELSEIF password_verify BOOLEAN OK
		else { } // SI NO password_verify
}// FIN IF ISSET

/* Creado por Juan Barros Pazos 2021 */

?>