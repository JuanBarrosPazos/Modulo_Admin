<?php

        global $ruta;
        global $rutacam;
		global $docname;
        
		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='".$ruta.$docname."';
					}
						setTimeout('redir()',6000);
						</script>";
			print ($redir);

?>