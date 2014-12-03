<?php require 'scripts/db_con.php';
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){

	//henter id på bruker
	$sql = $database->prepare("SELECT * FROM brukere WHERE brukernavn=:username AND passord=:password");

	$sql->execute(array(
	    'username' => $_POST['username'],
	    'password' => $_POST['password']
	));
	//$userid = $sql->fetchAll();
	$data = $sql->rowCount();

	if($data == 1){
		$_SESSION['userid'] = $_POST['username'];
		header ("Location: index.php");
	}
	else{
		echo 'Feil Brukernavn/passord';
	}
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Salaby</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/loginStyle.css">
		<link rel="stylesheet" type="text/css" href="css/generalStyle.css">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	</head>
	<body>
	
		<div id="loginBox">
			<img src="img/logo3.PNG"><br>
			<form method="post" action="login.php">
				<p>Velkommen til Salaby.no!<br>
					For å få tilgang til innhold må du logge inn
				</p>
				<label>Brukernavn:</label><br>
				<input type="text" name="username" value="Brukernavn/Epost" onfocus="if (this.value == 'Brukernavn/Epost') { this.value = '';}"/><br>
				<label>Passord:</label><br>
				<input type="password" name="password" value="passord" onfocus="if (this.value == 'passord') { this.value = '';}"/><br>
				<input type="submit" value="Logg Inn"/>
			</form>
			<a href="#">Glemt Passord?</a>   <a href="#">Opprett ny bruker</a>
			<br><br>
			<a id="nonLogin" href="#">Fortsett uten innlogging -->></a>		
		</div>

<?php require 'template/footer.php'; ?>