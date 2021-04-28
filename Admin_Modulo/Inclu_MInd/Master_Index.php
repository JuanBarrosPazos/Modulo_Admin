<?php

	require $rutaindex.'Inclu/mydni.php';
	//require 'Inclu/error_hidden.php';
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
						<a href='#' style='background-color: #343434;padding-bottom: 170px;'></a>
					</li>
				</ul>
			</li>");
	}else{
	
	print("<li>
				<a href='#'>
					<i class='ic ico22'></i>
				</a>
			</li>
			");
	
	} // Fin condicional web master

	print("<li>
				<a href='#'>
					<i class='ic ico13'></i><span>EMPLEADOS</span>
				</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Admin_Ver.php'>
						<i class='ic ico15b'></i>CONSULTAR
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Admin_Crear.php'>
						<i class='ic ico14b'></i>CREAR
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Admin_Modificar_01.php'>
						<i class='ic ico02b'></i>MODIFICAR
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Admin_Borrar_01.php'>
						<i class='ic ico19b'></i>DAR DE BAJA
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Feedback_Ver.php'>
						<i class='ic ico19b'></i>VER BAJAS
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Feedback_Admin_Recuperar_01.php'>
						<i class='ic ico19b'></i>RECUPER. BAJAS
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Feedback_Admin_Borrar_01.php'>
						<i class='ic ico19b'></i>BORRAR BAJAS
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='#'>
			<i class='ic ico12'></i><span>CATEGORIA 1</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 31px;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico13b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 36px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='#'>
				<i class='ic ico19'></i><span>CATEGORIA 2</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 59px;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 4px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='#'>
				<i class='ic ico10'></i><span>CATEGORIA 3</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 86px;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico10b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico10b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 60px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='#'>
				<i class='ic ico02'></i><span>CATEGORIA 4</span>
			</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 114px;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 4px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='#'>
				<i class='ic ico20'></i><span>CATEGORIA 5</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 141px;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico20b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico20b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 4px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='".$rutaindex."Mail_Php/index.php' target='_blank'>
				<i class='ic ico16'></i>NOTIFICACIONES
			</a>
		</li>
	
	<li>
		<a href='#'>
			<form name='cerrar' action='".$rutaadmin."mcgexit.php' method='post'>
				<i class='ic ico01'></i>
		<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:6px;' />
		<input type='hidden' name='cerrar' value=1 />
			</form>
		</a>
	</li>
				</ul>
			</nav>
		</aside>
	</section>
</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL ADMIN
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");
	
	} elseif ($_SESSION['Nivel'] == 'plus') {
						
	global $niv;
	$niv = 'Usuario Plus';

		print("

<div style='clear:both'></div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL PLUS
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");

require $rutaindex.'Inclu_MInd/Master_Index_Header.php';

print("<nav class='sidebar-nav'>
		<ul>
	
		<li>
			<a href='".$rutaadmin."Admin_Modificar_01.php'>
				<i class='ic ico02b'></i>MODIFICAR DATOS
			</a>
		</li>
	
	<li>
		<a href='#'>
			<i class='ic ico12'></i><span>CATEGORIA 1</span>
		</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico13b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 86px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='".$rutaindex."Mail_Php/index.php' target='_blank'>
				<i class='ic ico16'></i>NOTIFICACIONES
			</a>
		</li>
	
		<li>
			<a href='#'>
				<form name='cerrar' action='".$rutaadmin."mcgexit.php' method='post'>
					<i class='ic ico01'></i>
			<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:6px;' />
			<input type='hidden' name='cerrar' value=1 />
				</form>
			</a>
		</li>
	
				</ul>
			</nav>
		</aside>
	</section>
</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL PLUS
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");

	}elseif ($_SESSION['Nivel'] == 'user') {
						
	global $niv;
	$niv = 'Usuario';

		print("

<div style='clear:both'></div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						   INICIO NIVEL USER
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");

require $rutaindex.'Inclu_MInd/Master_Index_Header.php';

print("<nav class='sidebar-nav'>
		<ul>
	
	<li>
		<a href='".$rutaadmin."Admin_Modificar_01.php'>
			<i class='ic ico02b'></i>MODIFICAR DATOS
		</a>
	</li>
	
	<li>
		<a href='#'>
			<i class='ic ico12'></i><span>CATEGORIA 1</span>
		</a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='background-color: #343434;'>
						<i class='ic'></i>
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico13b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#' style='background-color: #343434;padding-bottom: 142px;'>
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='".$rutaindex."Mail_Php/index.php' target='_blank'>
				<i class='ic ico16'></i>NOTIFICACIONES
			</a>
		</li>
	
		<li>
			<a href='#'>
				<form name='cerrar' action='".$rutaadmin."mcgexit.php' method='post'>
					<i class='ic ico01'></i>
			<input type='submit' value='CLOSE SESSION'  style='margin-top:-2px; margin-left:6px;' />
			<input type='hidden' name='cerrar' value=1 />
				</form>
			</a>
		</li>
	
				</ul>
			</nav>
		</aside>
	</section>
</div>

<!--
						////////////////////
		////////////////////			////////////////////
						////////////////////

						  FIN NIVEL USER
							
						////////////////////
		////////////////////			////////////////////
						////////////////////
-->

");
	
	} 
	
/* Creado por Juan Barros Pazos 2020 */
?>