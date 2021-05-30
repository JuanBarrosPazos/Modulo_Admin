<?php

//$a = $_SESSION['Nombre'][0]." ".$_SESSION['Apellidos'];
$a = $_SESSION['Nombre']." ".$_SESSION['Apellidos'];
global $usertitle;
$usertitle = substr($a,0,18);
print ("
<div style='clear:both'></div>

<div class='MenuVertical'>

<section class='app'>

<aside class='sidebar'>

	<header style='text-align:center'>
    <!--    -->
    <img class='imgtitle' src='".$rutaindex."Users/".$_SESSION['ref']."/img_admin/".$_SESSION['myimg']."' />
    <div class='ocultahead'>
        ".$usertitle."</br>
        ".$niv."</br>
    </div>
        <a href='#' class='ocultahead'>
            <form name='cerrar' action='".$rutaadmin."mcgexit.php' method='post'>
                <input type='submit' value='CLOSE SESSION'  style='margin-top:2px;' class='botonverde' />
                <input type='hidden' name='cerrar' value=1 />
            </form>
        </a>

 <a href='#'><i class='ic icoh ocultahead'></i>
		<span class='borderhead' style='color:#FFFFFF;vertical-align:middle'>MENU APP</span>
 </a>
    </header>
    ");
    
?>