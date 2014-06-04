<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
						<div class="panel-heading">Izbornik</div>
						<div class="panel-body">
							<ul class="nav navbar-nav">
								<li><a href="IdentifikacijaPPIPP.php">Identifikacija poslovnih potreba i priprema poslovanja</a></li><br>
								<li><a href="UnosDobavljaca.php">Unos novih dobavljača</a></li><br>
								<li><a href="EvaluacijaNovihDobavljaca.php">Evaluacija novih dobavljača</a></li><br>
								<li><a href="Ugovori.php">Kreiranje i pregled ugovora</a></li><br>
								<li><a href="Performanse.php">Upravljanje performansama dobavljača i ugovora</a></li><br>
								
							</ul>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>