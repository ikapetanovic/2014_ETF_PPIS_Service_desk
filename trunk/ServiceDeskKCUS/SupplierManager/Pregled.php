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
		<title>Supplier Management</title>
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
						<div class="panel-heading">Pregled performansi dobavljača</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<tr>
								    <th class="info">Datum revizije</th>
									<th class="info">Isporučuje na vrijeme</th>
									<th class="info">Isporučuje po specifikaciji</th>
									<th class="info">Bez fluktuacija cijena</th>
									<th class="info">Brzo odgovara na nepredviđene situacije</th>
									
								</tr>
								<?php
									mysql_connect("localhost", "root", "");
									mysql_set_charset("utf8");
									mysql_select_db("service_desk_kcus_db");
									$SQLUpit = "SELECT datum, navrijeme, pospecifikaciji, bezfluktuacija, nepredvidjene FROM performanse where id_dobavljaca=\"" . $_GET["id"] . "\"";
									$rezultatSQLUpita = mysql_query($SQLUpit) or die(mysql_error());
									while ($pravilo = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$pravilo["datum"]."</td>";
										echo "<td>".$pravilo["navrijeme"]."</td>";
										echo "<td>".$pravilo["pospecifikaciji"]."</td>";
										echo "<td>".$pravilo["bezfluktuacija"]."</td>";
										echo "<td>".$pravilo["nepredvidjene"]."</td>";
										
										echo "</tr>";
									}
									mysql_close() or die(mysql_error());
								?>
							</table>
						</div>
					</div>
				</p>
			</div>
		</div>
	</body>
</html>