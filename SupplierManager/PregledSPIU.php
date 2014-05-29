<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Upravljanje dobavljačima</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body onload="onemoguciSlanje();">
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="IdentifikacijaPPIPP.php">Nazad</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="navbar-brand">Prijavljeni ste kao: Mensur Mandzuka</li>
							<li><a class="navbar-brand" href="#">Odjava</a></li>
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
									<th class="info">Vrijednost:</th>
									<th class="info">Trajanje (u mjesecima):</th>
									<th class="info">Grad dobavljaca:</th>
									
								</tr>
								<?php
									mysql_connect("localhost", "root", "") or die(mysql_error());
									mysql_select_db("service_desk_db") or die(mysql_error());
									$SQLUpit = "SELECT * FROM specificno_pravilo";
									$rezultatSQLUpita = mysql_query($SQLUpit) or die(mysql_error());
									while ($pravilo = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										
										echo "<td>".$pravilo["vrijednost"]."</td>";
										echo "<td>".$pravilo["trajanje"]."</td>";
										echo "<td>".$pravilo["grad"]."</td>";
										
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