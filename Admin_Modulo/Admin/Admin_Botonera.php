<?php

if (@$_SESSION['Nivel'] == 'admin') { 

    global $inicioadmin;
    $inicioadmin ="<form name='boton' action='Admin_Ver.php' method='post' style='display: inline-block;' >
                        <input type='submit' value='INICIO ADMIN GESTION' class='botonazul' />
                        <input type='hidden' name='volver' value=1 />
                    </form>";

    global $iniciobajas;
    $inciobajas ="<form name='boton' action='Feedback_Ver.php' method='post' style='display: inline-block;' >
                        <input type='submit' value='INICIO ADMIN BAJAS' class='botonazul' />
                        <input type='hidden' name='volver' value=1 />
                    </form>";

    global $inicioadmincrear;
    $inicioadmincrear ="<form name='boton' action='Admin_Crear.php' method='post' style='display: inline-block;' >
                            <input type='submit' value='ADMIN CREAR' class='botonazul' />
                            <input type='hidden' name='volver' value=1 />
                        </form>";
    } else { global $inicioadmin; $inicioadmin ="";
             global $iniciobajas; $inciobajas ="";
             global $inicioadmincrear; $inicioadmincrear ="";
                }

    global $closewindow;
    $closewindow = "<form name='closewindow' action='$_SERVER[PHP_SELF]' onsubmit=\"window.close()\">
                        <input type='submit' value='CERRAR VENTANA' class='botonrojo' />
                        <input type='hidden' name='closewin' value=1 />
                    </form>
                    ";
?>