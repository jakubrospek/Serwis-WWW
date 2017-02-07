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
  $error = false;
  
  if (isset($_POST['dodaj'])) // po naciśnięciu przycisku "dodaj"
  {
  
		$uzytkownikID = $_SESSION['ID_user'];
		$ksiazkiID = $_GET['ID_ksiazki'];
  
		$zapytanieDODAL = 'SELECT ID_user, Login FROM loguj WHERE ID_user='.$uzytkownikID;
		$zapytanieID_KSIAZKI = 'SELECT ID_ksiazki FROM ksiazki WHERE ID_ksiazki='.$ksiazkiID;
  
		$zpytanieOCENA = "SELECT ocena FROM oceny WHERE oceny_id_user='$uzytkownikID' AND oceny_id_ksiazki='$ksiazkiID'";
		$WYNIK_OCENA = mysqli_query($dbc,$zpytanieOCENA);
		$Rezultat3 = mysqli_fetch_assoc($WYNIK_OCENA);
  
		$WYNIK_DODAL = mysqli_query($dbc,$zapytanieDODAL);
		$Rezultat = mysqli_fetch_assoc($WYNIK_DODAL);
  
		$WYNIK_ID_KSIAZKI = mysqli_query($dbc,$zapytanieID_KSIAZKI);
		$Rezultat2 = mysqli_fetch_assoc($WYNIK_ID_KSIAZKI);
  
	  
	  
	  $OCENA = $Rezultat3['ocena'];
	  $DODAL = $Rezultat['Login'];
	  $IDuser = $Rezultat['ID_user'];
	  
	  $OPINIA = mysqli_real_escape_string($dbc, trim($_POST['opinia']));
	  if(empty($OPINIA))
	  {
		  $error=true;
	  }
	  $DATA_DODANIA=date("Y-m-d");
	  $CZAS_DODANIA=date("H:i:s");
	  $ID_KSIAZKI = $Rezultat2['ID_ksiazki'];
	  
	  // Aktualizowanie komentarza w bazie danych.
	if (!$error)
	{
		
		$query="SELECT dodal, id_ksiazki FROM komentarze WHERE dodal='$DODAL' AND id_ksiazki='$ksiazkiID'";
		$spr=mysqli_query($dbc, $query);
		$wynik=mysqli_num_rows($spr);
		
		if (!empty($IDuser) && !empty($DODAL) && !empty($OPINIA) && !empty($OCENA) && !empty($DATA_DODANIA) && !empty($CZAS_DODANIA) && !empty($ID_KSIAZKI))
		{
			if($wynik==0)
			{
			
				$query1 = "INSERT INTO komentarze(ID_user, dodal, opinia, ocena, data_dodania, czas_dodania, id_ksiazki) VALUES('$IDuser','$DODAL','$OPINIA','$OCENA','$DATA_DODANIA','$CZAS_DODANIA','$ID_KSIAZKI')";
			}
			else
			{
				$query1 = "UPDATE komentarze SET opinia='$OPINIA', ocena='$OCENA', data_dodania='$DATA_DODANIA', czas_dodania='$CZAS_DODANIA' WHERE dodal='$DODAL' AND id_ksiazki='$ksiazkiID'";
			}
			
		}
        else
		{
			if($wynik==0)
			{
			
				$query1 = "INSERT INTO komentarze(ID_user, dodal, opinia, data_dodania, czas_dodania, id_ksiazki) VALUES('$IDuser','$DODAL','$OPINIA','$DATA_DODANIA','$CZAS_DODANIA','$ID_KSIAZKI')";
				// przypadek dodania komentarza przez osobe która nie oceniła książki
			}
			else
			{
				$query1 = "UPDATE komentarze SET opinia='$OPINIA', data_dodania='$DATA_DODANIA', czas_dodania='$CZAS_DODANIA' WHERE dodal='$DODAL' AND id_ksiazki='$ksiazkiID'";
			}
        }
        mysqli_query($dbc, $query1);

        mysqli_close($dbc);
    }
    else
	{
        echo '<p>Najpierw wpisz komentarz.</p>';
		mysqli_close($dbc);
    }
    }
   // Koniec obsługi przesyłania formularza.
  

  

	
?>