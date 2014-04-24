<?php
	
	$IDKorisnik = "";
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 

		// IDDogadjaj treba da se odredi kada se kliknulo na neki red u tabeli kod Filtriranja
		
		$q1 = mysql_query("SELECT datumVrijemePrijave, naslov, kategorija, podkategorija, konfiguracijskaStavka, uticaj, hitnost, prioritet, korisnik_idKorisnik FROM dogadjaj WHERE idDogadjaj = '$_POST[IDDogadjaj]';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			// Dobavljene podatke ispisati na formu za Uređivanje
			// Primjer kako se koristi dobavljena vrijednost: $row['naslov']
			// Datum i vrijeme samo ispisati da bude readonly, bez ikakvih daljih promjena
			$IDKorisnik = $row['korisnik_idKorisnik'];
		}
		
		mysql_close();
		
		$IDOdjel = "";
		
		$q2 = mysql_query("SELECT imePrezime, odjel_idOdjel FROM korisnik WHERE idKorisnik = '$IDKorisnik';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q2))
		{
			// Ispisati imePrezime u polje "Korisnik" na formi
			$IDOdjel = $row['odjel_idOdjel'];
		}
			
		mysql_close();
		
		$q3 = mysql_query("SELECT naziv FROM odjel WHERE idOdjel = '$IDOdjel';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q3))
		{
			// Ispisati naziv odjela u Combobox
		}
			
		mysql_close();
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>

<?php
	// Ako je vrsta događaja bila incident, treba izvršiti ovaj kod da se spasi:

	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		// Treba updateovati dogadjaj koji je filtriran
		
		$q = mysql_query("INSERT INTO incident SET datumVrijemePrijave = '$_POST[datumVrijemePrijave]', naslov = '$_POST[naslov]', kategorija = '$_POST[kategorija]', podkategorija = '$_POST[podkategorija]', konfiguracijskaStavka = '$_POST[konfiguracijskaStavka]', uticaj = '$_POST[uticaj]', hitnost = '$_POST[hitnost]', prioritet = '$_POST[prioritet]', opis = '$_POST[opis]', status = 'naCekanju', tipPrijave = 'sistem', povratnaInfoPreko = 'Sistem', dodijeljenaGrupa = 'IncidentManager', komentar = '$_POST[komentar]', korisnik = '$_POST[korisnik]', dogadjaj_idDogadjaj = '$_POST[$IDDogadjaj]';") or die("Error in query: ".mysql_error());
				
		mysql_close();
		
		echo "Uspješno spašeno!";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>