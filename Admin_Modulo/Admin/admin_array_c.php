<?php

	$defaults = array ( 'id' => $_POST['id'],
						'Nombre' => $_POST['Nombre'],
						'Apellidos' => $_POST['Apellidos'],
						'ref' =>  $_SESSION['sref'],
						'myimg' => isset($_POST['myimg']),
						'Nivel' => $_POST['Nivel'],
					    'doc' => $_POST['doc'],
						'dni' => $_POST['dni'],
						'ldni' => $_POST['ldni'],
						'Email' => $_POST['Email'],
						'Usuario' => $_POST['Usuario'],
						'Usuario2' => $_POST['Usuario'],
						'Password' => $_POST['Password'],
						'Password2' => $_POST['Password'],
						'Pass' => $_POST['Pass'],
						'Direccion' => $_POST['Direccion'],
						'Tlf1' => $_POST['Tlf1'],
						'Tlf2' => $_POST['Tlf2']);


?>