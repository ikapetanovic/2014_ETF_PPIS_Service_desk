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
							<li><a class="navbar-brand" href="UpravljanjeIncidenata.php">Nazad</a></li>
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
						<div class="panel-heading">Pregledanje incidenata</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Datum:</th>
									<th class="info">Naziv:</th>
									<th class="info">Kategorija i podkategorija:</th>
									<th class="info">Prioritet:</th>
									<th class="info">Opis:</th>
									<th class="info">Komentar:</th>
									<th class="info">Status:</th>
									<th class="info">Zatvaranje:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT i.id, i.datum_prijavljivanja, i.naziv, i.kategorija, i.podkategorija, i.prioritet, i.opis, i.komentar, i.status FROM incident i, dogadaj d WHERE (i.status = 'Na čekanju' OR i.status = 'Aktivan' OR i.status = 'Riješen') AND i.id_dogadaja = d.id AND d.id_korisnickog_racuna = ".$_SESSION["id"].";";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($incident = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$incident["datum_prijavljivanja"]."</td>";
										echo "<td>".$incident["naziv"]."</td>";
										echo "<td>".$incident["kategorija"]."<br>".$incident["podkategorija"]."</td>";
										$boja = "";
										if ($incident["prioritet"] == "Nizak")
										{
											$boja = "success";
										}
										else if ($incident["prioritet"] == "Srednji")
										{
											$boja = "active";
										}
										else if ($incident["prioritet"] == "Visok")
										{
											$boja = "warning";
										}
										else if ($incident["prioritet"] == "Kritičan")
										{
											$boja = "danger";
										}
										echo "<td class=\"".$boja."\">".$incident["prioritet"]."</td>";
										echo "<td>".$incident["opis"]."</td>";
										echo "<td>".$incident["komentar"]."</td>";
										echo "<td>".$incident["status"]."</td>";
										echo "<td>";
										if ($incident["status"] == "Riješen")
										{
											echo "<form method=\"POST\" action=\"ZatvaranjeIncidenata.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idIncidenta\" value=\"".$incident["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"zatvori\">Zatvori</button></div></form>";
										}
										else
										{
											echo "&nbsp;";
										}
										echo "</td>";
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