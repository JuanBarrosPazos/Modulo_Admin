<?php
require 'Inclu/misdatos.php';
?>

<!DOCTYPE html>
	
<head>
	
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="content-type" content="text/html" charset="<?php print($meta_type_charset);?>" />
<meta http-equiv="Content-Language" content="<?php print($meta_lang_cotent2);?>">
<meta name="Language" content="<?php print($meta_lang_cotent);?>">
<meta name="description" content="<?php print($meta_desc_cotent);?>" />
<meta name="keywords" content="<?php print($meta_key_cotent);?>" />
<meta name="robots" content="<?php print($meta_robots_cotent);?>" />
<meta name="audience" content="<?php print($meta_audience_cotent);?>" />
<title><?php print($meta_titulo);?></title>
	
<link href="Css/conta.css" rel="stylesheet" type="text/css" />
<link href="Css/menu.css" rel="stylesheet" type="text/css" />
<link href="Css/menuico.css" rel="stylesheet" type="text/css" />

<script src="MenuVertical/SpryMenuBar.js" type="text/javascript"></script>
<link href="MenuVertical/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

<link href="Images/favicon.png" type='image/ico' rel='shortcut icon' />

<script type="text/javascript">

 function hora(){
 var fecha = new Date()
 
 var diames = fecha.getDate()

 var daytext = fecha.getDay()
 if (daytext == 0)
 daytext = "Domingo"
 else if (daytext == 1)
 daytext = "Lunes"
 else if (daytext == 2)
 daytext = "Martes"
 else if (daytext == 3)
 daytext = "Miercoles"
 else if (daytext == 4)
 daytext = "Jueves"
 else if (daytext == 5)
 daytext = "Viernes"
 else if (daytext == 6)
 daytext = "Sabado"
 
 var mes = fecha.getMonth() + 1
 
 var ano = fecha.getYear()
 
 if (fecha.getYear() < 2000) 
 ano = 1900 + fecha.getYear()
 else 
 ano = fecha.getYear()
 
 var hora = fecha.getHours()
 var minuto = fecha.getMinutes()
 var segundo = fecha.getSeconds()
 
 if(hora>=12 && hora<=23)
 m="P.M"
 else
 m="A.M"
 
 if (hora < 10) {hora = "0" + hora}
 if (minuto < 10) {minuto = "0" + minuto}
 if (segundo < 10) {segundo = "0" + segundo}
 
 var nowhora = daytext + " " + diames + " / " + mes + " / " + ano + " - " + hora + ":" + minuto + ":" + segundo
 document.getElementById('hora').firstChild.nodeValue = nowhora
 tiempo = setTimeout('hora()',1000)
 }
 </script>
	
<!--	
<style>
/* INICIO ESTILOS VENTANA FLOTANTE
	JUANBARROSPAZOS.BLOGSPOT*/

#ventana-flotante {
width: 400px;  /* Ancho de la ventana */
height: 80px;  /* Alto de la ventana */
background: #E4F1F1;  /* Color de fondo */
position: fixed;
top: 38%;
left: 16%;
margin-left: -180px;
border: 1px solid #408080;  /* Borde de la ventana */
box-shadow: 0 5px 25px rgba(0,0,0,.1);  /* Sombra */
z-index:999;
}
#ventana-flotante .cerrar {
float: right;
border-bottom: 1px solid #408080;
border-left: 1px solid #408080;
color: #990000;
background: #E4F1F1;
line-height: 17px;
text-decoration: none;
padding: 0px 14px;
font-family: Arial;
border-radius: 0 0 0 5px;
box-shadow: -1px 1px white;
font-size: 18px;
-webkit-transition: .3s;
-moz-transition: .3s;
-o-transition: .3s;
-ms-transition: .3s;
}
#ventana-flotante .cerrar:hover {
background: #990000;
color: white;
text-decoration: none;
text-shadow: -1px -1px #990000;;
border-bottom: 1px solid #990000;;
border-left: 1px solid #990000;;
}
#ventana-flotante .contenido {
padding: 15px;
box-shadow: inset 1px 1px white;
/*background: #deffc4;   Fondo del mensaje */
/*border: 1px solid #9eff9e;   Borde del mensaje */
font-size: 18px;  /* Tamaño del texto del mensaje */
color: #555;  /* Color del texto del mensaje */
text-shadow: 1px 1px white;
margin: 0 auto;
border-radius: 4px;
}
#ventana-flotante a {
	color: #666;
	text-decoration: none;
}
#ventana-flotante a:hover {
	color: #990000;
	text-decoration: none;
}

.oculto {-webkit-transition:1s;-moz-transition:1s;-o-transition:1s;-ms-transition:1s;opacity:0;-ms-opacity:0;-moz-opacity:0;visibility:hidden;}

/* FIN ESTILOS VENTANA FLOTANTE*/
</style>
-->	
<!-- 
	
<script type="text/javascript">
	 
	setTimeout("window.self.close();", 3000);
	
</script>

-->	
	
</head>
	
<body topmargin="0" onload="hora()">

	
<!--
	<div id='ventana-flotante'>
   <a class='cerrar' href='javascript:void(0);' onclick='document.getElementById(&apos;ventana-flotante&apos;).className = &apos;oculto&apos;'>X</a>
-->
        <!--[if IE]>
        <style>
        .oculto {display:none}
        </style>
        <![endif]-->
<!-- 
	<div class='contenido' align="center" style="padding-top:22px">
       				DOWNLOAD THIS APP FREE AND MORE IN:
            <br/>
<a href="http://juanbarrospazos.blogspot.com.es/" target="_blank" style="text-decoration:none" onclick='document.getElementById(&apos;ventana-flotante&apos;).className = &apos;oculto&apos;'>	
  				http://juanbarrospazos.blogspot.com.es/
            </a>
       </div>
</div>
-->
	<div id="Conte">
  <div id="head"> 
  			<span style="font-size:18px">
  							<?php print(strtoupper($head_titulo));?>
            </span>
  	</br>
  			<span style="font-size:12px">
  							<?php print(strtoupper($head_titulo2));?>
            </span>
   </div>

  <div style="clear:both"></div>
   
   <div style="margin-top:2px; text-align:center" id="TitTut">
   
		<font color="#59746A">

					<span id="hora">000000</span>

		</font>
    
	</div>
			  <div style="clear:both"></div>

  

  <div id="Caja2Admin">



