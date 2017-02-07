<?php

	session_start();

	require_once('ZmiennePolaczenia.php');
	error_reporting(E_ALL ^ E_NOTICE);
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$ID_zalogowanego = $_SESSION['ID_user'];
	$ID_uzytkownika = $_GET['ID_user'];
	
		$query = "INSERT INTO znajomi(ID_zalogowany, ID_znajomy) VALUES('$ID_zalogowanego','$ID_uzytkownika')";
		$data = mysqli_query($dbc, $query);
		mysqli_close($dbc);
		
		header("Location: ../Profil.php?ID_user=$ID_uzytkownika");

?>