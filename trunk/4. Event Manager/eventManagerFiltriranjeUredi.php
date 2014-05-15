<?php
	session_start();?>
	<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Filtriranje</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>

		<ul class="nav nav-tabs">
		  <li class="active"><a href="eventManagerFiltriranje.php">Filtriranje</a></li>
		  <li><a href="eventManagerIncidentiPregled.php">Incidenti</a></li>
		  <li><a href="eventManagerZahtjevi.php">Zahtjevi</a></li>
		</ul>
		<table>
			<form method="POST" action="spasiIncident.php">
							
<?php
	$IDKorisnik = 13;
	$IDDogadjaj = 1;
	
	

	
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 

		// $IDDogadjaj treba da se odredi kada se kliknulo na neki red u tabeli kod Filtriranja
		
		$q1 = mysql_query("SELECT idDogadjaj, datumVrijemePrijave, naslov, kategorija, podkategorija, model, uticaj, hitnost, prioritet, korisnik_idKorisnik FROM dogadjaj WHERE idDogadjaj = '$IDDogadjaj';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q1))
		{
			echo '<tr><td><input type="hidden" name="idDogadjaj" value="'.$row['idDogadjaj'].'"/></td></tr>
				<tr><td><label style="text-align:left;">Datum i vrijeme:</label></td></tr>
				<tr><td><input type="text" class="btn" name="datumVrijemePrijave" readonly="true" value="'.$row['datumVrijemePrijave'].'"/></td></tr>
				
				<tr><td><label>Naslov:</label></td></tr>
				<tr><td><input type="text" class="btn" name="naslov" value="'.$row['naslov'].'"/></td></tr>
								
				<tr><td><label>Kategorija:</label></td></tr>			
				<tr><td><input type="text" class="btn" name="kategorija" value="'.$row['kategorija'].'"/></td></tr>			
				
				<tr><td><label>Podkategorija:</label></td></tr>
				<tr><td><input type="text" class="btn" name="podkategorija" value="'.$row['podkategorija'].'"/></td></tr>
				
				<tr><td><label>Model:</label></td></tr>
				<tr><td><input type="text" class="btn" name="model" value="'.$row['model'].'"/></td></tr>				
				
				<tr><td><label>Opis:</label></td></tr>
				<tr><td><textarea class="btn" name="opis"></textarea></td></tr>
				
				<tr><td><label>Status:</label></td></tr>
				<tr><td><textarea class="btn" name="status"></textarea></td></tr>	
				
				 <tr><td><label>Hitnost:</label></td></tr>
                <tr><td><textarea class="btn" name="hitnost" value="'.$row['hitnost'].'"></textarea></td></tr>
				
				 <tr><td><label>Uticaj:</label></td></tr>
                <tr><td><textarea class="btn" name="uticaj" value="'.$row['uticaj'].'"></textarea></td></tr>
				
				<tr><td><label>Prioritet:</label></td></tr>
                <tr><td><textarea class="btn" name="prioritet" value="'.$row['prioritet'].'"></textarea></td></tr> 
							
				<tr><td><label>Korisnik:</label></td></tr>
				<tr><td><input type="text" class="btn" name="korisnik" value="'.$row['korisnik_idKorisnik'].'"/></td></tr>
				
				<tr><td><label>Odjel:</label></td></tr>
				<tr><td>
					<select class="btn" name="Odjel">';
					
	
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 

		$ideviOdjela = array();
		$naziviOdjela = array();
		$q = mysql_query("SELECT idOdjel, naziv FROM odjel;") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			array_push($ideviOdjela, $row['idOdjel']);
			array_push($naziviOdjela, $row['naziv']);
			echo '<option>'.$row['naziv'].'</option>';
		}
				
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}


			  
					echo '</select>
				</td></tr>
				
				<tr><td><label>Komentar (vidljivo korisniku):</label></td></tr>
				<tr><td><textarea class="btn" name="komentar"></textarea></td></tr>	

				<tr><td><label>Vrsta događaja:</label></td></tr>
				<tr><td>
					<select class="btn" name="vrsta">					  
					  <option value="Incident">Incident </option>
					  <option value="Request">Request </option>					  
					</select>
				</td></tr>  
					
				
				<tr><td><label>Dodijeljena grupa:</label></td></tr>
				<tr><td>
					<select class="btn" name="grupa">					  
					  <option value="IncidentManager">Incident Manager</option>
					  <option value="RequestManager">Request Manager</option>					  
					</select>
				</td></tr>  							
								
				
				<tr><td style="text-align:right;"><input type="submit" class="btn btn-success" value="Spasi"/> <input type="button" class="btn" onClick="odustani()" value="Odustani"/></td></tr>
			</form>';
			$IDKorisnik = $row['korisnik_idKorisnik'];
		}
		
		mysql_close();
		}
		
		catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
		
		
		
	
		

?>

</table>
	</center>
<script>
function odustani() {
window.location='eventManagerFiltriranje.php';
}
</script>
</body>
</html>