<html>

<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" media="all" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Novi korisnik</title>
</head>

<body style="margin-top:10%; margin-left:20%;margin-right:20%">
	<center>
	
		<ul class="nav nav-tabs">
		  <li><a href="administratorOdjeliNovi.html">Odjeli</a></li>
		  <li class="active"><a href="administratorKorisniciNovi.php">Korisnici</a></li>
		</ul>
		
		<ul class="nav nav-pills">
		  <li class="active"><a href="administratorKorisniciNovi.php">Novi korisnik</a></li>
		  <li><a href="administratorKorisniciPregled.php">Pregled korisnika</a></li>
		</ul>
		
		<table>
			<form method="POST" action="upisi.php">
			
				<tr><td><label style="text-align:left;">Ime i prezime:</label></td></tr>
				<tr><td><input type="text" class="btn" name="imePrezime"/></td></tr>
				
				<tr><td><label>Korisničko ime:</label></td></tr>
				<tr><td><input type="text" class="btn" name="korisnickoIme"/></td></tr>
				
				<tr><td><label>Lozinka:</label></td></tr>
				<tr><td><input type="text" class="btn" name="lozinka"/></td></tr>
				
				<tr><td><label>Email:</label></td></tr>
				<tr><td><input type="text" class="btn" name="email"/></td></tr>
				
				<tr><td><label>Telefon:</label></td></tr>
				<tr><td><input type="text" class="btn" name="telefon"/></td></tr>
				
				<tr><td><label>Privilegija:</label></td></tr>			
				<tr><td>
					<select  class="btn" name="privilegija">
					  <option value="Administrator">Administrator</option>
					  <option value="User">User</option>
					  <option value="EventManager">Event Manager</option>
					  <option value="IncidentManager">Incident Manager</option>
					  <option value="RequestManager">Request Manager</option>
					  <option value="SupplierManager">Supplier Manager</option>
					  <option value="SuperManager">Super Manager</option>				  
					</select>
				</td></tr> 				
				
				<tr><td><label>Odjel:</label></td></tr>
				<tr><td>
					<select class="btn" name="Odjel">
					  <?php
	
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
			
		mysql_close();
		
	}
	catch (Exception $e) 
	{
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}

?>
			  
					</select>
				</td></tr>
				
				<tr><td style="text-align:right;"><input type="submit" class="btn btn-success" value="Spasi"/> </td></tr>
			</form>
		</table>
	</center>
</body>
</html>
