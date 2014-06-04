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
	<body onload="onemoguciSlanje();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="#">Service Desk KCUS</a></li>
							<li><a class="navbar-brand" href="IdentifikacijaPPIPP.php">Nazad</a></li>
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
						<div class="panel-heading">Pregled specifičnih pravila i uslova</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
									<th class="info">Vrijednost (u KM):</th>
									<th class="info">Trajanje (u mjesecima):</th>
									<th class="info">Grad dobavljača:</th>
									<th class="info">Brisanje:</th>
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT * FROM specificno_pravilo";
									$rezultatSQLUpita = mysql_query($SQLUpit);
									while ($pravilo = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										
										echo "<td>".$pravilo["vrijednost"]."</td>";
										echo "<td>".$pravilo["trajanje"]."</td>";
										echo "<td>".$pravilo["grad"]."</td>";
										echo "<td><form method=\"POST\" action=\"BrisanjeSPIU.php\"><div class=\"form-group\"><input type=\"hidden\" name=\"idSpecificnogPravila\" value=\"".$pravilo["id"]."\"/><button type=\"submit\" class=\"btn btn-primary\" id=\"brisi\">Briši</button></div></form></td>";
										echo "</tr>";
									}
									mysql_close() or die(mysql_error());
								?>
							</table>
							<form method="POST" class="form-horizontal" action="PregledanjeSPIU.php">
								<div class="form-group">
									<div class="col-sm-offset-1"><button type="submit" class="btn btn-primary" id="dugmePosalji">Pošalji</button></div>
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
			function omoguciSlanje() {
				if (validnostOznaka == true)
					document.getElementById("dugmePosalji").style.display = "block";
			}
			function onemoguciSlanje() {
				document.getElementById("dugmePosalji").style.display = "none";
			}
			var validnostOznaka = false;
			var oznake = document.getElementsByName("oznaka");
			function validirajOznake() {
				validnostOznaka = false;
				for (var i = 0; i < oznake.length; i++) {
					if (oznake[i].checked) {
						validnostOznaka = true;
						break;
					}
				}
				if (validnostOznaka == true)
					omoguciSlanje();
				else onemoguciSlanje();
			}
		</script>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>