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
		<title>Super Manager</title>
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
									<th class="info">Podaci o korisniku:</th>
									<th class="info">Datum i naziv:</th>
									<th class="info">Kategorija i podkategorija:</th>
									<th class="info">Prioritet:</th>
									<th class="info">Opis:</th>
									<th class="info">Status:</th>
									<th class="info">Ažuriranje komentara i statusa:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT k_r.ime, k_r.prezime, k_r.broj_telefona, k_r.email_adresa, k_r.odjel, i.id, i.datum_prijavljivanja, i.naziv, i.kategorija, i.podkategorija, i.prioritet, i.opis, i.status FROM korisnicki_racun k_r, incident i, dogadaj d WHERE (i.status = 'Na čekanju' OR i.status = 'Aktivan') AND i.stanje = 'Eskalirano' AND k_r.id = d.id_korisnickog_racuna AND d.id = i.id_dogadaja;";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($incident = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$incident["ime"]." ".$incident["prezime"]."<br>".$incident["broj_telefona"]."<br>".$incident["email_adresa"]."<br>".$incident["odjel"]."</td>";
										echo "<td>".$incident["datum_prijavljivanja"]."<br>".$incident["naziv"]."</td>";
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
										echo "<td>".$incident["status"]."</td>";
										echo "<td><form method=\"POST\" action=\"AzuriranjeKomentaraIncidenata.php\"><div class=\"form-group\"><textarea class=\"form-control\" name=\"komentar\" id=\"komentar\" rows=\"3\"></textarea></div><div class=\"form-group\"><input type=\"hidden\" name=\"idIncidenta\" value=\"".$incident["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form>";
										echo "<form method=\"POST\" action=\"AzuriranjeStatusaIncidenata.php\"><div class=\"form-group\"><select class=\"form-control\" name=\"status\" id=\"status\"/><option value=\"Na čekanju\">Na čekanju</option><option value=\"Aktivan\">Aktivan</option><option value=\"Riješen\">Riješen</option></select></div><div class=\"form-group\"><input type=\"hidden\" name=\"idIncidenta\" value=\"".$incident["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form></td>";
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