<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	$SQLUpit = "SELECT * FROM dogadaj WHERE id = ".$_POST["idDogadaja"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$dogadaj = mysql_fetch_assoc($rezultatSQLUpita);
	if (isset($_POST["naziv"]) && isset($_POST["opis"]))
	{
		$SQLUpit = "UPDATE dogadaj SET naziv = '".$_POST["naziv"]."', kategorija = '".$_POST["kategorija"]."', podkategorija = '".$_POST["podkategorija"]."', prioritet = '".$_POST["prioritet"]."', opis = '".$_POST["opis"]."' WHERE id = ".$_POST["idDogadaja"].";";
		mysql_query($SQLUpit);
		echo "<script>alert(\"Ažuriranje događaja je uspješno.\"); window.location = \"PregledanjeDogadaja.php\";</script>";
	}
	mysql_close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>User</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body onload="ucitajPodatke(); onemoguciSlanje();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
							<li><a class="navbar-brand" href="PregledanjeDogadaja.php">Nazad</a></li>
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
						<div class="panel-heading">Ažuriranje događaja</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="AzuriranjeDogadaja.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Naziv(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="naziv" id="naziv" placeholder="<?php echo $dogadaj["naziv"];?>" onblur="validirajNaziv();"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Kategorija(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="kategorija" id="kategorija" onblur="odrediPodkategorije();">
											<option value="Softver">Softver</option>
											<option value="Hardver">Hardver</option>
											<option value="Oprema">Oprema</option>
											<option value="Pristup sistemu">Pristup sistemu</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Podkategorija(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="podkategorija" id="podkategorija"></select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Utjecaj(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="utjecaj" id="utjecaj" onblur="odrediPrioritet();">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Hitnost(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="hitnost" id="hitnost" onblur="odrediPrioritet();">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Prioritet(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="prioritet" id="prioritet"></select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Opis:</label>
									<div class="col-sm-4"><textarea class="form-control" name="opis" id="opis" rows="5" placeholder="<?php echo $dogadaj["opis"];?>"></textarea></div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><input type="hidden" name="idDogadaja" value="<?php echo $dogadaj["id"]; ?>"/><button type="submit" class="btn btn-primary" id="azuriraj">Ažuriraj</button></div>
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
			function ucitajPodatke() {
				var podkategorija = document.getElementById("podkategorija");
				podkategorija.innerHTML = '<option>Instalacija</option><option>Modifikacija</option>';
				var prioritet = document.getElementById("prioritet");
				prioritet.innerHTML = "<option>Kritičan</option>";
			}
			function omoguciSlanje() {
				if (validnostNaziva == true)
					document.getElementById("azuriraj").style.display = "block";
			}
			function onemoguciSlanje() {
				document.getElementById("azuriraj").style.display = "none";
			}
			function odrediPodkategorije() {
				var kategorija = document.getElementById("kategorija");
				var podkategorija = document.getElementById("podkategorija");
				if (kategorija.value == "Softver") {
					podkategorija.innerHTML = '<option value="Instalacija">Instalacija</option><option value="Modifikacija">Modifikacija</option>';
				} else if (kategorija.value == "Hardver" || kategorija.value == "Oprema") {
					podkategorija.innerHTML = '<option value="Popravka">Popravka</option><option value="Nabavka">Nabavka</option>';
				} else if (kategorija.value == "Pristup sistemu") {
					podkategorija.innerHTML = '<option value="Uređivanje korisničkog računa">Uređivanje korisničkog računa</option><optionvalue="Brisanje korisničkog računa">Brisanje korisničkog računa</option>';
				}
			}
			function odrediPrioritet() {
				var utjecaj = document.getElementById("utjecaj");
				var hitnost = document.getElementById("hitnost");
				var prioritet = document.getElementById("prioritet");
				if (utjecaj.value == "1" && hitnost.value == "1") {
					prioritet.innerHTML = "<option>Kritičan</option>";
				} else if (utjecaj.value == "1" && hitnost.value == "2" || utjecaj.value == "2" && hitnost.value == "1") {
					prioritet.innerHTML = "<option>Visok</option>";
				} else if (utjecaj.value == "2" && hitnost.value == "2" || utjecaj.value == "1" && hitnost.value == "3" || utjecaj.value == "3" && hitnost.value == "1") {
					prioritet.innerHTML = "<option>Srednji</option>";
				} else if (utjecaj.value == "2" && hitnost.value == "3" || utjecaj.value == "3" && hitnost.value == "2") {
					prioritet.innerHTML = "<option>Nizak</option>";
				} else if (utjecaj.value == "3" && hitnost.value == "3") {
					prioritet.innerHTML = "<option>U planu</option>";
				}
			}
			var validnostNaziva = false;
			var naziv = document.getElementById("naziv");
			function validirajNaziv() {
				validnostNaziva = true;
				if (naziv.value.length == 0)
					validnostNaziva = false;
				if (validnostNaziva == true)
				{
					naziv.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					naziv.style.backgroundColor = "red";
					naziv.focus();
					onemoguciSlanje();
				}
			}
		</script>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>