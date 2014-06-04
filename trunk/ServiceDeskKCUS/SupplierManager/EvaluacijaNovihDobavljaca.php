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
	<body>
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
						<div class="panel-heading">Evaluacija novih dobavljača</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Naziv:</th>
									<th class="info">Grad:</th>
									<th class="info">Adresa:</th>
									<th class="info">Vrsta:</th>
									<th class="info">Rizik:</th>
									<th class="info">Kategorija:</th>
									<th class="info">Evaluiranje:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT * FROM dobavljaci;";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($dobavljac = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$dobavljac["naziv"]."</td>";
										echo "<td>".$dobavljac["grad"]."</td>";
										echo "<td>".$dobavljac["adresa"]."</td>";
										echo "<td>".$dobavljac["vrsta"]."</td>";
										echo "<td>".$dobavljac["rizik"]."</td>";
										echo "<td>".$dobavljac["kategorija"]."</td>";
										echo "<td><form method=\"POST\" action=\"EvaluacijaDobavljaca.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idDobavljaca\" value=\"".$dobavljac["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"evaluiraj\">Evaluiraj</button></div></form></td>";
										echo "</tr>";
									}
									mysql_close();
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