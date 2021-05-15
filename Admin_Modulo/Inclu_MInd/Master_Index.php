<?php

	require $rutaindex.'Inclu/mydni.php';
	require $rutaindex.'Inclu/error_hidden.php';
	global $db_name;

	if ($_SESSION['Nivel'] == 'admin') {	
		
			if ($_SESSION['dni'] == $_SESSION['mydni']) { global $niv;
														  $niv = 'Web Master';
												}else{	global $niv;
														$niv = 'Administrador';
														}
	require $rutaindex.'Inclu_MInd/Master_Index_Header.php';
	
	print("
	<!--
							////////////////////
			////////////////////			////////////////////
							////////////////////

							INICIO NIVEL ADMIN
								
							////////////////////
			////////////////////			////////////////////
							////////////////////
	-->
	");

print("<nav class='sidebar-nav'>
		<ul>");

if ($_SESSION['dni'] == $_SESSION['mydni']) {
	
	print("<li>
			<a href='#'>
				<i class='ic ico22'></i><span>WEB MASTER</span>
			</a>
				<ul class='nav-flyout'>
					<li>
						<a href='".$rutainclu."cnemp.php'>
							<i class='ic ico22'></i>Nª EMPLEADOS
						</a>
					</li>
					<li>
						<a href='#'>
							<i class='ic ico22'></i>OTRO LINK
						</a>
					</li>
					<li>
						<a href='#' style='background-color: #343434;padding-bottom: 173px;'></a>
					</li>
				</ul>
			</li>");

		require 'index_wmaster.php';

	}else{

		require 'index_admin.php';

	} // Fin condicional web master
	
	} elseif ($_SESSION['Nivel'] == 'plus') {
						
	global $niv;
	$niv = 'Usuario Plus';

		require 'index_plus.php';

	}elseif ($_SESSION['Nivel'] == 'user') {
						
	global $niv;
	$niv = 'Usuario';

		require 'index_user.php';
	} 
	
/* Creado por Juan Barros Pazos 2021 */
?>