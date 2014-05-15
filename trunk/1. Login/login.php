
<?php session_start();?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php

	$idKorisnika = array();
	$korisnickaImena = array();
	$lozinke = array();
	$privilegije = array();
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT idKorisnik, korisnickoIme, lozinka, privilegija FROM korisnik;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
		array_push($idKorisnika, $row['idKorisnik']);
			array_push($korisnickaImena, $row['korisnickoIme']);
			array_push($lozinke, $row['lozinka']);
			array_push($privilegije, $row['privilegija']);
		}
			
		mysql_close();
		
		for($i = 0; $i < count($korisnickaImena); $i++)
			if(($korisnickaImena[$i] == $_POST['korisnickoIme']) && ($lozinke[$i] == $_POST['lozinka'])){
				switch ($privilegije[$i])
				{
					case "Administrator":
						header( 'Location: ../2. Administrator/administratorOdjeliNovi.html');
						break;
					case "User":
						header( 'Location: ../3. User/userDogadjajPregled.php');
						break;
					case "EventManager":
						header( 'Location: ../4. Event Manager/eventManagerFiltriranje.php');
						break;	
					case "IncidentManager":
						header( 'Location: ../5. Incident Manager/incidentManagerIncidentiPregled.php');
						break;
					case "RequestManager":
						// Otvori početnu za RequestManagera
						break;			
					case "SupplierManager":
						// Otvori početnu za SupplierManagera
						break;
					case "SuperManager":
						header( 'Location: ../6. Super Manager/superManagerIncidentiPregled.php');
						break;
				}

			$_SESSION['id'] =  $idKorisnika[$i];	
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

