<?php
        if ($rf == ''){$rf = $_POST['ref'];}
        else { }
        if ($_POST['Pass'] == ''){ $pass = $_POST['Password'];}
        else { $pass = $_POST['Pass'];}

        print(" <tr>
					<td>Last IN:</td>
					<td colspan='2'>".$_POST['lastin']."</td>
				</tr>
				
				<tr>
					<td>Last Out:</td>
					<td colspan='2'>".$_POST['lastout']."</td>
				</tr>
				
				<tr>
					<td>Nº Visitas:</td>
					<td colspan='2'>".$_POST['visitadmin']."</td>
				</tr>
	
				<tr>
					<td>Date Delete:</td>
					<td colspan='2'>".$_POST['borrado']."</td>
				</tr>

             ");
?>