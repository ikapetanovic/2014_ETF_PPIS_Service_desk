<?php
	mysql_connect("localhost", "root", "");
	mysql_set_charset("utf8");
	mysql_select_db("service_desk_kcus_db");
	$SQLUpit = "UPDATE zahtjev SET komentar = '".$_POST["komentar"]."' WHERE id = '".$_POST["idZahtjeva"]."';";
	mysql_query($SQLUpit);
	echo "<script>alert(\"Ažuriranje komentara zahtjeva je uspješno.\"); window.location = \"PregledanjeZahtjeva.php\";</script>";
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
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>