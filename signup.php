<!-- Requerir conexion a la base de datos -->
<?php
	require 'database.php';

	// variable global
	$message = '';
// metodo de validación para registrar campos nuevos

if (!empty($_POST['email'])&& !empty($_POST['password'])) {
		$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':email',$_POST['email']);
		$password=password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password',$password);

		// método validación para la creación de usuarios
		if ($stmt->execute()) {
			$message='Successfully created new user';
		}	else {	
			$message='Sorry there must have been an issue creating your acount';
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SignUp</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<!-- requerir header, navegación de pantallas -->
	<?php require 'partials/header.php' ?>
	<!-- Formulario para registrar los datos o para ingresar(login) -->

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
		
	<h1>SignUp</h1>
	<span>or <a href="login.php">Login</a></span>

	<form action="signup.php" method="post">
		<input type="text" name="email" placeholder="Enter Your Email">
		<input type="password" name="password" placeholder="Enter Your Password">
		<input type="password" name="confirm_password" placeholder="Confirm Your Password">
		<input type="submit" value="Send">
		
	</form>
</body>
</html>



