<?php
session_start();
	try
	{
	
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
				
		$IDKorisnik = $_SESSION['id'];
		$q = mysql_query("INSERT INTO dogadjaj SET datumVrijemePrijave = '2014-05-07', naslov = '$_POST[naslov]', kategorija = '$_POST[kat]', podkategorija = '$_POST[podkat]', model = '$_POST[model]', uticaj = '$_POST[uticaj]', hitnost = '$_POST[hitnost]', prioritet = '$_POST[prioritet]', opis = '$_POST[opis]', status = 'novi', korisnik_idKorisnik = '$IDKorisnik';") or die("Error in query: ".mysql_error());
				
		mysql_close();
		
		echo"<script>alert('Uspjesna operacija!'); window.location = 'userDogadjajNovi.html';</script>";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>