<?php

	require_once('ZmiennePlikow.php');
	require_once('ZmiennePolaczenia.php');
	error_reporting(E_ALL ^ E_NOTICE);
	
	// Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
	if (!isset($_SESSION['ID_user'])) {
    echo '<p>Zaloguj się, aby uzyskać dostęp do strony.</p>';
    exit();
	}
  

	// łączenie się z bazą danych.
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//$error = false;
	$OcenaUzytkownikID = $_SESSION['ID_user'];
	$OcenaKsiazkiID = $_GET['ID_ksiazki'];
  
	$query="SELECT ocena FROM oceny WHERE oceny_id_user='$OcenaUzytkownikID' AND oceny_id_ksiazki='$OcenaKsiazkiID'";
	$wartosc=mysqli_query($dbc, $query);
	$sprawdz=mysqli_num_rows($wartosc);
	
	if($sprawdz==0)
	{
		
	}
	else
	{
		$wynik=mysqli_fetch_array($wartosc);
		switch($wynik['ocena'])
		{
			case '1':
			$o1="checked";
			break;
			
			case '2':
			$o2="checked";
			break;
			
			case '3':
			$o3="checked";
			break;
			
			case '4':
			$o4="checked";
			break;
			
			case '5':
			$o5="checked";
			break;
			
			case '6':
			$o6="checked";
			break;
			
			case '7':
			$o7="checked";
			break;
			
			case '8':
			$o8="checked";
			break;
			
			case '9':
			$o9="checked";
			break;
			
			case '10':
			$o10="checked";
			break;
		}
	}
	
	$query1="SELECT SUM(ocena) FROM oceny WHERE oceny_id_ksiazki='$OcenaKsiazkiID'";
	$wartosc1=mysqli_query($dbc, $query1);
	
	$sprawdz1=mysqli_num_rows($wartosc1);
	$query2="SELECT COUNT(*) AS ocena FROM oceny WHERE oceny_id_ksiazki='$OcenaKsiazkiID'";
	$wartosc2=mysqli_query($dbc, $query2);
	
	$sumaWynik=mysqli_fetch_array($wartosc1);
	
	if($sumaWynik['SUM(ocena)']==NULL)
	{
		$srednia = 0;
		$zaokraglenie = round($srednia,1);
		$ileOsob = 0;
	}
	else
	{
		
		$ileWynik=mysqli_fetch_array($wartosc2);
		$srednia = $sumaWynik['SUM(ocena)'] / $ileWynik['ocena'];
		$zaokraglenie = round($srednia,1);
		$ileOsob = $ileWynik['ocena'];
	}
	
	//echo $zaokraglenie;
	
	mysqli_close($dbc);

?>