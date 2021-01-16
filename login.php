<!-- Requerir la conexion a base de datos y obtener  los datos de la bd, comprobando que no estén vacíos -->
<?php

	session_start();

	require 'database.php';
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
	 	$records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
	 	$records->bindParam(':email', $_POST['email']);
	 	$records->execute();
	 	$results = $records->fetch(PDO::FETCH_ASSOC);

	 	$message = '';

	 	if (count($results) > 0 && password_verify($_POST['password'], $results ['password'])) {
	 		$_SESSION['user_id']= $results['id'];
	 		header('Location: /php-project');
	 	} else {
	 		$message = 'Sorry, those credentials do not match';
	 	}
	 } 	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	 <!-- requerir header, navegación de pantallas -->
	<?php require 'partials/header.php' ?>
	 <!-- Formulario para ingresar los datos o para registrarse (signup) -->
	<h1>Login</h1>
	<span>or <a href="signup.php">SignUp</a></span>

	<?php if (!empty($message)) : ?> 
		<p><?= $message ?></p>
	<?php endif;?>	
	

	<form action="login.php" method="post">
		<input type="text" name="email" placeholder="Enter Your Email">
		<input type="password" name="password" placeholder="Enter Your Password">
		<input type="submit" value="Send">
		
	</form>

</body>
</html>