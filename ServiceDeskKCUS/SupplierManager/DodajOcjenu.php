<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	mysql_close();
	if (isset($_GET["fluktuacija"]) && isset($_GET["iddobavljaca"]))
	{
		mysql_connect("localhost", "root", "");
		mysql_set_charset("utf8");
		mysql_select_db("service_desk_kcus_db");
		$datum = date('Y-m-d');
		$upit = "INSERT INTO performanse (id_dobavljaca, datum,  navrijeme, pospecifikaciji, bezfluktuacija, nepredvidjene) values ('".intval($_GET["iddobavljaca"])."', '".$datum."', '".$_GET["naVrijeme"]."' , '".$_GET["poSpecifikaciji"]."', '".$_GET["fluktuacija"]."' , '".$_GET["odgovor"]."')";
		mysql_query($upit);
		mysql_close();
		echo "<script>alert(\"Ocjenjivanje dobavljača je uspješno.\"); window.location = \"Performanse.php\";</script>";
	}
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
							<li><a class="navbar-brand" href="Performanse.php">Nazad</a></li>
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
					
						
						
						
							
							
								
								<?php
									if (isset($_GET["id"]))
									{
										$id = $_GET["id"];
										mysql_connect("localhost", "root", "");
										mysql_set_charset("utf8");
										mysql_select_db("service_desk_kcus_db");
										$SQLUpit = "SELECT * FROM dobavljaci where id=\"" . $id . "\"";
										$rezultatSQLUpita = mysql_query($SQLUpit);
										$pravilo = mysql_fetch_assoc($rezultatSQLUpita);
										echo "<div class=\"panel-heading\">" .$pravilo["naziv"] .     "</div>";
										mysql_close();
									}
								?>
								
								<div class="panel-body">
								
								<form method="get" class="form-horizontal" action="">
								
								
								
									 
									 <?php
									 
									 echo "<div class=\"form-group\">";
									
									 
									 if (isset($_GET["id"]))
									 {
									 $id= $_GET["id"];
									echo "<div class=\"col-sm-4\"><input class=\"form-control\" type=\"hidden\"  name=\"iddobavljaca\" id=\"iddobavljaca\" value=\"". $id . "\">" .   "</div>";
									echo "</div>";
									}
									?>
								
								
								
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Isporučuje na vrijeme:</label>
									<div class="col-sm-4">
										<select class="form-control" name="naVrijeme">
											<option value="1" >1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Isporučuje po specifikaciji</label>
									<div class="col-sm-4">
										<select class="form-control" name="poSpecifikaciji">
											<option value="1" >1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Bez fluktuacija cijena:</label>
									<div class="col-sm-4">
										<select class="form-control" name="fluktuacija">
											<option value="1" >1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Brzo odgovara na nepredviđene situacije:</label>
									<div class="col-sm-4">
										<select class="form-control" name="odgovor">
											<option value="1" >1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="dugmePosalji">Pošalji</button></div>
								</div>
								
								
								</form>
								
								
								</div>
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