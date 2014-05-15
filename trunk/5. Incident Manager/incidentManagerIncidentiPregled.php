<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Pregled incidenata</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>

		<ul class="nav nav-tabs">
		  <li class="active"><a href="eventManagerIncidentiPregled.html">Incidenti</a></li>
		</ul>
		
		<ul class="nav nav-pills">
		  <li class="active"><a href="incidentManagerIncidentiPregled.html">Pregled incidenata</a></li>
		</ul>
		
		<table class="table">
			
			
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
			<?php session_start();
$IDKorisnik = 13;
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 	
		
		// $IDKorisnik se treba znati na osnovu sesije, tj. na osnovu korisnika koji je logiran
		
		$q1 = mysql_query("SELECT privilegija FROM korisnik WHERE idKorisnik = $IDKorisnik;") or die("Error in query: ".mysql_error());

		$privilegija = "";
		
		while ($row = mysql_fetch_assoc($q1))
		{			
			$privilegija = $row['privilegija'];
		}
		
		
		
		$q2 = mysql_query("SELECT idIncident, datumVrijemePrijave, korisnik, naslov, kategorija, podkategorija, model, prioritet, status  FROM incident WHERE dodijeljenaGrupa = '$privilegija';") or die("Error in query: ".mysql_error());

		while ($row = mysql_fetch_assoc($q2))
		{
			echo "<tr>";
			echo "<td><label name='idIncident'>". $row['idIncident'] . "</label></td>";
			echo "<td><label name='datumVrijemePrijave'>" . $row['datumVrijemePrijave'] . "</label></td>";
			echo "<td><label name='korisnik'>" . $row['korisnik'] . "</label></td>";
			echo "<td><label name='naslov'>" . $row['naslov'] . "</label></td>";
			echo "<td><label name='kategorija'>" . $row['kategorija'] . "</label></td>";
			echo "<td><label name='podKategorija'>" . $row['podkategorija'] . "</label></td>";
			echo "<td><label name='model'>" . $row['model'] . "</label></td>";
			echo "<td><label name='prioritet'>" . $row['prioritet'] . "</label></td>";
			echo "<td><label name='status'>" . $row['status'] . "</label></td>";	
			echo "<td><form method='POST' action='incidentManagerIncidentiUredi.php'><input type='hidden' name='idIncident' value=". $row['idIncident'] ."/><input type='submit' class='btn btn-success' value='Uredi'/></form>";
			echo "</tr>";
		}
		
		mysql_close();
		
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>

		</table>
	</center>
</body>

</html>