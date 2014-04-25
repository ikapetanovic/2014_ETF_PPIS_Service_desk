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
		
		mysql_close();		
		
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
			echo "</tr>";
		}
		
		mysql_close();
		
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>