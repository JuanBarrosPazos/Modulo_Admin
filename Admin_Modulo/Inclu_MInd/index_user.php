<?php

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
		<a href='".$rutaadmin."Admin_Ver.php'>
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
					<a href='#' style='background-color: #343434;padding-bottom: 147px;'>
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

?>