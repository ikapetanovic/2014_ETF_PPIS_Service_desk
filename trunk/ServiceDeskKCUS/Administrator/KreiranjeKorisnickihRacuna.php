<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	if (isset($_POST["ime"]) && isset($_POST["prezime"]) && isset($_POST["brojTelefona"]) && isset($_POST["emailAdresa"]) && isset($_POST["odjel"]) && isset($_POST["korisnickoIme"]) && isset($_POST["korisnickaSifra"]))
	{
		$SQLUpit = "INSERT INTO korisnicki_racun SET ime = '".$_POST["ime"]."', prezime = '".$_POST["prezime"]."', broj_telefona = '".$_POST["brojTelefona"]."', email_adresa = '".$_POST["emailAdresa"]."', odjel = '".$_POST["odjel"]."', korisnicko_ime = '".$_POST["korisnickoIme"]."', korisnicka_sifra = '".$_POST["korisnickaSifra"]."', korisnicka_grupa = '".$_POST["korisnickaGrupa"]."';";
		mysql_query($SQLUpit);
		echo "<script>alert(\"Kreiranje korisničkog računa je uspješno.\"); window.location = \"KreiranjeKorisnickihRacuna.php\";</script>";
	}
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Administrator</title>
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
							<li><a class="navbar-brand" href="UpravljanjeKorisnickihRacuna.php">Nazad</a></li>
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
						<div class="panel-heading">Kreiranje korisničkih računa</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="KreiranjeKorisnickihRacuna.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Ime(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="ime" id="ime" onblur="validirajIme();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Prezime(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="prezime" id="prezime" onblur="validirajPrezime();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Broj telefona(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="brojTelefona" id="brojTelefona" onblur="validirajBrojTelefona();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Email adresa(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="emailAdresa" id="emailAdresa" onblur="validirajEmailAdresu();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Odjel(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="odjel" id="odjel" onblur="validirajOdjel();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Korisničko ime(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="korisnickoIme" id="korisnickoIme" onblur="validirajKorisnickoIme();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Korisnička šifra(*):</label>
									<div class="col-sm-4"><input type="password" class="form-control" name="korisnickaSifra" id="korisnickaSifra" onblur="validirajKorisnickuSifru();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Korisnička grupa(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="korisnickaGrupa" id="korisnickaGrupa">
											<option>Administrator</option>
											<option>User</option>
											<option>Event Manager</option>
											<option>Request Manager</option>
											<option>Incident Manager</option>
											<option>Supplier Manager</option>
											<option>Super Manager</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="kreiraj">Kreiraj</button></div>
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
			function omoguciSlanje() {
				if (validnostImena == true && validnostPrezimena == true && validnostBrojaTelefona == true && validnostEmailAdrese == true && validnostOdjela == true && validnostKorisnickogImena == true && validnostKorisnickeSifre == true)
					document.getElementById("kreiraj").style.display = "block";
			}
			function onemoguciSlanje() {
				document.getElementById("kreiraj").style.display = "none";
			}
			var validnostImena = false;
			var ime = document.getElementById("ime");
			function validirajIme() {
				validnostImena = true;
				if (ime.value.length == 0)
					validnostImena = false;
				if (validnostImena == true)
				{
					ime.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					ime.style.backgroundColor = "red";
					ime.focus();
					onemoguciSlanje();
				}
			}
			var validnostPrezimena = false;
			var prezime = document.getElementById("prezime");
			function validirajPrezime() {
				validnostPrezimena = true;
				if (prezime.value.length == 0)
					validnostPrezimena = false;
				if (validnostPrezimena == true)
				{
					prezime.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					prezime.style.backgroundColor = "red";
					prezime.focus();
					onemoguciSlanje();
				}
			}
			var validnostBrojaTelefona = false;
			var brojTelefona = document.getElementById("brojTelefona");
			function validirajBrojTelefona() {
				validnostBrojaTelefona = true;
				if (brojTelefona.value.length == 0)
					validnostBrojaTelefona = false;
				if (validnostBrojaTelefona == true)
				{
					brojTelefona.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					brojTelefona.style.backgroundColor = "red";
					brojTelefona.focus();
					onemoguciSlanje();
				}
			}
			var validnostEmailAdrese = false;
			var emailAdresa = document.getElementById("emailAdresa");
			function validirajEmailAdresu() {
				validnostEmailAdrese = true;
				if (emailAdresa.value.length == 0)
					validnostEmailAdrese = false;
				if (validnostEmailAdrese == true)
				{
					emailAdresa.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					emailAdresa.style.backgroundColor = "red";
					emailAdresa.focus();
					onemoguciSlanje();
				}
			}
			var validnostOdjela = false;
			var odjel = document.getElementById("odjel");
			function validirajOdjel() {
				validnostOdjela = true;
				if (odjel.value.length == 0)
					validnostOdjela = false;
				if (validnostOdjela == true)
				{
					odjel.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					odjel.style.backgroundColor = "red";
					odjel.focus();
					onemoguciSlanje();
				}
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