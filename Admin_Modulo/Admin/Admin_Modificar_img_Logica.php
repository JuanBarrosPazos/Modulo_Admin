<?php

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

    //print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".</br>");
           
       if (isset($_POST['oculto2'])){ show_form();
                                      info_01();
                               }
                       elseif($_POST['imagenmodif']){
                               if($form_errors = validate_form()){
                                   show_form($form_errors);
                                       } else { process_form();
                                                info_02();
                                                   }
                           } else { show_form(); }
       } else { require '../Inclu/table_permisos.php'; }

?>