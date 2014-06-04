<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	$SQLUpit = "SELECT * FROM dobavljaci WHERE id = ".$_POST["idDobavljaca"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$dobavljac = mysql_fetch_assoc($rezultatSQLUpita);
	if (isset($_POST["naziv"]))
	{
		mysql_connect("localhost", "root", "");
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_kcus_db");
		$SQLUpit = "UPDATE dobavljaci SET dostupnost = '".$_POST["dostupnost"]."', "."vrijednost = '".$_POST["vrijednost"]."', "."utjecaj = '".$_POST["utjecaj"]."', "."rizik = '".$_POST["rizik"]."', "."kategorija = '".$_POST["kategorija"]."'"." WHERE id = ".$dobavljac["id"].";";
		mysql_query($SQLUpit) or die(mysql_error());
		echo "<script>alert(\"Evaluiranje dobavljača je uspješno. Dobavljač je prošao evaluaciju.\"); window.location = \"EvaluacijaNovihDobavljaca.php\";</script>";
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
	<body onload="ProcijeniRizik();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
							<li><a class="navbar-brand" href="EvaluacijaNovihDobavljaca.php">Nazad</a></li>
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
						<div class="panel-heading">Evaluacija dobavljača</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="EvaluacijaDobavljaca.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Naziv dobavljača:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="naziv" id="naziv" readonly placeholder="<?php echo $dobavljac["naziv"]; ?>"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Grad:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="grad" id="grad" readonly placeholder="<?php echo $dobavljac["grad"]; ?>"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Adresa</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="adresa" id="adresa" readonly placeholder="<?php echo $dobavljac["adresa"]; ?>"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrsta dobavljača:</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrsta" id="vrsta" disabled>
											<option><?php echo $dobavljac["vrsta"]; ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Dostupnost proizvoda(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="dostupnost" id="dostupnost" onchange="ProcijeniRizik();">
											<option value="1">Visoka</option>
											<option value="2">Srednja</option>
											<option value="3">Niska</option>
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrijednost proizvoda(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrijednost" id="vrijednost" onchange="ProcijeniRizik();">
											<option value="3">Visoka</option>
											<option value="2">Srednja</option>
											<option value="1">Niska</option>
											
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Utjecaj(*):</label>
									<div class="col-sm-4">
										<select class="form-control" name="utjecaj" id="utjecaj" onchange="ProcijeniRizik();">
											<option value="3">Visok</option>
											<option value="2">Srednji</option>
											<option value="1">Nizak</option>
											
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Rizik:</label>
									<div class="col-sm-4">
										<select  class="form-control" name="rizik" id="rizik" readonly>
											<option id="ekstreman" >Ekstreman</option>
											<option id="visok" >Visok</option>
											<option id="srednji">Srednji</option>
											<option id="nizak">Nizak</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Kategorija:</label>
									<div class="col-sm-4">
										<select class="form-control" name="kategorija" id="kategorija" readonly>
											<option id="commodity">Commodity</option>
											<option id="operativni">Operativni</option>
											<option id="takticki">Taktički</option>
											<option id="strateski">Strateški</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><input type="hidden" name="idDobavljaca" id="idDobavljaca" value="<?php echo $dobavljac["id"]; ?>"/><button type="submit" class="btn btn-primary" id="dugmePosalji">Odaberi</button></div>
										
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
		
		function ProcijeniRizik()
		{
			var dostupnost = parseInt(document.getElementById("dostupnost").value);
			var vrijednost = parseInt(document.getElementById("vrijednost").value);
			var uticaj = parseInt(document.getElementById("utjecaj").value);
			
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