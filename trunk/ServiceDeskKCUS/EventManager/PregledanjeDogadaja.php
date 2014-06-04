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
		<title>Event Manager</title>
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
									<th class="info">Podaci o korisniku:</th>
									<th class="info">Datum i naziv:</th>
									<th class="info">Kategorija i podkategorija:</th>
									<th class="info">Prioritet:</th>
									<th class="info">Opis:</th>
									<th class="info">Ažuriranje i filtriranje:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT k_r.ime, k_r.prezime, k_r.broj_telefona, k_r.email_adresa, k_r.odjel, d.id, d.datum, d.naziv, d.kategorija, d.podkategorija, d.prioritet, d.opis FROM korisnicki_racun k_r, dogadaj d WHERE d.status = 'Novi' AND k_r.id = d.id_korisnickog_racuna;";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($dogadaj = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$dogadaj["ime"]." ".$dogadaj["prezime"]."<br>".$dogadaj["broj_telefona"]."<br>".$dogadaj["email_adresa"]."<br>".$dogadaj["odjel"]."</td>";
										echo "<td>".$dogadaj["datum"]."<br>".$dogadaj["naziv"]."</td>";
										echo "<td>".$dogadaj["kategorija"]."<br>".$dogadaj["podkategorija"]."</td>";
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
										echo "<td><form method=\"POST\" action=\"AzuriranjeDogadaja.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idDogadaja\" value=\"".$dogadaj["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form>";
										echo "<form method=\"POST\" action=\"FiltriranjeDogadaja.php\"><div class=\"form-group\"><select class=\"form-control\" name=\"vrsta\" id=\"vrsta\"/><option value=\"Zahtjev\">Zahtjev</option><option value=\"Incident\">Incident</option></select></div><div class=\"form-group\"><input type=\"hidden\" name=\"idDogadaja\" value=\"".$dogadaj["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"filtriraj\">Filtriraj</button></div></form></td>";
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