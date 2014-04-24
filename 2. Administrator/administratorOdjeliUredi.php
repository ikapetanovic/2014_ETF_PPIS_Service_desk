<?php

	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT naziv, lokacija, adresa, telefon, email FROM odjel WHERE idOdjel = '$_POST[idOdjel]';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			// Dobavljene podatke ispisati na formu za Uređivanje
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
		
		$q = mysql_query("UPDATE odjel SET naziv = '$_POST[naziv]', lokacija = '$_POST[lokacija]', adresa = '$_POST[adresa]', telefon = '$_POST[telefon]', email = '$_POST[email]' WHERE idOdjel = '$_POST[idOdjel]';") or die("Error in query: ".mysql_error());				
					
		mysql_close();
		
		echo "Odjel je uspješno izmijenjen!";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>