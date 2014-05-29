<?php

	
	if (isset($_POST["id"]))
	{
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("service_desk_db") or die(mysql_error());
	
		$upit = "update ugovori SET krajnji_datum = DATE_ADD(krajnji_datum, INTERVAL 12 MONTH) where id=". $_POST["id"]. "";
		mysql_query($upit) or die(mysql_error());
		mysql_close() or die(mysql_error());
		
		
		
	
		
	}
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Upravljanje dobavljacima</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body onload="onemoguciSlanje();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="Ugovori.php">Nazad</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="navbar-brand">Prijavljeni ste kao: Mensur Mandzuka</li>
							<li><a class="navbar-brand" href="#">Odjava</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="jumbotron">
				<p>
					<div class="panel panel-primary">
						<div class="panel-heading">Pregled ugovora</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Naziv</th>
									
									<th class="info">Vrsta robe</th>
									<th class="info">Broj ugovora</th>
									<th class="info">Vrijednost</th>
									<th class="info">Efektivni datum</th>
									<th class="info">Datum isteka ugovora</th>
									<th class="info">Period obnavljanja</th>
									<th class="info">Opis</th>
									<th class="info">Status</th>
									
								</tr>
								<?php
									mysql_connect("localhost", "root", "") or die(mysql_error());
									mysql_select_db("service_desk_db") or die(mysql_error());
									$SQLUpit = "SELECT * from ugovori";
									$rezultatSQLUpita = mysql_query($SQLUpit) or die(mysql_error());
									while ($red = mysql_fetch_assoc($rezultatSQLUpita))
									{
										$id = $red["id"];
										echo "<tr>";
										echo "<td>".$red["naziv"]."</td>";
										
										echo "<td>".$red["vrsta"]."</td>";
										echo "<td>".$red["broj"]."</td>";
										echo "<td>".$red["vrijednost"]."</td>";
										echo "<td>".$red["pocetni_datum"]."</td>";
										echo "<td>".$red["krajnji_datum"]."</td>";
										echo "<td>".$red["period_obnavljanja"]."</td>";
										echo "<td>".$red["opis"]."</td>";
										$datumIsteka = $red["krajnji_datum"];
										
										echo "<td>";
										$now = new DateTime();
										
										$now = date('Y-m-d');
										if ($datumIsteka > $now) { echo "<div style=\"color:#00FF00;\">Aktivan</div>"; }
										else { echo "<div style=\"color:red;\">Istekao</div>";
										echo "</td>";
										echo "<td>";
										echo "<form action=\"\" method=\"post\">" .
										"<input type=\"hidden\" name=\"id\" value=\"" . $id . "\" >" .				
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"Obnovi\" />" .							
										"</form>"; }
										echo "</td>";
										echo "</td>";
										echo "</tr>";
												
										
									}
									
									mysql_close() or die(mysql_error());
								?>
								</table>
								</div>
								</div>
								</p>
								</div>
									
								
								
								
								</body>
								</html>
								
							