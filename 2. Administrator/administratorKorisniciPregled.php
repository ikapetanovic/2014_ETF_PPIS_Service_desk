<html>

<head>

	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Pregled korisnika</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>

		<ul class="nav nav-tabs">
		  <li><a href="administratorOdjeliNovi.html">Odjeli</a></li>
		  <li class="active"><a href="administratorKorisniciNovi.php">Korisnici</a></li>
		</ul>
		
		<ul class="nav nav-pills">
		  <li><a href="administratorKorisniciNovi.php">Novi korisnik</a></li>
		  <li class="active"><a href="administratorKorisniciPregled.php">Pregled korisnika</a></li>
		</ul>
		
		<table class="table">
			
			
			<th>ID</th>
			<th>Ime i prezime</th>
			<th>Korisničko ime</th>
			<th>Lozinka</th>
			<th>Email</th>
			<th>Telefon</th>
			<th>Privilegija</th>
			<th>Odjel</th>
			<th></th>
			
			

<?php

	$ideviOdjela = array();
	$naziviOdjela = array();
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error());
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); 
		
		$q1 = mysql_query("SELECT idOdjel, naziv FROM odjel") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q1))
		{
			array_push($ideviOdjela, $row['idOdjel']);
			array_push($naziviOdjela, $row['naziv']);
		}
			
	
		
		$q2 = mysql_query("SELECT idKorisnik, imePrezime, korisnickoIme, lozinka, email, telefon, privilegija, odjel_idOdjel FROM korisnik;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q2))
		{
			
			echo "<tr>";
			echo "<td>". $row['idKorisnik'] . "</label></td>";
			echo "<td>" . $row['imePrezime'] . "</td>";
			echo "<td>" . $row['korisnickoIme'] . "</td>";
			echo "<td>" . $row['lozinka'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['telefon'] . "</td>";
			echo "<td>" . $row['privilegija'] . "</td>";			
			
			for($i = 0; $i < count($ideviOdjela); $i++)
				if($ideviOdjela[$i] == $row['odjel_idOdjel'])
					echo "<td>" . $naziviOdjela[$i] . "</td>";			
			
			echo "<td><form method='POST' action ='administratorKorisniciUredi.php'><input type='hidden' name='idKorisnik' value=\"".$row['idKorisnik']."\"/><input type='submit' class = 'btn btn-success' value = 'Uredi' name='doEdit'/>"; 
			echo "<input type='submit' class = 'btn' value = 'Obriši' name='doDelete'/></form></td>";
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
</body></html>