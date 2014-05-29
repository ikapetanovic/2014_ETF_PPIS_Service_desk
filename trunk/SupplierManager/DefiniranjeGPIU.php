<?php
	mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("service_desk_db") or die(mysql_error());
	if (isset($_POST["pravilo"]))
	{
		$SQLUpit = "INSERT INTO generalno_pravilo (pravilo) VALUES('".$_POST["pravilo"]."')";
		mysql_query($SQLUpit) or die(mysql_error());
	}
	mysql_close() or die(mysql_error());
?>
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
						<div class="panel-heading">Definiranje generalnih pravila i uslova</div>
						<div class="panel-body">
							<form method="POST" class="form-horizontal" action="DefiniranjeGPIU.php">
								<div class="form-group">
									<label class="col-sm-2 control-label">Pravilo i uslovi:</label>
									<div class="col-sm-4"><textarea class="form-control" name="pravilo" id="pravilo" rows="5" onblur="validirajPravilo();"></textarea></div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-primary" id="dugmePosalji">Pošalji</button></div>
								</div>
							</form>
						</div>
					</div>
				</p>
			</div>
		</div>
		<script>
			function omoguciSlanje() {
				if (validnostPravila == true)
					document.getElementById("dugmePosalji").style.display = "block";
			}
			function onemoguciSlanje() {
				document.getElementById("dugmePosalji").style.display = "none";
			}
			var validnostPravila = false;
			var pravilo = document.getElementById("pravilo");
			function validirajPravilo() {
				validnostPravila = true;
				if (pravilo.value.length == 0)
					validnostPravila = false;
				if (validnostPravila == true)
				{
					pravilo.style.backgroundColor = "white";
					omoguciSlanje();
				}
				else
				{
					pravilo.style.backgroundColor = "red";
					pravilo.focus();
					onemoguciSlanje();
				}
			}
		</script>
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>