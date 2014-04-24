<?php
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		// IDIncident treba da se odredi kada se kliknulo na neki red u tabeli kod pregleda incidenata
		
		$q = mysql_query("SELECT datumVrijemePrijave, korisnik, odjel, tipPrijave, naslov, kategorija, podkategorija, konfiguracijskaStavka, povratnaInfoPreko, opis, komentar, uticaj, hitnost, prioritet, status, dodijeljenaGrupa FROM incident WHERE idIncident = '$_POST[IDIncident]';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			// Dobavljene podatke ispisati na formu za Uređivanje
			// Primjer kako se koristi dobavljena vrijednost: $row['naslov']
		}
		
		mysql_close();	
		
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>

<?php
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("INSERT INTO incident SET datumVrijemePrijave = '$_POST[datumVrijemePrijave]', naslov = '$_POST[naslov]', kategorija = '$_POST[kategorija]', podkategorija = '$_POST[podkategorija]', konfiguracijskaStavka = '$_POST[konfiguracijskaStavka]', uticaj = '$_POST[uticaj]', hitnost = '$_POST[hitnost]', prioritet = '$_POST[prioritet]', opis = '$_POST[opis]', status = '$_POST[status]', tipPrijave = '$_POST[tipPrijave]', povratnaInfoPreko = '$_POST[povratnaInfoPreko]', dodijeljenaGrupa = '$_POST[dodijeljenaGrupa]', komentar = '$_POST[komentar]', radneBiljeske = '$_POST[radneBiljeske]', datumRjesavanja = '$_POST[datumRjesavanja]', korisnik = '$_POST[korisnik]';") or die("Error in query: ".mysql_error());
				
		mysql_close();
		
		echo "Uspješno spašeno!";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>