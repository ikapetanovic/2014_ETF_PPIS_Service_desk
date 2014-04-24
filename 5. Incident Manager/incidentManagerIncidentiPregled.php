<?php

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
		
		mysql_close();
		
		$q2 = mysql_query("SELECT idIncident, datumVrijemePrijave, korisnik, naslov, kategorija, podkategorija, konfiguracijskaStavka, prioritet, status  FROM incident WHERE dodijeljenaGrupa = $privilegija;") or die("Error in query: ".mysql_error());

		while ($row = mysql_fetch_assoc($q2))
		{
			echo "<tr>";
			echo "<td>" . $row['idIncident'] . "</td>";
			echo "<td>" . $row['datumVrijemePrijave'] . "</td>";
			echo "<td>" . $row['korisnik'] . "</td>";
			echo "<td>" . $row['naslov'] . "</td>";
			echo "<td>" . $row['kategorija'] . "</td>";
			echo "<td>" . $row['podkategorija'] . "</td>";
			echo "<td>" . $row['konfiguracijskaStavka'] . "</td>";
			echo "<td>" . $row['prioritet'] . "</td>";
			echo "<td>" . $row['status'] . "</td>";	
			echo "<td><input type="submit" class="btn btn-success" value="Uredi"/>";
			echo "</tr>";
		}
		
		mysql_close();
		
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>