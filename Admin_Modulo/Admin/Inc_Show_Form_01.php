<?php

    if(isset($_POST['ocultoc'])){
        $defaults = $_POST;
        $_SESSION['Orden'] = @$_POST['Orden'];
        }
    elseif(isset($_POST['todo'])){
        $defaults = $_POST;
        $_SESSION['Orden'] = $_POST['Orden'];
    } 
    elseif ((isset($_GET['page'])) || (isset($_POST['page']))) {
        @$defaults['Orden'] = $_SESSION['Orden'];
    }
    else {  $defaults = array (	'Nombre' => '',
                                'Apellidos' => '',
                                'Orden' => '`id` ASC');
            $_SESSION['Orden'] = '`id` ASC';
                         }

if ($errors){
    print("	<table align='center'>
                <tr>
                    <th style='text-align:center'>
                        <font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
                    </th>
                </tr>
                <tr>
                <td style='text-align:left'>");
        
            for($a=0; $c=count($errors), $a<$c; $a++){
                print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
                }
    print("</td>
            </tr>
            </table>");
                }
    
$ordenar = array (	'`id` ASC' => 'ID Ascen',
                    '`id` DESC' => 'ID Descen',
                    '`Nombre` ASC' => 'Nombre Ascen',
                    '`Nombre` DESC' => 'Nombre Descen',
                    '`Apellidos` ASC' => 'Apellido Ascen',
                    '`Apellidos` DESC' => 'Apellido Descen',
                    '`Email` ASC' => 'Email Ascen',
                    '`Email` DESC' => 'Email Descen',);

if (($_SESSION['Nivel'] == 'admin')){ 

print(" <table align='center' style=\"margin-top:12px\">
            <tr>
                <th colspan=3 class='BorderInf'>".$titulo."</th>
            </tr>
            
    <form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
                    
            <tr>
                <td style='text-align:right !important;'>
                    <input type='submit' value='FILTRO' class='botonazul' />
                    <input type='hidden' name='ocultoc' value=1 />
                </td>
                <td style='text-align:right !important;'>	
                    NOMBRE
                </td>
                <td style='text-align:left !important;'>
        <input type='text' name='Nombre' size=20 maxlenth=10 value='".@$defaults['Nombre']."' />
                </td>
            </tr>

            <tr>
                <td>
                </td>
                <td style='text-align:right !important;'>	
                    APELLIDO
                </td>
                <td style='text-align:left !important;'>
<input type='text' name='Apellidos' size=20 maxlenth=10 value='".@$defaults['Apellidos']."' />
                </td>
            </tr>
    </form>	
            
    <form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
            <tr>
                <td style='text-align:right;'>
                    <input type='submit' value='".$boton."' class='botonazul' />
                    <input type='hidden' name='todo' value=1 />
                </td>
                <td style='text-align:right !important;'>	
                    ORDEN
                </td>
                <td>
                    <select name='Orden'>");
                    
            foreach($ordenar as $option => $label){
                
                print ("<option value='".$option."' ");
                
                if($option == @$defaults['Orden']){ print ("selected = 'selected'"); }
                                                print ("> $label </option>");
                                            }	
        print ("	</select>
                        </td>
                    </tr>
            </form>														
        </table>");
                }	// CONDICIONAL NIVEL ADMIN

?>