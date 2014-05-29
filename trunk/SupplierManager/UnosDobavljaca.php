<?php
	
	if (isset($_POST["naziv"]))
	{
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("service_desk_db") or die(mysql_error());
		
		$upit = "INSERT INTO dobavljaci(naziv,grad,adresa, vrsta) VALUES ('".$_POST["naziv"]."' , '".$_POST["grad"]."' , '".$_POST["adresa"]."', '".$_POST["vrsta"]."')";
		mysql_query($upit) or die(mysql_error());
		header("Location: http://localhost/PIS/SupplierManager/DobavljacU.php");
		
		
		
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
	</head>
	<body>
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
						    
							
							
							
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="UnosDobavljaca.php">
								<div class="form-group">
									<label class="col-sm-3 control-label">Naziv dobavljaca:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="naziv" id="naziv"  value="KimTech"></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Grad:</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="grad" id="grad" value="Vitez"  ></div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Adresa</label>
									<div class="col-sm-4"><input type="text" class="form-control" name="adresa" id="adresa"  value="Adresa"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Vrsta dobavljaca:</label>
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