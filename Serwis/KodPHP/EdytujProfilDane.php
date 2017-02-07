<?php

require_once('ZmiennePlikow.php');
require_once('ZmiennePolaczenia.php');


  // Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    echo '<p>Zaloguj się, aby uzyskać dostęp do strony.</p>';
    exit();
  }
  

  // łączenie się z bazą danych.
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])){
    // Pobieranie danych do profilu użytkownika z żądania POST.
    $IMIE = mysqli_real_escape_string($dbc, trim($_POST['Imie']));
    $NAZWISKO = mysqli_real_escape_string($dbc, trim($_POST['Nazwisko']));
    $PLEC = mysqli_real_escape_string($dbc, trim($_POST['Plec']));
    $DATA_URODZ = mysqli_real_escape_string($dbc, trim($_POST['DataUrodz']));
    $MIASTO = mysqli_real_escape_string($dbc, trim($_POST['Miasto']));
    $WOJEWODZTWO = mysqli_real_escape_string($dbc, trim($_POST['Wojewodztwo']));
	$EMAIL = mysqli_real_escape_string($dbc, trim($_POST['Email']));
    $stary_obraz = mysqli_real_escape_string($dbc, trim($_POST['stary_obraz']));
    $nowy_obraz = mysqli_real_escape_string($dbc, trim($_FILES['nowy_obraz']['name']));
    $nowy_obraz_typ = $_FILES['nowy_obraz']['type'];
    $nowy_obraz_rozmiar = $_FILES['nowy_obraz']['size'];
	if($nowy_obraz)
	{
		list($nowy_obraz_dlugosc, $nowy_obraz_wysokosc) = getimagesize($_FILES['nowy_obraz']['tmp_name']);
	}
    $error = false;
	$error2 = false;

    // Walidacja i (w razie potrzeby) przenoszenie przesłanego pliku graficznego.
    if (!empty($nowy_obraz)) {
      if ((($nowy_obraz_typ == 'image/gif') || ($nowy_obraz_typ == 'image/jpeg') || ($nowy_obraz_typ == 'image/pjpeg') ||
        ($nowy_obraz_typ == 'image/png')) && ($nowy_obraz_rozmiar > 0) && ($nowy_obraz_rozmiar <= MM_MAXFILESIZE) &&
        ($nowy_obraz_dlugosc == MM_MAXIMGWIDTH) && ($nowy_obraz_wysokosc == MM_MAXIMGHEIGHT)) {
        if ($_FILES['nowy_obraz']['error'] == 0) {
          // Przenoszenie pliku do docelowego katalogu.
          $docelowo = MM_UPLOADPATH . basename($nowy_obraz);
          if (move_uploaded_file($_FILES['nowy_obraz']['tmp_name'], $docelowo)) {
            // Przenoszenie nowego pliku zakończyło się powodzeniem.
	    // Teraz trzeba usunąć poprzednie zdjęcie.
            if (!empty($stary_obraz) && ($stary_obraz != $nowy_obraz)) {
              @unlink(MM_UPLOADPATH . $stary_obraz);
            }
          }
          else {
            // Przenoszenie nowego pliku zakończyło się powodzeniem.
	    // Należy usunąć tymczasowy plik i ustawić flagę błędu.
            @unlink($_FILES['nowy_obraz']['tmp']);
            $error = true;
            echo '<p>Wystąpił problem przy przesyłaniu pliku.</p>';
          }
        }
      }
      else {
        // Nowy plik jest nieprawidłowy, dlatego trzeba usunąć tymczasowy plik i ustawić flagę błędu.
        @unlink($_FILES['nowy_obraz']['tmp']);
        $error = true;
		$error2 = true;
        echo '<p>Możesz wybrać plik graficzny GIF, JPEG lub PNG. Miniatura musi mieć rozmiar ' . MM_MAXIMGWIDTH . 'x' . MM_MAXIMGHEIGHT . ' (w pikselach).</p><br>';
      }
    }	

	
	$TEST1 = "/^[a-ząęółśżźćń\sA-ZĄĘÓŁŚŻŹĆŃ\s]+$/";
	$TEST2 = "/^\d{4}\-\d{2}\-\d{2}$/";
	$TEST3 = "/^[a-z0-9\._%-]+@[a-z0-9\.-]+\.[a-z]{2,4}$/i";
	
	
	if(!preg_match($TEST1, $IMIE) || strlen($IMIE) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Imie" !</br>';
	}
	else if(!preg_match($TEST1, $NAZWISKO) || strlen($NAZWISKO) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Nazwisko" !</br>';
	}
	else if(!preg_match($TEST2, $DATA_URODZ))
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Data urodzenia" !</br>';
	}
	else if(!preg_match($TEST1, $MIASTO) || strlen($MIASTO) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Miejscowość" !</br>';
	}
	else if(!preg_match($TEST1, $WOJEWODZTWO) || strlen($WOJEWODZTWO) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Województwo" !</br>';
	}
	else if(!preg_match($TEST3, $EMAIL) || strlen($EMAIL) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Adres e-mail" !</br>';
	}
	else
	{
		$error = false;
	}
	

    // Aktualizowanie profilu w bazie danych.
    if (!$error) {
      if (!empty($IMIE) && !empty($NAZWISKO) && !empty($PLEC) && !empty($DATA_URODZ) && !empty($MIASTO) && !empty($WOJEWODZTWO) && !empty($EMAIL)) {
        // Kolumnę picture należy ustawić tylko wtedy, jeśli użytkownik przesłał zdjęcie.
        if (!empty($nowy_obraz)) {
          $query = "UPDATE loguj SET Imie = '$IMIE', Nazwisko = '$NAZWISKO', Plec = '$PLEC', 
          DataUrodz = '$DATA_URODZ', Miasto = '$MIASTO', Wojewodztwo = '$WOJEWODZTWO', Email = '$EMAIL', Avatar = '$nowy_obraz' WHERE ID_user = '" . $_SESSION['ID_user'] . "'";
        }
        else {
		  $query = "UPDATE loguj SET Imie = '$IMIE', Nazwisko = '$NAZWISKO', Plec = '$PLEC', 
          DataUrodz = '$DATA_URODZ', Miasto = '$MIASTO', Wojewodztwo = '$WOJEWODZTWO', Email = '$EMAIL', Avatar = '$stary_obraz' WHERE ID_user = '" . $_SESSION['ID_user'] . "'";
        }
		mysqli_query($dbc, $query);
        
		if($error2 == false)
		{
			// Informowanie użytkownika o sukcesie.
			echo '<p>Aktualizacja profilu zakończyła się sukcesem. Czy chcesz <a href="Profil.php">zobaczyć swój profil</a>?</p>';
			echo '<br>';
		}

        mysqli_close($dbc);
      }
      else {
        echo '<p>Musisz podać wszystkie dane (zdjęcie jest opcjonalne).</p>';
      }
    }
  } // Koniec obsługi przesyłania formularza.
  else {
    // Pobieranie danych z profilu z bazy.
    $query = "SELECT Imie, Nazwisko, Plec, DataUrodz, Miasto, Wojewodztwo, Email, Avatar FROM loguj WHERE ID_user = '" . $_SESSION['ID_user'] . "'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);

    if ($row != NULL) {
      $IMIE = $row['Imie'];
      $NAZWISKO = $row['Nazwisko'];
      $PLEC = $row['Plec'];
      $DATA_URODZ = $row['DataUrodz'];
      $MIASTO = $row['Miasto'];
      $WOJEWODZTWO = $row['Wojewodztwo'];
	  $EMAIL = $row['Email'];
      $stary_obraz = $row['Avatar'];
    }
    else {
      echo '<p>Wystąpił problem przy próbie dostępu do profilu.</p>';
    }
		mysqli_close($dbc);
  }
  
?>