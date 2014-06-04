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
		<title>Request Manager</title>
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
							<li><a class="navbar-brand" href="UpravljanjeZahtjeva.php">Nazad</a></li>
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
						<div class="panel-heading">Pregledanje zahtjeva</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Podaci o korisniku:</th>
									<th class="info">Datum i naziv:</th>
									<th class="info">Kategorija i podkategorija:</th>
									<th class="info">Prioritet:</th>
									<th class="info">Opis:</th>
									<th class="info">Status:</th>
									<th class="info">Ažuriranje komentara i ažuriranje statusa:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT k_r.ime, k_r.prezime, k_r.broj_telefona, k_r.email_adresa, k_r.odjel, z.id, z.datum_prijavljivanja, z.naziv, z.kategorija, z.podkategorija, z.prioritet, z.opis, z.status FROM korisnicki_racun k_r, zahtjev z, dogadaj d WHERE (z.status = 'Na čekanju' OR z.status = 'Aktivan') AND k_r.id = d.id_korisnickog_racuna AND d.id = z.id_dogadaja;";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($zahtjev = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$zahtjev["ime"]." ".$zahtjev["prezime"]."<br>".$zahtjev["broj_telefona"]."<br>".$zahtjev["email_adresa"]."<br>".$zahtjev["odjel"]."</td>";
										echo "<td>".$zahtjev["datum_prijavljivanja"]."<br>".$zahtjev["naziv"]."</td>";
										echo "<td>".$zahtjev["kategorija"]."<br>".$zahtjev["podkategorija"]."</td>";
										$boja = "";
										if ($zahtjev["prioritet"] == "Nizak")
										{
											$boja = "success";
										}
										else if ($zahtjev["prioritet"] == "Srednji")
										{
											$boja = "active";
										}
										else if ($zahtjev["prioritet"] == "Visok")
										{
											$boja = "warning";
										}
										else if ($zahtjev["prioritet"] == "Kritičan")
										{
											$boja = "danger";
										}
										echo "<td class=\"".$boja."\">".$zahtjev["prioritet"]."</td>";
										echo "<td>".$zahtjev["opis"]."</td>";
										echo "<td>".$zahtjev["status"]."</td>";
										echo "<td><form method=\"POST\" action=\"AzuriranjeKomentaraZahtjeva.php\"><div class=\"form-group\"><textarea class=\"form-control\" name=\"komentar\" id=\"komentar\" rows=\"3\"></textarea></div><div class=\"form-group\"><input type=\"hidden\" name=\"idZahtjeva\" value=\"".$zahtjev["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form>";
										echo "<form method=\"POST\" action=\"AzuriranjeStatusaZahtjeva.php\"><div class=\"form-group\"><select class=\"form-control\" name=\"status\" id=\"status\"/><option value=\"Na čekanju\">Na čekanju</option><option value=\"Aktivan\">Aktivan</option><option value=\"Riješen\">Riješen</option></select></div><div class=\"form-group\"><input type=\"hidden\" name=\"idZahtjeva\" value=\"".$zahtjev["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form></td>";
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