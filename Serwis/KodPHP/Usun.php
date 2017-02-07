<?php

	session_start();

	require_once('ZmiennePolaczenia.php');
	error_reporting(E_ALL ^ E_NOTICE);
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if(isset($_GET['id_ksiazki']))
	{
		$Ksiazka = $_GET['id_ksiazki'];
		//$stronaKOM = $_GET['strona'];
		$Login = $_SESSION['Login'];
		
		$query = "DELETE FROM komentarze WHERE id_ksiazki=$Ksiazka AND dodal='$Login'";
		$data = mysqli_query($dbc, $query);
		mysqli_close($dbc);
		
		header("Location: ../KsiazkaKonkretna.php?ID_ksiazki=$Ksiazka");
		
	}

?>