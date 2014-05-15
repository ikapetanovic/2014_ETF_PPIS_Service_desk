<?php session_start(); 
$id = $_POST['idKorisnik'];?>
<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Uređivanje korisnika</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>
	
		<ul class="nav nav-tabs">
		  <li><a href="administratorOdjeliNovi.php">Odjeli</a></li>
		  <li class="active"><a href="administratorKorisniciNovi.php">Korisnici</a></li>
		</ul>
		
		<ul class="nav nav-pills">
		  <li><a href="administratorKorisniciNovi.php">Novi korisnik</a></li>
		  <li><a href="administratorKorisniciPregled.php">Pregled korisnika</a></li>
		</ul><?php
	
if(isset($_POST['doEdit'])) {	$IDOdjela = "";
	try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
				
		$q1 = mysql_query("SELECT imePrezime, korisnickoIme, lozinka, email, telefon, privilegija, odjel_idOdjel FROM korisnik WHERE idKorisnik ='$id'") or die("Error in query: ".mysql_error());
		
		while ($row = mysql_fetch_assoc($q1))
		{ echo '<table><form method="POST" action="uredi.php">';
			echo '<tr><td><label style="text-align:left;">Ime i prezime:</label></td></tr>';
			echo '<tr><td><input type="text" class="btn" name="imePrezime" value="'.$row['imePrezime'].'"/></td></tr>';
			echo '<tr><td><label>Korisničko ime:</label></td></tr><tr><td><input type="text" class='.'btn'.' name="korisnickoIme" value="'.$row['korisnickoIme'].'"/></td></tr>
				<tr><td><label>Lozinka:</label></td></tr>
				<tr><td><input type="text" class='.'btn'.' name="lozinka" value="'.$row['lozinka'].'"/></td></tr>
				
				<tr><td><label>Email:</label></td></tr>
				<tr><td><input type="text" class='.'btn'.' name="email" value="'.$row['email'].'"/></td></tr>
				
				<tr><td><label>Telefon:</label></td></tr>
				<tr><td><input type="text" class='.'btn'.' name="telefon" value="'.$row['telefon'].'"/></td></tr>
				
				<tr><td><label>Privilegija:</label></td></tr>			
				<tr><td>
					<select  class='.'btn'.' name ="privilegija">
					  <option value="Administrator">Administrator</option>
					  <option value="User">User</option>
					  <option value="EventManager">Event Manager</option>
					  <option value="IncidetManager">Incident Manager</option>
					  <option value="RequestManager">Request Manager</option>
					  <option value="SupplierManager">Supplier Manager</option>
					  <option value="SuperManager">Super Manager</option>				  
					</select>
				</td></tr> 				
				
				<tr><td><label>Odjel:</label></td></tr>
				<tr><td>
					<select class='.'btn'.' name="Odjel">
					  <option value="IT">IT</option>
					  <option value="Radiologija">Radiologija</option>
					  <option value="Oftamologija">Oftamologija</option>				  
					</select>
				</td></tr>
				
				<tr><td style="text-align:right;"><input type="submit" class="btn btn-success" value="Spasi"/> <input type="button" class="btn" onClick="odustani()" value="Odustani"/><input type="hidden" name="idKorisnik" value="'.$_POST['idKorisnik'].'"/></td></tr>
			</form>
		</table>';
			$IDOdjela = $row['odjel_idOdjel'];
		}
		}
		
	
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
	}
	else if(isset($_POST['doDelete'])) {

try
	{
		mysql_connect("localhost", "root", "root") or die("Unable to connect to the server: ".mysql_error()); // NAPOMENA: podesiti odgovarajući username i password
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_db") or die("Unable to connect to the database: ".mysql_error()); // NAPOMENA: Ukoliko se promijeni, podesiti odgovarajući naziv baze 
		
		$q = mysql_query("DELETE FROM korisnik WHERE idKorisnik = '$id'") or die("Error in query: ".mysql_error());				
					
		mysql_close();
		
		echo "<script>alert('Uspjesna operacija!'); window.location = 'administratorKorisniciPregled.php'; </script>";
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}


} 
 

?>

</center>
<script>
function odustani() {
window.location='administratorOdjeliPregled.php';
}
</script>
</body>
</html>