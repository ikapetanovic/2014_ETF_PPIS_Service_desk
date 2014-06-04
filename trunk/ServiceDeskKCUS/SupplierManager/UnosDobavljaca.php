<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	mysql_close();
	if (isset($_POST["naziv"]) && isset($_POST["grad"]) && isset($_POST["adresa"]))
	{
		mysql_connect("localhost", "root", "");
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_kcus_db");
		$SQLUpit = "INSERT INTO dobavljaci(naziv, grad, adresa, vrsta) VALUES ('".$_POST["naziv"]."', '".$_POST["grad"]."', '".$_POST["adresa"]."','".$_POST["vrsta"]."');";
		mysql_query($SQLUpit);
		echo "<script>alert(\"Kreiranje dobavljača je uspješno.\"); window.location = \"UnosDobavljaca.php\";</script>";
		mysql_close();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Supplier Manager</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
							<li><a class="navbar-brand" href="Pocetna.php">Nazad</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="navbar-brand">Prijavljeni Ste kao: <?php echo $korisnickiRacun["ime"]." ".$korisnickiRacun["prezime"]; ?></li>
							<li><a class="navbar-brand" href="../Login/Pocetna.php">Odjava</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="jumbotron">
				<p>
					<div class="panel panel-primary">
						<div class="panel-heading">Unos novih dobavljača</div>
						    
							
							
							
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="UnosDobavljaca.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Naziv dobavljača(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="naziv" id="naziv"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Grad(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="grad" id="grad"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Adresa(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="adresa" id="adresa"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrsta dobavljača(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrsta" id="vrsta" >
											<option>Hardver</option>
											<option>Softver</option>
											<option>Logistika</option>
										</select>
									</div>
								</div>
								
								
								
								
								
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="dugmePosalji">Snimi</button></div>
										
								</div>
								
								
								
								
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		</body>