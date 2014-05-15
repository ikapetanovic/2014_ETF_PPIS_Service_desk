<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Filtriranje</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>

		<ul class="nav nav-tabs">
		  <li class="active"><a href="eventManagerFiltriranje.php">Filtriranje</a></li>
		  <li><a href="eventManagerIncidentiPregled.php">Incidenti</a></li>
		  <li><a href="eventManagerZahtjevi.php">Zahtjevi</a></li>
		</ul><table class="table">
			
			
			<th>ID</th>
			<th>Datum i vrijeme</th>
			<th>Korisnik</th>
			<th>Naslov</th>
			<th>Kategorija</th>
			<th>Podkategorija</th>
			<th>Model</th>
			<th>Prioritet</th>
			<th></th>
			
			<?php

	try
	{
		$ideviKorisnika = array();
		$imenaPrezimenaKorisnika = array();
		
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q1 = mysql_query("SELECT idKorisnik, imePrezime FROM korisnik;") or die("Error in query: ".mysql_error());
	
		while ($row = mysql_fetch_assoc($q1))
		{
			array_push($ideviKorisnika, $row['idKorisnik']);
			array_push($imenaPrezimenaKorisnika, $row['imePrezime']);
		}
		

		
		$q2 = mysql_query("SELECT idDogadjaj, datumVrijemePrijave, korisnik_idKorisnik, naslov, kategorija, podkategorija, model, prioritet FROM dogadjaj WHERE status = 'novi';") or die("Error in query: ".mysql_error());

		while ($row = mysql_fetch_assoc($q2))
		{
			echo "<tr>";
			echo "<td>" . $row['idDogadjaj'] . "</td>";
			echo "<td>" . $row['datumVrijemePrijave'] . "</td>";
			
			for($i = 0; $i < count($imenaPrezimenaKorisnika); $i++)
				if($ideviKorisnika[$i] == $row['korisnik_idKorisnik'])
					echo "<td>" . $imenaPrezimenaKorisnika[$i] . "</td>";
			
			echo "<td>" . $row['naslov'] . "</td>";
			echo "<td>" . $row['kategorija'] . "</td>";
			echo "<td>" . $row['podkategorija'] . "</td>";
			echo "<td>" . $row['model'] . "</td>";
			echo "<td>" . $row['prioritet'] . "</td>";
			echo "<td><form method='POST' action='eventManagerFiltriranjeUredi.php'><input type='hidden' value=" . $row['idDogadjaj'] . " name='idDogadjaj'/><input type='submit' class='btn btn-success' value='Uredi'/></form></tr>";
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