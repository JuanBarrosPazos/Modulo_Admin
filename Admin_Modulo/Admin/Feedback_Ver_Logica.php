<?php

if ($_SESSION['Nivel'] == 'admin'){

    master_index();

    if(@$_POST['todo']){ show_form();							
                        ver_todo();
                        info();
                        }
                            
    elseif(@$_POST['oculto']){
            if($form_errors = validate_form()){
                            show_form($form_errors);
                        } else {process_form();
                                info();
                                }
                            }

    elseif ((isset($_GET['page'])) || (isset($_POST['page']))) {
                                        show_form();
                                        ver_todo();
                                    }

    else {show_form();
          ver_todo();
            }

    } else { require '../Inclu/table_permisos.php'; }

?>