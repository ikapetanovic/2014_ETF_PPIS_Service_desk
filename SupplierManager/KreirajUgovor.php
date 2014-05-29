<?php
	
	if (isset($_POST["naziv"]))
	{
		if ($_POST["period"] < 12)
		{
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("service_desk_db") or die(mysql_error());
		
		//$pocetniDatum = $_POST["pocetniDatum"];
		$upit = "INSERT INTO ugovori( naziv, vrsta, broj, vrijednost, pocetni_datum, krajnji_datum, period_obnavljanja, opis) 
		VALUES ('".$_POST["naziv"]."',  '".$_POST["vrsta"]."', '".$_POST["brUgovora"]."', '".$_POST["vrijednost"]."', '".$_POST["pocetniDatum"]."', '".$_POST["krajnjiDatum"]."', '".$_POST["period"]."' , '".$_POST["opis"]."')";
		mysql_query($upit) or die(mysql_error());
		
		mysql_close() or die(mysql_error());
		header("Location: http://localhost/PIS/SupplierManager/UgovorU.php");
		}
		else {
		header("Location: http://localhost/PIS/SupplierManager/UgovorN.php");
		
		}
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Ugovor</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body onload="ProcjeniRizik();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="Ugovori.php">Nazad</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="navbar-brand">Prijavljeni ste kao: Mensur Mandzuka</li>
							<li><a class="navbar-brand" href="#">Odjava</a></li>
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
									<label class="col-sm-3 control-label">Naziv dobavljaca:</label>
									<div class="col-sm-4">
										
										
										
										<?php
											mysql_connect("localhost", "root", "") or die(mysql_error());
											mysql_select_db("service_desk_db") or die(mysql_error());
											$SQLUpit = "SELECT * FROM dobavljaci";
											$rezultatSQLUpita = mysql_query($SQLUpit) or die(mysql_error());
											
											echo "<select class=\"form-control\" name=\"naziv\" id=\"naziv\">";
											while ($pravilo = mysql_fetch_assoc($rezultatSQLUpita))
											{
										
													echo "<option>".$pravilo["naziv"]."</option>";
										
											}
											echo "</select>";
											mysql_close() or die(mysql_error());
										?>
										
											
											
										
									</div>
								</div>
								
								
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrsta robe:</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrsta" id="vrsta">
											<option>Hardver</option>
											<option>Softver</option>
											<option>Logistika</option>
											
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Broj ugovora:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="brUgovora" id="brUgovora"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrijednost:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="vrijednost" placeholder="KM" id="vrijednost"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Efektivni datum:</label>
									<div class="col-sm-4"><input type="date" class="form-control" name="pocetniDatum" id="pocetniDatum"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Datum isteka ugovora: </label>
									<div class="col-sm-4"><input type="date" class="form-control" name="krajnjiDatum" id="krajnjiDatum"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Period obnavaljanja (u mjesecima): </label>
									<div class="col-sm-4"><input type="number" min="0" max="120" class="form-control" name="period" id="period"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Opis: </label>
									<div class="col-sm-4"><textarea class="form-control" name="opis" id="opis"></textarea></div>
								</div>
								
								
								
								
								
								
								
								
								<div class="form-group">
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