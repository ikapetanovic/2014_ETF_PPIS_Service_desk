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
		<title>Administrator</title>
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
							<li><a class="navbar-brand" href="UpravljanjeKorisnickihRacuna.php">Nazad</a></li>
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
						<div class="panel-heading">Pregledanje korisničkih računa</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Ime i prezime:</th>
									<th class="info">Broj telefona:</th>
									<th class="info">Email adresa:</th>
									<th class="info">Odjel:</th>
									<th class="info">Korisničko ime:</th>
									<th class="info">Korisnička šifra:</th>
									<th class="info">Korisnička grupa:</th>
									<th class="info">Ažuriranje:</th>
									<th class="info">Brisanje:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT * FROM korisnicki_racun;";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($korisnickiRacun = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$korisnickiRacun["ime"]." ".$korisnickiRacun["prezime"]."</td>";
										echo "<td>".$korisnickiRacun["broj_telefona"]."</td>";
										echo "<td>".$korisnickiRacun["email_adresa"]."</td>";
										echo "<td>".$korisnickiRacun["odjel"]."</td>";
										echo "<td>".$korisnickiRacun["korisnicko_ime"]."</td>";
										echo "<td>".$korisnickiRacun["korisnicka_sifra"]."</td>";
										echo "<td>".$korisnickiRacun["korisnicka_grupa"]."</td>";
										echo "<td><form method=\"POST\" action=\"AzuriranjeKorisnickihRacuna.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idKorisnickogRacuna\" value=\"".$korisnickiRacun["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"azuriraj\">Ažuriraj</button></div></form></td>";
										echo "<td><form method=\"POST\" action=\"BrisanjeKorisnickihRacuna.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idKorisnickogRacuna\" value=\"".$korisnickiRacun["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"brisi\">Briši</button></div></form></td>";
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