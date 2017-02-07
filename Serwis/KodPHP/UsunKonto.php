<?php

	session_start();

	require_once('ZmiennePolaczenia.php');
	error_reporting(E_ALL ^ E_NOTICE);
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if(isset($_GET['ID_user']))
	{
		$Uzytkownik = $_GET['ID_user'];
		
		$query = "DELETE FROM loguj WHERE ID_user=$Uzytkownik";
		$data = mysqli_query($dbc, $query);
		mysqli_close($dbc);
		
		header("Location: ../Glowna.php");
		
	}

?>