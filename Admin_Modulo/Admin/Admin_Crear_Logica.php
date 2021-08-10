<?php

if ($_SESSION['Nivel'] == 'admin'){

    master_index();

    if(isset($_POST['oculto'])){
            if($form_errors = validate_form()){
                    show_form($form_errors);
            } else { process_form(); }
    } else {show_form();}

} else { require '../Inclu/table_permisos.php'; } 

?>