<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php

	$korisnickaImena = array();
	$lozinke = array();
	$privilegije = array();
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT korisnickoIme, lozinka, privilegija FROM korisnik;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			array_push($korisnickaImena, $row['korisnickoIme']);
			array_push($lozinke, $row['lozinka']);
			array_push($privilegije, $row['privilegija']);
		}
			
		mysql_close();
		
		for($i = 0; $i < count($korisnickaImena); $i++)
			if(($korisnickaImena[$i] == $_POST['korisnickoIme']) && ($lozinke[$i] == $_POST['lozinka']))
				switch ($privilegije[$i])
				{
					case "Administrator":
						// Otvori administratorNaslovna.html
						echo "Radi!"; // Obrisati ovo!
						break;
					case "User":
						// Otvori userDogadjajPregled.html
						break;
					case "EventManager":
						// Otvori eventManagerFiltriranje.html
						break;	
					case "IncidentManager":
						// Otvori incidentManagerIncidentiPregled.html
						break;
					case "RequestManager":
						// Otvori početnu za RequestManagera
						break;			
					case "SupplierManager":
						// Otvori početnu za SupplierManagera
						break;
					case "SuperManager":
						// Otvori superManagerIncidentiPregled.html
						break;
				}			
			else
				echo "GREŠKA: Nepoznat korisnik";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
?>

</body>
</html> 

