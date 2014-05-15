<?php
	// Ako je vrsta događaja bila zahtjev, treba izvršiti ovaj kod da se spasi:
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error());
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error());
		// Treba updateovati dogadjaj koji je filtriran, tj. njemu se stavlja status na "filtriran" i on se više ne prikazuje
		// Bitno je ovo uraditi, pošto se Event Manageru trebaju selektovati samo događaji koji imaju status "novi"
		// $q = mysql_query("UPDATE dogadjaj...
		$q = mysql_query("INSERT INTO zahtjev SET odjel = '1', datumVrijemePrijave = '$_POST[datumVrijemePrijave]', naslov = '$_POST[naslov]', kategorija = '$_POST[kategorija]', podkategorija = '$_POST[podkategorija]', model = '$_POST[model]', uticaj = '$_POST[uticaj]', hitnost = '$_POST[hitnost]', prioritet = '$_POST[prioritet]', opis = '$_POST[opis]', status = 'naCekanju', tipPrijave = 'sistem', povratnaInfoPreko = 'Sistem', dodijeljenaGrupa = 'IncidentManager', komentar = '$_POST[komentar]', korisnik = '$_POST[korisnik]', dogadjaj = '$_POST[idDogadjaj]';") or die("Error in query: ".mysql_error());
		mysql_close();
		echo "<script>alert('Uspjesna operacija!'); window.location = 'requestManagerZahtjeviPregled.php'; </script>";
	}
	catch (Exception $e)
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
?>