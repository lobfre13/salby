<?php 
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Salaby</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/generalStyle.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	</head>
	<body>
			<div id="header">
				<div class="widthConstrained">
					<div id="hamMenu">
						<div></div><div></div>
						<div id="dropDownMainMenu">
							<ul>
								<li>Barnehage</li>
								<li>Skolestart</li>
								<li>1-2. Klasse</li>
								<li>3-4. Klasse</li>
								<li>5-7. Klasse</li>
							</ul>
						</div>
					</div>
					
					<a href="index.php"><img id="headerLogo" src="img/logo_orange.png" alt="logo"/></a>

					<div id="user">
						<a href="#"><img width="20" src="http://www.sessionlogs.com/media/icons/defaultIcon.png">  <?php echo $_SESSION['userid'];?></a>
						<a href="scripts/logout.php">Logg ut</a>
					</div>
					
					
				</div>
			</div>