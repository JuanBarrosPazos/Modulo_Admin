<?php


						/////////////////////////////
/////////////////////////////				/////////////////////////////
					/////////////////////////////

// VARIABLES PARA LAS META

// <title>php print($meta_titulo);</title>
global $meta_titulo;
$meta_titulo = "Juan Manuel Barros Pazos";

// <title>php print($meta_titulo);</title>
global $meta_titulo_contac;
$meta_titulo_contac = "Juan Manuel Barros Pazos";

// <meta name="description" content="" />
global $meta_desc_cotent;
$meta_desc_cotent = "Modulo Administrador";

// <meta name="keywords" content="" />
global $meta_key_cotent;
$meta_key_cotent = "Juan Barros Pazos, Programas gratis, Spain, Mallorca, Palma de Mallorca";

// <meta name="Language" content="Spanish">
global $meta_lang_cotent;
$meta_lang_cotent = "Spanish";

// <meta http-equiv="Content-Language" content="es-es">
global $meta_lang_cotent2;
$meta_lang_cotent2 = "es-es";

// <meta http-equiv="content-type" content="text/html" charset="utf-8" />
global $meta_type_charset;
$meta_type_charset = "utf-8";

// <meta name="robots" content="all, index, follow" />
global $meta_robots_cotent;
$meta_robots_cotent = "all, index, follow";

// <meta name="audience" content="All" />
global $meta_audience_cotent;
$meta_audience_cotent = "All";


						/////////////////////////////
/////////////////////////////				/////////////////////////////
					/////////////////////////////

// VARIABLES PARA EL HEADER Y FOOTER 

// Titulo header page
global $head_titulo;
$head_titulo = "JUAN BARROS PAZOS";

// Titulo 2 header page
global $head_titulo2;
$head_titulo2 = "Design & Programming in Palma de Mallorca";

// Titulo Contactos header page
global $head_titulo3;
$head_titulo3 = "Design & Programming in Palma de Mallorca";

// Direccion header page
global $head_direc;
$head_direc = "Palma de Mallorca";

// Email header page
global $head_email;
$head_email = "JuanBarrosPazos@hotmail.es";

// Telefono header page
global $head_telef;
$head_telef = "Tlf: +69.696969696";

// Titulo footer page
global $head_footer;
$head_footer = "&copy; Juan Barr&oacute;s Pazos 2020.";


						/////////////////////////////
/////////////////////////////				/////////////////////////////
					/////////////////////////////


// VARIABLES PARA LA FUNCION MAIL ACCESO AL SISTEMA.

// mime from
global $mail_from;
//$mail_from = 'juanbarrospazos@hotmail.es';
$mail_from = isset($_SESSION['Email']);
$_SESSION['mail_from'] = $mail_from;

// mime destinatario
// Web Master Mail
global $mail_destin;
$mail_destin = 'juanbarrospazos@hotmail.es';
$_SESSION['mail_destin'] = $mail_destin;

// mime responder a
global $mail_respon;
//$mail_respon = 'juanbarrospazos@hotmail.es';
$mail_respon = isset($_SESSION['Email']);
$_SESSION['mail_respon'] = $mail_respon;

// mime remite
global $mail_admin;
$mail_admin = 'juanbarrospazos@hotmail.es';
$_SESSION['mail_admin'] = $mail_admin;

// mime remitente
global $admin_url;
//$admin_url = 'http://juanbarrospazos.blogspot.com.es/';
$admin_url = isset($_SESSION['Nombre'])." ".isset($_SESSION['Apellidos']);
$_SESSION['admin_url'] = $admin_url;


						/////////////////////////////
/////////////////////////////				/////////////////////////////
					/////////////////////////////

// SE UTILIZA EL ARCHIVO nemp.php
// $_SESSION['nuser'] = 10;

						/////////////////////////////
/////////////////////////////				/////////////////////////////
					/////////////////////////////

/* Creado por Juan Barros Pazos 2020 */

?>