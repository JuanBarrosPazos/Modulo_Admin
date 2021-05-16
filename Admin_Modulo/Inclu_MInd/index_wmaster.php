<?php

	print("<li>
				<a href='#'>
					<i class='ic ico13'></i><span>EMPLEADOS</span>
				</a>
			<ul class='nav-flyout'>
				<li>
					<a href='".$rutaadmin."Admin_Ver.php' style='margin-top:31px'>
						<i class='ic ico15b'></i>GESTION ADMIN
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Admin_Crear.php'>
						<i class='ic ico14b'></i>CREAR ADMIN
					</a>
				</li>
				<li>
					<a href='".$rutaadmin."Feedback_Ver.php'>
						<i class='ic ico19b'></i>GESTION BAJAS
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
					<a href='#' style='margin-top:62px'>
						<i class='ic ico13b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico15b'></i>OTRO LINK
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
					<a href='#' style='margin-top:94px'>
						<i class='ic ico19b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico19b'></i>OTRO LINK
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
					<a href='#' style='margin-top:126px'>
						<i class='ic ico10b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico10b'></i>OTRO LINK
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
					<a href='#' style='margin-top:158px'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico02b'></i>OTRO LINK
					</a>
				</li>
			</ul>
		</li>
	
		<li>
			<a href='#'>
				<i class='ic ico20'></i><span>CATEGORIA 5</span></a>
			<ul class='nav-flyout'>
				<li>
					<a href='#' style='margin-top:189px'>
						<i class='ic ico20b'></i>OTRO LINK
					</a>
				</li>
				<li>
					<a href='#'>
						<i class='ic ico20b'></i>OTRO LINK
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

?>