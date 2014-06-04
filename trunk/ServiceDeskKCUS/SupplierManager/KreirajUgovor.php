<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	mysql_close();
	if (isset($_POST["naziv"]))
	{
		if ($_POST["period"] < 12)
		{
			mysql_connect("localhost", "root", "");
			mysql_set_charset("utf8");
			mysql_select_db("service_desk_kcus_db");
			$upit = "INSERT INTO ugovori( naziv, vrsta, broj, vrijednost, pocetni_datum, krajnji_datum, period_obnavljanja, opis) 
			VALUES ('".$_POST["naziv"]."',  '".$_POST["vrsta"]."', '".$_POST["brUgovora"]."', '".$_POST["vrijednost"]."', '".$_POST["pocetniDatum"]."', '".$_POST["krajnjiDatum"]."', '".$_POST["period"]."' , '".$_POST["opis"]."')";
			mysql_query($upit);
			mysql_close();
			echo "<script>alert(\"Kreiranje ugovora je uspješno.\"); window.location = \"KreirajUgovor.php\";</script>";
		}
		else
		{
			echo "<script>alert(\"Kreiranje ugovora nije uspješno.\"); window.location = \"KreirajUgovor.php\";</script>";
		}
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
	<body onload="ProcjeniRizik();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
							<li><a class="navbar-brand" href="Ugovori.php">Nazad</a></li>
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
						<div class="panel-heading">Kreiraj ugovor</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="">
								<div class="form-group">
									<label class="col-sm-3 control-label">Naziv dobavljača(*):</label>
									<div class="col-sm-4">
										<?php
											mysql_connect("localhost", "root", "");
											mysql_set_charset("utf8");
											mysql_select_db("service_desk_kcus_db");
											$SQLUpit = "SELECT * FROM dobavljaci";
											$rezultatSQLUpita = mysql_query($SQLUpit);
											echo "<select class=\"form-control\" name=\"naziv\" id=\"naziv\">";
											while ($dobavljac = mysql_fetch_assoc($rezultatSQLUpita))
											{
													echo "<option>".$dobavljac["naziv"]."</option>";
											}
											echo "</select>";
											mysql_close();
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrsta robe(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrsta" id="vrsta">
											<option>Hardver</option>
											<option>Softver</option>
											<option>Logistika</option>
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Broj ugovora(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="brUgovora" id="brUgovora"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrijednost(*):</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="vrijednost" placeholder="KM" id="vrijednost"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Efektivni datum(*):</label>
									<div class="col-sm-4"><input type="date" class="form-control" name="pocetniDatum" id="pocetniDatum"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Datum isteka ugovora(*): </label>
									<div class="col-sm-4"><input type="date" class="form-control" name="krajnjiDatum" id="krajnjiDatum"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Period obnavaljanja (u mjesecima)(*): </label>
									<div class="col-sm-4"><input type="number" min="0" max="120" class="form-control" name="period" id="period"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Opis: </label>
									<div class="col-sm-4"><textarea class="form-control" name="opis" id="opis"></textarea></div>
								</div><div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="dugmePosalji">Posalji</button></div>
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
		
		function ProcjeniRizik()
		{
			var dostupnost = parseInt(document.getElementById("dostupnost").value);
			var vrijednost = parseInt(document.getElementById("vrijednost").value);
			var uticaj = parseInt(document.getElementById("uticaj").value);
			
			var sumaRizik = dostupnost + vrijednost + uticaj;
			
			if (sumaRizik == 9) {
			document.getElementById("ekstreman").selected = "true";
			document.getElementById("strateski").selected = "true";
			}
			else if (sumaRizik <9 && sumaRizik >6) {
			document.getElementById("visok").selected = "true";
			document.getElementById("takticki").selected = "true";
			}
			
			else if (sumaRizik>4 && sumaRizik<7) {
			document.getElementById("srednji").selected = "true";
			document.getElementById("operativni").selected = "true";
			}
			
			else {
			document.getElementById("nizak").selected = "true";
			document.getElementById("commodity").selected = "true";
			}
			
			
			
			
			
		}
		</script
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
		</body>