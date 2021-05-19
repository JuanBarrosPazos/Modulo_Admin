<?php
	global $formularioh;
	$formularioh = "<td colspan=7 align='center' class='BorderInf'>
				<form style=\"display:inline-block;\" name='modifica' action='".@$ruta."Admin_Modificar_02.php' method='POST'>";

	global $formulariof;
	$formulariof = "
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='oculto2' value=1 />
				</form>";

	global $formulariohg;
	$formulariohg = "<form style=\"display:inline-block;\" name='modifica_img' action='".@$ruta."Admin_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=540px,height=470px')\">";

	global $formulariofg;
	$formulariofg = "<input type='submit' value='MODIFICAR IMAGEN'/>
					 <input type='hidden' name='oculto2' value=1 />
						</form>";

	if($_SESSION['Nivel'] == 'admin'){
	global $formulariohi;
	$formulariohi = "<form style=\"display:inline-block;\" name='borra' action='".@$ruta."Admin_Borrar_02.php' method='POST'>";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='DAR DE BAJA' />
						<input type='hidden' name='oculto2' value=1 />
				</form>";
	} else {	
		global $formulariohi;
		$formulariohi = "";
			
		global $formulariofi;
		$formulariofi = "";
		}
	
	global $formulariohe;
	$formulariohe = "<form style=\"display:inline-block;\" name='ver' action='".@$ruta."Admin_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=420px,height=580px')\">";

	global $formulariofe;
	$formulariofe = "<input type='submit' value='VER DETALLES' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
					</td>";


?>