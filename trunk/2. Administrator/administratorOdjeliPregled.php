<?php

	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT idOdjel, naziv, lokacija, adresa, telefon, email FROM odjel;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			echo "<tr> <form action = "."administratorOdjeliUredi.php"." method="."post".">";  // Koja skripta se treba pozvati, jer možda klikne Uredi ili Obriši?
			echo "<tr>";
			echo "<td>" . $row['idOdjel'] . "</td>";
			echo "<td>" . $row['naziv'] . "</td>";
			echo "<td>" . $row['lokacija'] . "</td>";
			echo "<td>" . $row['adresa'] . "</td>";
			echo "<td>" . $row['telefon'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
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