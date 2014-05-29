<?php
	
	if (isset($_POST["naziv"]))
	{
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("service_desk_db") or die(mysql_error());
		if ($_POST["grad"] == "Sarajevo") {
		$upit = "UPDATE dobavljaci SET dostupnost =\"" . $_POST["dostupnost"] . "\"," .  
		" vrijednost=\"" . $_POST["vrijednost"] . "\"," .
		" uticaj=\"" . $_POST["uticaj"] . "\"," .
		" rizik=\"" . $_POST["rizik"] . "\"," .
		" kategorija=\"" . $_POST["kategorija"] . "\"" .
		" WHERE naziv = \"" . $_POST["naziv"] . "\";";
		//$upit = "UPDATE INTO dobavljaci(naziv,grad,adresa, vrsta, dostupnost, vrijednost, uticaj, rizik, kategorija) VALUES ('".$_POST["naziv"]."' , '".$_POST["grad"]."' , '".$_POST["adresa"]."', '".$_POST["vrsta"]."', '".$_POST["dostupnost"]."', '".$_POST["vrijednost"]."' , '".$_POST["uticaj"]."' , '".$_POST["rizik"]."' , '".$_POST["kategorija"]."')";
		mysql_query($upit) or die(mysql_error());
		header("Location: http://localhost/PIS/SupplierManager/DobavljacU.php");
		}
		else {
		header("Location: http://localhost/PIS/SupplierManager/DobavljacN.php");
		}
		
		mysql_close() or die(mysql_error());
		
	}
	
	
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Evaluacija</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
		
		<?php
		 if (isset($_GET["id"]))
		{
		
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("service_desk_db") or die(mysql_error());
		$upit = "SELECT naziv,grad,adresa, vrsta from dobavljaci where id=". $_GET["id"] . " AND kategorija IS NULL";
		$rezultatUpita = mysql_query($upit) or die(mysql_error());
		$naziv = "";
		$grad = "";
		$adresa = "";
		$vrsta = "";
		$sljedeci = ($_GET["id"]) +1 ;
		$prethodni= ($_GET["id"]) -1;
		
		
		while ($pravilo = mysql_fetch_assoc($rezultatUpita))
		{
			$naziv = $pravilo["naziv"];
			$grad = $pravilo["grad"];
			$adresa = $pravilo["adresa"];
			$vrsta = $pravilo["vrsta"];
		}
		
		}
	?>
	</head>
	<body onload="ProcjeniRizik();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="Pocetna.php">Nazad</a></li>
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
						<div class="panel-heading">Evaluacija novih dobavljaca</div>
						     
							 <br/>
							 <?php
							 
							  
							echo "<form action=\"Evaluacija.php\" method=\"get\">" .
									
										"<input type=\"hidden\" name=\"id\" value=\"" . $prethodni . "\" >" .
										"<div class=\"pull-left\">" .										
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"Prethodni\" />" .	
										"</div>".
										"</form>";
										
						
							
							echo "<form action=\"Evaluacija.php\" method=\"get\">" .
									
										"<input type=\"hidden\" name=\"id\" value=\"" . $sljedeci . "\" >" .
										"<div class=\"pull-right\">" .										
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"Sljedeci\" />" .	
										"</div>".
										"</form>";
										
							?>
							 
							
							
							<br/>
							
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="Evaluacija.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Naziv dobavljaca:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="naziv" id="naziv" readonly value="<?php echo $naziv ?>"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Grad:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="grad" id="grad" value="<?php echo $grad ?>" readonly ></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Adresa</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="adresa" id="adresa" readonly value="<?php echo $adresa ?>"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrsta dobavljaca:</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrsta" id="<?php echo $vrsta ?>" disabled>
											<option>Hardver</option>
											<option>Softver</option>
											<option>Logistika</option>
											
										</select>
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Dostupnost proizvoda:</label>
									<div class="col-sm-4">
										<select class="form-control" name="dostupnost" id="dostupnost" onchange="ProcjeniRizik();">
											<option value="1">Siroka</option>
											<option value="2">Srednja</option>
											<option value="3">Niska</option>
											
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrijednost proizvoda:</label>
									<div class="col-sm-4">
										<select class="form-control" name="vrijednost" id="vrijednost" onchange="ProcjeniRizik();">
											<option value="3">Visoka</option>
											<option value="2">Srednja</option>
											<option value="1">Niska</option>
											
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Uticaj:</label>
									<div class="col-sm-4">
										<select class="form-control" name="uticaj" id="uticaj" onchange="ProcjeniRizik();">
											<option value="3">Visok</option>
											<option value="2">Srednji</option>
											<option value="1">Nizak</option>
											
										</select>
									</div>
								</div>
								
							    
								
								
						
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Rizik:</label>
									<div class="col-sm-4">
										<select  class="form-control" name="rizik" readonly>
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
										<select class="form-control" name="kategorija" readonly>
											<option id="commodity">Commodity</option>
											<option id="operativni">Operativni</option>
											<option id="takticki">Takticki</option>
											<option id="strateski">Strateski</option>
										</select>
									</div>
								</div>
								
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="dugmePosalji">Odaberi</button></div>
										
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