<?php
	if(isset($_POST["korisnickoIme"]) && isset($_POST["korisnickaSifra"]))
	{
		mysql_connect("localhost", "root", "");
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_kcus_db");
		$SQLUpit = "SELECT id, korisnicko_ime, korisnicka_sifra, korisnicka_grupa FROM korisnicki_racun;";
		$rezultatSQLUpita = mysql_query($SQLUpit);
		while ($korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita))
		{
			if(($korisnickiRacun["korisnicko_ime"] == $_POST["korisnickoIme"]) && ($korisnickiRacun["korisnicka_sifra"] == $_POST["korisnickaSifra"]))
			{
				switch ($korisnickiRacun["korisnicka_grupa"])
				{
					case "Administrator":
						header("Location: ../Administrator/Pocetna.php");
						break;
					case "User":
						header("Location: ../User/Pocetna.php");
						break;
					case "Event Manager":
						header("Location: ../EventManager/Pocetna.php");
						break;
					case "Request Manager":
						header("Location: ../RequestManager/Pocetna.php");
						break;
					case "Incident Manager":
						header("Location: ../IncidentManager/Pocetna.php");
						break;
					case "Supplier Manager":
						header("Location: ../SupplierManager/Pocetna.php");
						break;
					case "Super Manager":
						header("Location: ../SuperManager/Pocetna.php");
						break;
				}
				session_start();
				$_SESSION["id"] =  $korisnickiRacun["id"];
			}
			else
			{
				echo "<script>alert(\"Prijavljivanje korisničkog računa nije uspješno. Uneseni su neispravni korisnički podaci.\"); window.location = \"Pocetna.php\";</script>";
			}
		}
		mysql_close();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Login</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body onload="onemoguciSlanje();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="jumbotron">
				<p>
					<div class="panel panel-primary">
						<div class="panel-heading">Korisnički podaci:</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="Pocetna.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Korisničko ime:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="korisnickoIme" id="korisnickoIme" onblur="validirajKorisnickoIme();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Korisnička šifra:</label>
									<div class="col-sm-4"><input type="password" class="form-control" name="korisnickaSifra" id="korisnickaSifra" onblur="validirajKorisnickuSifru();"></div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="prijavi">Prijavi</button></div>
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
			function omoguciSlanje() {
				if (validnostKorisnickogImena == true && validnostKorisnickeSifre == true)
					document.getElementById("prijavi").style.display = "block";
			}
			function onemoguciSlanje() {
				document.getElementById("prijavi").style.display = "none";
			}
			var validnostKorisnickogImena = false;
			var korisnickoIme = document.getElementById("korisnickoIme");
			function validirajKorisnickoIme() {
				validnostKorisnickogImena = true;
				if (korisnickoIme.value.length == 0)
					validnostKorisnickogImena = false;
				if (validnostKorisnickogImena == true)
				{
					korisnickoIme.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					korisnickoIme.style.backgroundColor = "red";
					korisnickoIme.focus();
					onemoguciSlanje();
				}
			}
			var validnostKorisnickeSifre = false;
			var korisnickaSifra = document.getElementById("korisnickaSifra");
			function validirajKorisnickuSifru() {
				validnostKorisnickeSifre = true;
				if (korisnickaSifra.value.length == 0)
					validnostKorisnickeSifre = false;
				if (validnostKorisnickeSifre == true)
				{
					korisnickaSifra.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					korisnickaSifra.style.backgroundColor = "red";
					korisnickaSifra.focus();
					onemoguciSlanje();
				}
			}
		</script>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>