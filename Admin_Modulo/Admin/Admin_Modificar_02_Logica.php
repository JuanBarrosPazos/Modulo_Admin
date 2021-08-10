<?php

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

	//master_index();

	if (isset($_POST['oculto2'])){
		show_form();
		info_01();
		}
	elseif($_POST['modifica']){
			if($form_errors = validate_form()){
				show_form($form_errors);
					} else {
						process_form();
						info_02();
						unset($_SESSION['refcl']);
						}
		} else { show_form(); }
	} else { require '../Inclu/table_permisos.php'; }

?>