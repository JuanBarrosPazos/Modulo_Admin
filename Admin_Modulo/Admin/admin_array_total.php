<?php

if(isset($array_cero)){
    $defaults = array ( 'Nombre' => '',
                        'Apellidos' => '',
                        'Nivel' => '',
                        'ref' => '',
                        'doc' => '',
                        'dni' => '',
                        'ldni' => '',
                        'Email' => 'Solo letras minúsculas',
                        'Usuario' => '',
                        'Usuario2' => '',
                        'Password' => '',
                        'Password2' => '',
                        'Direccion' => '',
                        'Tlf1' => '',
                        'Tlf2' => '');
} elseif(isset($array_defaults)) { 
    $defaults = array ( 'id' => $defaults['id'],
						'ref' => $defaults['ref'],
						'Nombre' => $defaults['Nombre'],
						'Apellidos' => $defaults['Apellidos'],
						'myimg' => $defaults['myimgcl'],
						'Nivel' => $defaults['Nivel'],			
						'doc' => $defaults['doc'],
						'dni' => $defaults['dni'],
						'ldni' => $defaults['ldni'],
						'Email' => $defaults['Email'],
						'Usuario' => $defaults['Usuario'],
						'Usuario2' => $defaults['Usuario'],
						'Password' => $defaults['Pass'],
						'Password2' => $defaults['Pass'],
						'Direccion' => $defaults['Direccion'],
						'Tlf1' => $defaults['Tlf1'],
						'Tlf2' => $defaults['Tlf2']);
} elseif(isset($array_a)) {
    $defaults = array ( 'id' => $_POST['id'],
						'ref' => $_POST['ref'],
						'Nivel' => $_POST['Nivel'],
						'Nombre' => $_POST['Nombre'],
						'Apellidos' => $_POST['Apellidos'],
						'myimg' => $_POST['myimg'],
						'doc' => $_POST['doc'],
						'dni' => $_POST['dni'],
						'ldni' => $_POST['ldni'],
						'Email' => $_POST['Email'],
						'Usuario' => $_POST['Usuario'],
						'Password' => $_POST['Password'],
						'Pass' => $_POST['Pass'],
						'Direccion' => $_POST['Direccion'],
						'Tlf1' => $_POST['Tlf1'],
						'Tlf2' => $_POST['Tlf2'],
						'lastin' => $_POST['lastin'],
						'lastout' => $_POST['lastout'],
						'visitadmin' => $_POST['visitadmin'],
						'borrado' => $_POST['borrado'],);
} elseif(isset($array_b)) {
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
} elseif(isset($array_c)) { 
	$defaults = array ( 'id' => $_POST['id'],
						'Nombre' => $_POST['Nombre'],
						'Apellidos' => $_POST['Apellidos'],
						'ref' =>  $_SESSION['sref'],
						'myimg' => $_POST['myimg'],
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

} else { }

if(isset($array_nive_doc)){

		if(isset($config2)){ $Nivel = array ('' => 'NIVEL USUARIO',
											 'admin' => 'ADMINISTRADOR',);
		} else { $Nivel = array ('' => 'NIVEL USUARIO',
								 'admin' => 'ADMINISTRADOR',
								 'plus' => 'USER PLUS',
								 'user' => 'USER',
								 'close' => 'CLOSE', );														
 					}

  $doctype = array ('DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
					'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
					/*
					'NIFsa' => 'NIF Sociedad An&oacute;nima',
					'NIFsrl' => 'NIF Sociedad Responsabilidad Limitada',
					'NIFscol' => 'NIF Sociedad Colectiva',
					'NIFscom' => 'NIF Sociedad Comanditaria',
					'NIFcbhy' => 'NIF Comunidad Bienes y Herencias Yacentes',
					'NIFscoop' => 'NIF Sociedades Cooperativas',
					'NIFasoc' => 'NIF Asociaciones',
					'NIFcpph' => 'NIF Comunidad Propietarios Propiedad Horizontal',
					'NIFsccspj' => 'NIF Sociedad Civil, con o sin Personalidad Juridica',
					'NIFee' => 'NIF Entidad Extranjera',
					'NIFcl' => 'NIF Corporaciones Locales',
					'NIFop' => 'NIF Organismo Publico',
					'NIFcir' => 'NIF Congragaciones Instituciones Religiosas',
					'NIFoaeca' => 'NIF Organos Admin Estado y Comunidades Autonomas',
					'NIFute' => 'NIF Uniones Temporales de Empresas',
					'NIFotnd' => 'NIF Otros Tipos no Definidos',
					'NIFepenr' => 'NIF Establecimientos Permanentes Entidades no Residentes',
					*/
				);

} elseif(isset($array_nemp)) {	
				$nemp = array (	'' => 'EMPLEADOS PERMITIDOS',
								'1' => '<= 1 EMPLEADOS',
								'3' => '<= 3 EMPLEADOS',
								'5' => '<= 5 EMPLEADOS',
								'10' => '<= 10 EMPLEADOS',
								'20' => '<= 20 EMPLEADOS',
								'50' => '<= 50 EMPLEADOS',
								'100' => '<= 100 EMPLEADOS',
										);														
} else { }

?>