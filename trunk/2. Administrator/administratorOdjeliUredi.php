<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Uređivanje odjela</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>

		<ul class="nav nav-tabs">
		  <li class="active"><a href="administratorOdjeliNovi.html">Odjeli</a></li>
		  <li><a href="administratorKorisniciNovi.php">Korisnici</a></li>
		</ul>
		
		<ul class="nav nav-pills">
		  <li><a href="administratorOdjeliNovi.html">Novi odjel</a></li>
		  <li><a href="administratorOdjeliPregled.php">Pregled odjela</a></li>
		</ul>
		<?php
if(isset($_POST['doEdit'])) {	$IDOdjela = "";
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("SELECT idOdjel, naziv, lokacija, adresa, telefon, email FROM odjel WHERE idOdjel = '$_POST[idOdjel]';") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q))
		{
			echo '<table>
			<form method="POST" action="UrediOdjel.php">
				<tr><td><label style="text-align:left;">Naziv:</label></td></tr>
				<tr><td><input type="text" class="btn" name="naziv" value="'.$row['naziv'].'"/></td></tr> 
				
				<tr><td><label>Lokacija:</label></td></tr>
				<tr><td><input type="text" class="btn" name="lokacija" value="'.$row['lokacija'].'"/></td></tr>
				
				<tr><td><label>Adresa:</label></td></tr>
				<tr><td><input type="text" class="btn" name="adresa" value="'.$row['adresa'].'"/></td></tr>
				
				<tr><td><label>Telefon:</label></td></tr>
				<tr><td><input type="text" class="btn" name="telefon" value="'.$row['telefon'].'"/></td></tr>
				
				<tr><td><label>Email:</label></td></tr>
				<tr><td><input type="text" class="btn" name="email" value="'.$row['email'].'"/></td></tr>
				
				<tr><td style="text-align:right;"><input type="hidden" name="idOdjel" value="'.$row['idOdjel'].'"/><input type="submit" class="btn btn-success" value="Spasi"/> <input type="button" class="btn" onClick="odustani()" value="Odustani"/></td></tr>
			</form>
		</table>';
		}
		
		mysql_close();
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
	
	}
	else if(isset($_POST['doDelete'])) {try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("DELETE FROM odjel WHERE idOdjel = '".$_POST['idOdjel']."';") or die("Error in query: ".mysql_error());				
					
		mysql_close();
		
		echo "<script>alert('Uspjesna operacija!'); window.location = 'administratorOdjeliPregled.php';</script>";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	} }

?>
<script>
function odustani() {
window.location='administratorOdjeliPregled.php';
}
</script>
</body>
</html>