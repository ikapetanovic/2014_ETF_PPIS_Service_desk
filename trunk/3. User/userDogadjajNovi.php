<?php

	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
				
		// idKorisnik bi trebao da se upiše na podataka o korisniku koji je logiran
		$q = mysql_query("INSERT INTO dogadjaj SET datumVrijemePrijave = 'date("Y-m-d H:i:s")', naslov = '$_POST[naslov]', kategorija = '$_POST[kategorija]', podkategorija = '$_POST[podkategorija]', konfiguracijskaStavka = '$_POST[konfiguracijskaStavka]', uticaj = '$_POST[uticaj]', hitnost = '$_POST[hitnost]', prioritet = '$_POST[prioritet]', opis = '$_POST[opis]', status = 'novi', korisnik_idKorisnik = '$_POST[idKorisnik]';") or die("Error in query: ".mysql_error());
				
		mysql_close();
		
		echo "Događaj je uspješno kreiran!";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>