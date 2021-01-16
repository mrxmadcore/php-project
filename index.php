<!-- Comprobar que el id del usuario esté en base de datos y todos sus parámetros -->
<?php
	session_start();

	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results)>0) {
			$user = $results;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>App Web</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php require 'partials/header.php' ?>

<?php if(!empty($user)): ?>
<br>Welcome <?= $user['email']?>
<br>You Are Successfully Logged In
<a href="logout.php">LogOut</a>
<?php else: ?>	


	<h1>Please Choose An Option<h2>

	<a href="login.php">Login</a> or
	<a href="signup.php">Signup</a>

<?php endif; ?>	
</body>
</html>