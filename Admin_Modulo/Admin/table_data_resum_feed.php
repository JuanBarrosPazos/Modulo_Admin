<?php
        if ($rf == ''){$rf = $_POST['ref'];}
        else { }
        if ($_POST['Pass'] == ''){ $pass = $_POST['Password'];}
        else { $pass = $_POST['Pass'];}

        print(" <tr>
					<td style='text-align:right !important;'>Last IN:</td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['lastin']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Last Out:</td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['lastout']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Nº Visitas:</td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['visitadmin']."</td>
				</tr>
	
				<tr>
					<td style='text-align:right !important;'>Date Delete:</td>
					<td style='text-align:left !important;' colspan='2'>".$_POST['borrado']."</td>
				</tr>

             ");
?>