<?php
	session_start();
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "SELECT ime, prezime FROM korisnicki_racun WHERE id = ".$_SESSION["id"].";";
	$rezultatSQLUpita = mysql_query($SQLUpit);
	$korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita);
	mysql_close();
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
							<li><a class="navbar-brand" href="Pocetna.php">Nazad</a></li>
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
						<div class="panel-heading">Pregled dobavljača</div>
						<div class="panel-body">
						
						<form method="POST" class="form-horizontal" action="">
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Kategorija:</label>
									<div class="col-sm-4">
										<select class="form-control" name="kategorija">
											<option id="commodity">Commodity</option>
											<option id="operativni">Operativni</option>
											<option id="takticki">Taktički</option>
											<option id="strateski">Strateški</option>
										</select>
									</div>
									<div class="col-sm-offset-1"><button type="submit" class="btn btn-primary" id="dugmePosalji">Filter</button></div>
								</div>
								
								
									
								
							</form>
							
							<table class="table table-bordered">
								<tr>
									<th class="info">Naziv</th>
									<th class="info">Grad</th>
									<th class="info">Adresa</th>
									<th class="info">Rizik</th>
									<th class="info">Kategorija</th>
									
								</tr>
								<?php
									if (isset($_POST["kategorija"]))
									{
									$categ = $_POST["kategorija"];
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT * FROM dobavljaci WHERE kategorija=\"" . $categ . "\"";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($pravilo = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$pravilo["naziv"]."</td>";
										echo "<td>".$pravilo["grad"]."</td>";
										echo "<td>".$pravilo["adresa"]."</td>";
										echo "<td>".$pravilo["rizik"]."</td>";
										echo "<td>".$pravilo["kategorija"]."</td>";
										echo "<td>";
										echo "<form action=\"DodajOcjenu.php\" method=\"get\">" .
										"<input type=\"hidden\" name=\"id\" value=\"" . $pravilo["id"] . "\" >" .				
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"+\" />" .							
										"</form>";
										echo "</td>";
										
										echo "<td>";
										echo "<form action=\"Pregled.php\" method=\"get\">" .
										"<input type=\"hidden\" name=\"id\" value=\"" . $pravilo["id"] . "\" >" .				
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"Pregledaj sve\" />" .							
										"</form>";
										
										echo "</td>";
										
										
										
										
										echo "</tr>";
									}
									mysql_close();
									}
								?>
							</table>
							
						</div>
					</div>
				</p>
			</div>
		</div>
		
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>