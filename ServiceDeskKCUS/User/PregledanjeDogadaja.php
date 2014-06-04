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
		<title>User</title>
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
							<li><a class="navbar-brand" href="UpravljanjeDogadaja.php">Nazad</a></li>
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
						<div class="panel-heading">Pregledanje događaja</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Datum:</th>
									<th class="info">Naziv:</th>
									<th class="info">Kategorija:</th>
									<th class="info">Podkategorija:</th>
									<th class="info">Prioritet:</th>
									<th class="info">Opis:</th>
									<th class="info">Ažuriranje:</th>
									<th class="info">Brisanje:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT * FROM dogadaj WHERE status = 'Novi' AND id_korisnickog_racuna = ".$_SESSION["id"].";";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($dogadaj = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$dogadaj["datum"]."</td>";
										echo "<td>".$dogadaj["naziv"]."</td>";
										echo "<td>".$dogadaj["kategorija"]."</td>";
										echo "<td>".$dogadaj["podkategorija"]."</td>";
										$boja = "";
										if ($dogadaj["prioritet"] == "Nizak")
										{
											$boja = "success";
										}
										else if ($dogadaj["prioritet"] == "Srednji")
										{
											$boja = "active";
										}
										else if ($dogadaj["prioritet"] == "Visok")
										{
											$boja = "warning";
										}
										else if ($dogadaj["prioritet"] == "Kritičan")
										{
											$boja = "danger";
										}
										echo "<td class=\"".$boja."\">".$dogadaj["prioritet"]."</td>";
										echo "<td>".$dogadaj["opis"]."</td>";
										echo "<td><form method=\"POST\" action=\"AzuriranjeDogadaja.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idDogadaja\" value=\"".$dogadaj["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form></td>";
										echo "<td><form method=\"POST\" action=\"BrisanjeDogadaja.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idDogadaja\" value=\"".$dogadaj["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"brisi\">Briši</button></div></form></td>";
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