<?php

if ($_SESSION['Nivel'] == 'admin'){

    master_index();

    if (@$_POST['oculto2']){ show_form();
                             info_01();
                            }
    elseif($_POST['modifica']){ process_form();
                                info_02();
                    } else {show_form();}
    } else { require '../Inclu/table_permisos.php'; }


?>