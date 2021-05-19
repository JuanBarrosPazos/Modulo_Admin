<?php

	require $rutaindex.'Inclu/mydni.php';
	require $rutaindex.'Inclu/error_hidden.php';
	global $db_name;

	if (($_SESSION['Nivel'] == 'admin')&&($_SESSION['dni'] == $_SESSION['mydni'])) {

		global $topcat0;
		$topcat0 = "style='margin-top:31px'";
		global $topcat1;
		$topcat1 = "style='margin-top:62px'";
		global $topcat2;
		$topcat2 = "style='margin-top:94px'";
		global $topcat3;
		$topcat3 = "style='margin-top:126px'";
		global $topcat4;
		$topcat4 = "style='margin-top:158px'";
		global $topcat5;
		$topcat5 = "style='margin-top:189px'";

	}else{

		global $topcat0;
		$topcat0 = "";
		global $topcat1;
		$topcat1 = "style='margin-top:31px'";
		global $topcat2;
		$topcat2 = "style='margin-top:62px'";
		global $topcat3;
		$topcat3 = "style='margin-top:94px'";
		global $topcat4;
		$topcat4 = "style='margin-top:126px'";
		global $topcat5;
		$topcat5 = "style='margin-top:158px'";

	}


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
	<nav class='sidebar-nav'>
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
				</ul>
			</li>");

		require 'index_admin.php';

	}else{

		require 'index_admin.php';

	} // Fin condicional web master
	
	} elseif ($_SESSION['Nivel'] == 'plus') {
						
	global $niv;
	$niv = 'Usuario Plus';
	
	require $rutaindex.'Inclu_MInd/Master_Index_Header.php';
		print("<nav class='sidebar-nav'><ul>");
	require 'index_admin.php';

	}elseif ($_SESSION['Nivel'] == 'user') {
						
	global $niv;
	$niv = 'Usuario';

	require $rutaindex.'Inclu_MInd/Master_Index_Header.php';
		print("<nav class='sidebar-nav'><ul>");
	require 'index_admin.php';
	} 
	
/* Creado por Juan Barros Pazos 2021 */
?>