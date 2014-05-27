<?php
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "UPDATE dogadaj SET status = 'Filtriran' WHERE id = '".$_POST["idDogadaja"]."';";
	mysql_query($SQLUpit);
	$SQLUpit = "SELECT * FROM dogadaj WHERE id = '".$_POST["idDogadaja"]."';";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$dogadaj = mysql_fetch_assoc($rezultatSQLUpita);
	if ($_POST["vrsta"] == "Zahtjev")
	{
		$SQLUpit = "INSERT INTO zahtjev SET datum_prijavljivanja = '".$dogadaj["datum"]."', naziv = '".$dogadaj["naziv"]."', kategorija = '".$dogadaj["kategorija"]."', podkategorija = '".$dogadaj["podkategorija"]."', prioritet = '".$dogadaj["prioritet"]."', opis = '".$dogadaj["opis"]."', komentar = ' ', status = 'Na čekanju', datum_rjesavanja = ' ', id_dogadaja = '".$dogadaj["id"]."';";
	}
	else if ($_POST["vrsta"] == "Incident")
	{
		$SQLUpit = "INSERT INTO incident SET datum_prijavljivanja = '".$dogadaj["datum"]."', naziv = '".$dogadaj["naziv"]."', kategorija = '".$dogadaj["kategorija"]."', podkategorija = '".$dogadaj["podkategorija"]."', prioritet = '".$dogadaj["prioritet"]."', opis = '".$dogadaj["opis"]."', komentar = ' ', status = 'Na čekanju', stanje = 'Kontrolirano', datum_rjesavanja = ' ', id_dogadaja = '".$dogadaj["id"]."';";
	}
	mysql_query($SQLUpit);
	echo "<script>alert(\"Filtriranje događaja je uspješno.\"); window.location = \"PregledanjeDogadaja.php\";</script>";
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Event Manager</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>