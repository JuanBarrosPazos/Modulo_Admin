<?php

	$defaults = array ( 'id' => $_POST['id'],
						'ref' => $_SESSION['refcl'],
						'Nombre' => $_POST['Nombre'],
						'Apellidos' => $_POST['Apellidos'],
						'myimg' => $_SESSION['myimgcl'],
						'Nivel' => $_POST['Nivel'],			
						'doc' => $dt,
						'dni' => $_POST['dni'],
						'ldni' => $_POST['ldni'],
						'Email' => $_POST['Email'],
						'Usuario' => $_POST['Usuario'],
						'Usuario2' => $_POST['Usuario'],
						'Password' => $password,
						'Password2' => $password2,
						'Pass' => $_POST['Pass'],
						'Direccion' => $_POST['Direccion'],
						'Tlf1' => $_POST['Tlf1'],
						'Tlf2' => $_POST['Tlf2']);

?>