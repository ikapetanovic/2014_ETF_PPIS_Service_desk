<?php
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "DELETE FROM korisnicki_racun WHERE id = ".$_POST["idKorisnickogRacuna"].";";
	mysql_query($SQLUpit);
	echo "<script>alert(\"Brisanje korisničkog računa je uspješno.\"); window.location = \"PregledanjeKorisnickihRacuna.php\";</script>";
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
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>