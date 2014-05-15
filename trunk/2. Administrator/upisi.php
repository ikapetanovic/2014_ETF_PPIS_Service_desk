<?php

	$ideviOdjela = array();
	$naziviOdjela = array();
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT idOdjel, naziv FROM odjel;") or die("Error in query: ".mysql_error());
					
		while ($row = mysql_fetch_assoc($q))
		{
			array_push($ideviOdjela, $row['idOdjel']);
			array_push($naziviOdjela, $row['naziv']);
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
		
		// varijalbe $ideviOdjela, $naziviOdjela se dobiju iz ranijeg upita
		for($i = 0; $i < count($ideviOdjela); $i++)
			if($naziviOdjela[$i] == $_POST['Odjel']) // $_POST[Odjel] je naziv odjela koji je odabran iz Comboboxa
				$IDOdjela = $ideviOdjela[$i];
		
		$q = mysql_query("INSERT INTO korisnik SET imePrezime = '$_POST[imePrezime]', korisnickoIme = '$_POST[korisnickoIme]', lozinka = '$_POST[lozinka]', email = '$_POST[email]', telefon = '$_POST[telefon]', privilegija = '$_POST[privilegija]', odjel_idOdjel = '$IDOdjela';") or die("Error in query: ".mysql_error());
					
		mysql_close();
		
		echo"<script>alert('Uspjesna operacija!'); window.location = 'administratorKorisniciNovi.php';</script>";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>