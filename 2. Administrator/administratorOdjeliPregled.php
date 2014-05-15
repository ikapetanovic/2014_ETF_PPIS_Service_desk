<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Pregled odjela</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>

		<ul class="nav nav-tabs">
		  <li class="active"><a href="administratorOdjeliNovi.html">Odjeli</a></li>
		  <li><a href="administratorKorisniciNovi.php">Korisnici</a></li>
		</ul>
		
		<ul class="nav nav-pills">
		  <li><a href="administratorOdjeliNovi.html">Novi odjel</a></li>
		  <li class="active"><a href="administratorOdjeliPregled.php">Pregled odjela</a></li>
		</ul>
		
		<table class="table">
			
			
			<th>ID</th>
			<th>Naziv</th>
			<th>Lokacija</th>
			<th>Adresa</th>
			<th>Telefon</th>
			<th>Email</th>
			<th></th>
			
<?php

	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT idOdjel, naziv, lokacija, adresa, telefon, email FROM odjel;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			 // Koja skripta se treba pozvati, jer možda klikne Uredi ili Obriši?
			echo "<tr>";
			echo "<td>" . $row['idOdjel'] . "</td>";
			echo "<td>" . $row['naziv'] . "</td>";
			echo "<td>" . $row['lokacija'] . "</td>";
			echo "<td>" . $row['adresa'] . "</td>";
			echo "<td>" . $row['telefon'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td><form method='POST' action ='administratorOdjeliUredi.php'><input type='hidden' name='idOdjel' value=\"".$row['idOdjel']."\"/><input type='submit' class = 'btn btn-success' value = 'Uredi' name='doEdit'/>&nbsp;<input type='submit' class = 'btn' value = 'Obriši' name='doDelete'/></form> </td>";
			echo "</tr>";
		}
		
		mysql_close();
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>
	
			</form>
		</table>
	</center>
</body>

</html>