<?php include_once "header.php"; ?>
<?php 

include_once "php/config.php";

session_start();

error_reporting(0);

if (isset($_SESSION['usernameadm'])) {
    header("Location: afficherEtudiant.php");
}

if (isset($_POST['submit'])) {
	$adresseadm = $_POST['adresseadm'];
	$motDePasseadm = md5($_POST['motDePasseadm']);

	$sql = "SELECT * FROM administrateur WHERE adresseadm='$adresseadm' AND motDePasseadm='$motDePasseadm'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['usernameadm'] = $row['usernameadm'];
		header("Location: afficherutilisateur.php");
	} else {
		echo "<script>alert('Woops! E-mail ou mot de passe est faux.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	

	<link rel="stylesheet" type="text/css" href="stylee.css">

	<title>Connexion</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;"> <a href="index.html">Login</a></p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="adresseadm" value="<?php echo $adresseadm; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="motDePasseadm" value="<?php echo $_POST['motDePasseadm']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Connexion</button>
			</div>
			<p class="login-register-text">Vous n'avez pas de compte? <a href="inscriptionadm.php">Inscrivez-la</a>.</p>
		</form>
	</div>
</body>
</html>