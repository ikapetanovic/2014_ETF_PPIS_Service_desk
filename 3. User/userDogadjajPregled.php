<?php

	try
	{
		$ideviDogadjaja = array();
		
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		// $IDKorisnik treba da se zna na osnovu sesije, tj. uzima se ID onog korisnika koji je logiran
		
		$q1 = mysql_query("SELECT idDogadjaj FROM dogadjaj WHERE korisnik_idKorisnik = '$IDKorisnik';") or die("Error in query: ".mysql_error());
	
		while ($row = mysql_fetch_assoc($q1))
			array_push($ideviDogadjaja, $row['idDogadjaj']);
		
		mysql_close();
		
		for($i = 0; $i < count($ideviDogadjaja); $i++)
		{		
			$q2 = mysql_query("SELECT idIncident, datumVrijemePrijave, naslov, komentar, status, prioritet FROM incident WHERE dogadjaj_idDogadjaj = '$ideviDogadjaja[i]';") or die("Error in query: ".mysql_error());
			
			while ($row = mysql_fetch_assoc($q2))
			{
				echo "<tr>";
				echo "<td>" . $row['idIncident'] . "</td>";
				echo "<td>" . $row['datumVrijemePrijave'] . "</td>";
				echo "<td>" . $row['naslov'] . "</td>";
				echo "<td>" . $row['komentar'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['prioritet'] . "</td>";
				echo "</tr>";
			}
			
			mysql_close();
		}	
		
		for($i = 0; $i < count($ideviDogadjaja); $i++)
		{
			$q3 = mysql_query("SELECT idZahtjev, datumVrijemePrijave, naslov, komentar, status, prioritet FROM incident WHERE dogadjaj_idDogadjaj = '$ideviDogadjaja[i]';") or die("Error in query: ".mysql_error());
			
			while ($row = mysql_fetch_assoc($q3))
			{
				echo "<tr>";
				echo "<td>" . $row['idZahtjev'] . "</td>";
				echo "<td>" . $row['datumVrijemePrijave'] . "</td>";
				echo "<td>" . $row['naslov'] . "</td>";
				echo "<td>" . $row['komentar'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['prioritet'] . "</td>";
				echo "</tr>";
			}
			
			mysql_close();
		}
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>