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
			
		mysql_close();
		
		$q2 = mysql_query("SELECT idKorisnik, imePrezime, korisnickoIme, lozinka, email, telefon, privilegija, odjel_idOdjel FROM korisnik;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q2))
		{
			echo "<tr> <form action = "."administratorKorisniciUredi.php"." method="."post".">";  // Koja skripta se treba pozvati, jer možda klikne Uredi ili Obriši?
			echo "<tr>";
			echo "<td>" . $row['idKorisnik'] . "</td>";
			echo "<td>" . $row['imePrezime'] . "</td>";
			echo "<td>" . $row['korisnickoIme'] . "</td>";
			echo "<td>" . $row['lozinka'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['telefon'] . "</td>";
			echo "<td>" . $row['privilegija'] . "</td>";			
			
			for($i = 0; $i < count($ideviOdjela); $i++)
				if($ideviOdjela[$i] == $row['odjel_idOdjel'])
					echo "<td>" . $naziviOdjela[$i] . "</td>";			
			
			echo "<td><input type="."submit"." class = "."btn btn-success"." value = "."Uredi"."/> </td>"; 
			echo "<td><input type="."button"." class = "."btn"." value = "."Obriši"."/> </td>";
			echo "</tr>";
		}
		
		mysql_close();
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>