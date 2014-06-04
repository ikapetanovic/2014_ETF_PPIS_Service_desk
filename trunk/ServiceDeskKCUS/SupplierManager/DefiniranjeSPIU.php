<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	if (isset($_POST["vrijednost"]) && isset($_POST["trajanje"]) && isset($_POST["grad"]))
	{
		$SQLUpit = "INSERT INTO specificno_pravilo SET vrijednost = ". $_POST["vrijednost"].", trajanje = ".$_POST["trajanje"].", grad = '".$_POST["grad"]."';";
		mysql_query($SQLUpit);
		echo "<script>alert(\"Definiranje specifičnog pravila i uslova je uspješno.\"); window.location = \"DefiniranjeSPIU.php\";</script>";
	}
	mysql_close() or die(mysql_error());
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Supplier Manager</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body >
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
							<li><a class="navbar-brand" href="IdentifikacijaPPIPP.php">Nazad</a></li>
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
						<div class="panel-heading">Definiranje specifičnih pravila i uslova</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="DefiniranjeSPIU.php">
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Maksimalna vrijednost(*):</label>
									<div class="col-sm-4"><input type="number" min="1" class="form-control" name="vrijednost" id="vrijednost" placeholder="KM"></div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Trajanje ugovora(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="trajanje">
											<option value="20000">Neograničeno</option>
											<option value="6">6 mjeseci</option>
											<option value="12">1 godina</option>
											<option value="24">2 godine</option>
											<option value="36">3 godine</option>
											<option value="48">4 godine</option>
											<option value="60">5 godina</option>
											
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Grad dobavljača(*): </label>
									<div class="col-sm-4"><input type="text" class="form-control" name="grad" id="grad" ></div>
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
		<script>
		</script>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>