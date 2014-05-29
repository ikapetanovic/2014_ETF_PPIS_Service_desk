<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Upravljanje performansama</title>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/navbar.css" rel="stylesheet">
	</head>
	<body >
	
		<div class="container">
			<div class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a class="navbar-brand" href="Pocetna.php">Nazad</a></li>
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
						<div class="panel-heading">Pregled dobavljaca</div>
						<div class="panel-body">
						
						<form method="POST" class="form-horizontal" action="">
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Kategorija:</label>
									<div class="col-sm-4">
										<select class="form-control" name="kategorija">
											<option id="commodity">Commodity</option>
											<option id="operativni">Operativni</option>
											<option id="takticki">Takticki</option>
											<option id="strateski">Strateski</option>
										</select>
									</div>
									<div class="col-sm-offset-1"><button type="submit" class="btn btn-primary" id="dugmePosalji">Filter</button></div>
								</div>
								
								
									
								
							</form>
							
							<table class="table table-bordered">
								<tr>
									<th class="info">Naziv</th>
									<th class="info">Grad</th>
									<th class="info">Adresa</th>
									<th class="info">Rizik</th>
									<th class="info">Kategorija</th>
									
								</tr>
								<?php
									if (isset($_POST["kategorija"]))
									{
									$categ = $_POST["kategorija"];
									mysql_connect("localhost", "root", "") or die(mysql_error());
									mysql_select_db("service_desk_db") or die(mysql_error());
									$SQLUpit = "SELECT * FROM dobavljaci where kategorija=\"" . $categ . "\"";
									$rezultatSQLUpita = mysql_query($SQLUpit) or die(mysql_error());
									while ($pravilo = mysql_fetch_assoc($rezultatSQLUpita))
									{
										echo "<tr>";
										echo "<td>".$pravilo["naziv"]."</td>";
										echo "<td>".$pravilo["grad"]."</td>";
										echo "<td>".$pravilo["adresa"]."</td>";
										echo "<td>".$pravilo["rizik"]."</td>";
										echo "<td>".$pravilo["kategorija"]."</td>";
										echo "<td>";
										echo "<form action=\"DodajOcjenu.php\" method=\"get\">" .
										"<input type=\"hidden\" name=\"id\" value=\"" . $pravilo["ID"] . "\" >" .				
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"+\" />" .							
										"</form>";
										echo "</td>";
										
										echo "<td>";
										echo "<form action=\"Pregled.php\" method=\"get\">" .
										"<input type=\"hidden\" name=\"id\" value=\"" . $pravilo["ID"] . "\" >" .				
										"<input type=\"submit\" class=\"btn btn-primary\" value=\"Pregledaj sve\" />" .							
										"</form>";
										
										echo "</td>";
										
										
										
										
										echo "</tr>";
									}
									mysql_close() or die(mysql_error());
									}
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