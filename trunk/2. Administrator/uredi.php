<?php
	$id = $_POST['idKorisnik'];
	$IDOdjela = "";
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
				
		$q1 = mysql_query("SELECT imePrezime, korisnickoIme, lozinka, email, telefon, privilegija, odjel_idOdjel FROM korisnik WHERE idKorisnik = '$id';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q1))
		{
			
			$IDOdjela = $row['odjel_idOdjel'];
		}
		
		
		
		$q2 = mysql_query("SELECT naziv FROM odjel WHERE idOdjel = '$IDOdjela';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q2))
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


	$ideviOdjela = array();
	$naziviOdjela = array();
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q1 = mysql_query("SELECT idOdjel, naziv FROM odjel") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q1))
		{
			array_push($ideviOdjela, $row['idOdjel']);
			array_push($naziviOdjela, $row['naziv']);
		}
		
		for($i = 0; $i < count($ideviOdjela); $i++)
			if($naziviOdjela[$i] == $_POST['Odjel'])
				$IDOdjela = $ideviOdjela[$i];
		
		$q2 = mysql_query("UPDATE korisnik SET imePrezime = '$_POST[imePrezime]', korisnickoIme = '$_POST[korisnickoIme]', lozinka = '$_POST[lozinka]', email = '$_POST[email]', telefon = '$_POST[telefon]', privilegija = '$_POST[privilegija]', odjel_idOdjel = '$IDOdjela' WHERE idKorisnik = '$id'") or die("Error in query: ".mysql_error());				
					
		mysql_close();
		
		echo "<script>alert('Uspjesna operacija!'); window.location = 'administratorKorisniciPregled.php'; </script>";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}



?>