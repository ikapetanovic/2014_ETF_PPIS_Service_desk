<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Pregled zahtjeva</title>
	</head>
	<body style="margin-top : 10%; margin-left : 20%; margin-right : 20%">
		<center>
			<ul class="nav nav-tabs">
				<li><a href="eventManagerFiltriranje.php">Filtriranje</a></li>
				<li><a href="eventManagerIncidentiPregled.php">Incidenti</a></li>
				<li class="active"><a href="eventManagerZahtjeviPregled.php">Zahtjevi</a></li>
			</ul>
			<table class="table">
				<form method="POST" action="eventManagerZahtjeviPregled.php">
					<th>ID</th>
					<th>Datum i vrijeme</th>
					<th>Korisnik</th>
					<th>Naslov</th>
					<th>Kategorija</th>
					<th>Podkategorija</th>
					<th>Model</th>
					<th>Prioritet</th>
					<th>Status</th>
					<th></th>
					<?php
						try
						{
							mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error());
							mysql_set_charset("utf8");
							mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error());
							$q = mysql_query("SELECT idZahtjev, datumVrijemePrijave, korisnik, naslov, kategorija, podkategorija, model, prioritet, status  FROM zahtjev;") or die("Error in query: ".mysql_error());
							while ($row = mysql_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>" . $row['idZahtjev'] . "</td>";
								echo "<td>" . $row['datumVrijemePrijave'] . "</td>";
								echo "<td>" . $row['korisnik'] . "</td>";
								echo "<td>" . $row['naslov'] . "</td>";
								echo "<td>" . $row['kategorija'] . "</td>";
								echo "<td>" . $row['podkategorija'] . "</td>";
								echo "<td>" . $row['model'] . "</td>";
								echo "<td>" . $row['prioritet'] . "</td>";
								echo "<td>" . $row['status'] . "</td>";	
								echo "<td><input type='submit' class='btn btn-success' value='Uredi'/>";
								echo "</tr>";
							}
							mysql_close();
						}
						catch (Exception $e)
						{
							echo 'Caught exception: ', $e->getMessage(), "\n";
						}
					?>
				</form>
			</table>
		</center>
	</body>
</html>