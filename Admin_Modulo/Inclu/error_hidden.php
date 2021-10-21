<?php
// Desactivar toda notificación de error
//error_reporting(0);

// Notificar solamente errores de ejecución
// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Notificar E_NOTICE también puede ser bueno (para informar de variables
// no inicializadas o capturar errores en nombres de variables ...)
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Notificar todos los errores excepto E_NOTICE
// Este es el valor predeterminado establecido en php.ini
//error_reporting(E_ALL ^ E_NOTICE);

// Notificar todos los errores de PHP (ver el registro de cambios)
// error_reporting(E_ALL);

// Notificar todos los errores de PHP
// error_reporting(-1);

// NO PASA NINGUN ERROR;

/* DESACTIVADO TEMPORALMENTE */
 error_reporting (0);


// Lo mismo que error_reporting(E_ALL);
// ini_set('error_reporting', E_ALL);

?>