<?php
	$server = 'localhost';
	$username ='root';
	$password = '';
	$database = 'php_login_database';

	// variable de conexion a la base de datos y variable de error

	try {
		$conn = new PDO ("mysql:host=$server;dbname=$database;",$username, $password);
	} catch (PDOException $e){
		die('Connected failed; '.$e->getMessage());

	}

?>