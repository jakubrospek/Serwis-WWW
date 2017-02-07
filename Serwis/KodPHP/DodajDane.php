<?php

require_once('ZmiennePlikow.php');
require_once('ZmiennePolaczenia.php');

  // Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
	header('Location: ' . $home_url);
  }
  

  // łączenie się z bazą danych.
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
  if (isset($_POST['submit'])) {
    // Pobieranie danych do profilu użytkownika z żądania POST.
    $AUTOR = mysqli_real_escape_string($dbc, trim($_POST['Autor']));
    $TYTUL = mysqli_real_escape_string($dbc, trim($_POST['Tytul']));
    $CYKL = mysqli_real_escape_string($dbc, trim($_POST['Cykl']));
    $TOM = mysqli_real_escape_string($dbc, trim($_POST['Tom']));
    $TLUMACZENIE = mysqli_real_escape_string($dbc, trim($_POST['Tlumaczenie']));
    $TYTUL_ORG = mysqli_real_escape_string($dbc, trim($_POST['TytulOrg']));
	$isbn = mysqli_real_escape_string($dbc, trim($_POST['ISBN']));
	$LICZBA_STRON = mysqli_real_escape_string($dbc, trim($_POST['LStron']));
	$KATEGORIA = mysqli_real_escape_string($dbc, trim($_POST['Kategoria']));
	$JEZYK = mysqli_real_escape_string($dbc, trim($_POST['Jezyk']));
	$OPIS = mysqli_real_escape_string($dbc, $_POST['Opis']);
    $stary_obraz = mysqli_real_escape_string($dbc, trim($_POST['stary_obraz']));
    $nowy_obraz = mysqli_real_escape_string($dbc, trim($_FILES['nowy_obraz']['name']));
    $nowy_obraz_typ = $_FILES['nowy_obraz']['type'];
    $nowy_obraz_rozmiar = $_FILES['$nowy_obraz']['size'];
	if($nowy_obraz)
	{
		list($nowy_obraz_dlugosc, $nowy_obraz_wysokosc) = getimagesize($_FILES['nowy_obraz']['tmp_name']);
	}
    $error = false;
	$error2 = false;

    // Walidacja i (w razie potrzeby) przenoszenie przesłanego pliku graficznego.
    if (!empty($nowy_obraz)) {
      if ((($nowy_obraz_typ == 'image/gif') || ($nowy_obraz_typ == 'image/jpeg') || ($nowy_obraz_typ == 'image/pjpeg') ||
        ($nowy_obraz_typ == 'image/png')) && ($nowy_obraz_rozmiar > 0) && ($nowy_obraz_rozmiar <= MM2_MAXFILESIZE) &&
        ($nowy_obraz_dlugosc == MM2_MAXIMGWIDTH) && ($nowy_obraz_wysokosc == MM2_MAXIMGHEIGHT)) {
        if ($_FILES['nowy_obraz']['error'] == 0) {
          // Przenoszenie pliku do docelowego katalogu.
          $docelowe = MM2_UPLOADPATH . basename($nowy_obraz);
          if (move_uploaded_file($_FILES['nowy_obraz']['tmp_name'], $docelowe)) {
            // Przenoszenie nowego pliku zakończyło się powodzeniem.
	    // Teraz trzeba usunąć poprzednie zdjęcie.
            if (!empty($stary_obraz) && ($stary_obraz != $nowy_obraz)) {
              @unlink(MM2_UPLOADPATH . $stary_obraz);
            }
          }
          else {
            // Przenoszenie nowego pliku zakończyło się powodzeniem.
	    // Należy usunąć tymczasowy plik i ustawić flagę błędu.
            @unlink($_FILES['nowy_obraz']['tmp_name']);
            $error = true;
            echo '<p>Wystąpił problem przy przesyłaniu pliku.</p>';
          }
        }
      }
      else {
        // Nowy plik jest nieprawidłowy, dlatego trzeba usunąć tymczasowy plik i ustawić flagę błędu.
        @unlink($_FILES['nowy_obraz']['tmp_name']);
        $error = true;
		$error2 = true;
        echo '<p>Musisz wybrać plik graficzny GIF, JPEG lub PNG. Miniatura musi mieć rozmiar ' . MM2_MAXIMGWIDTH . 'x' . MM2_MAXIMGHEIGHT . ' (w pikselach).</p>';
      }
    }
	
	$TEST1 = "/^[a-ząęółśżźćń\sA-ZĄĘÓŁŚŻŹĆŃ\s]+$/";
	$TEST2 = "/^[\d]+$/";
	$TEST3 = "/^[a-ząęółśżźćń\sA-ZĄĘÓŁŚŻŹĆŃ\s]+$|^[---]{3}$/";
	
	if(!preg_match($TEST1, $AUTOR) || strlen($AUTOR) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Autor" !</br>';
	}
	else if(!preg_match($TEST2, $TOM))
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Tom" !</br>';
	}
	else if(!preg_match($TEST3, $TLUMACZENIE))
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Tłumaczenie" !</br>';
	}
	else if(!preg_match($TEST2, $isbn))
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "ISBN" !</br>';
	}
	else if(!preg_match($TEST2, $LICZBA_STRON))
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Liczba stron" !</br>';
	}
	else if(!preg_match($TEST1, $KATEGORIA) || strlen($KATEGORIA) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Kategoria" !</br>';
	}
	else if(!preg_match($TEST1, $JEZYK) || strlen($JEZYK) < 2)
	{
		$error = true;
		echo 'Niepoprawnie wypełnione pole "Język" !</br>';
	}
	else
	{
		$error = false;
	}


    if (!$error) {
      if (!empty($AUTOR) && !empty($TYTUL) && !empty($CYKL) && !empty($TOM) && !empty($TLUMACZENIE) && !empty($TYTUL_ORG) && !empty($isbn) && !empty($LICZBA_STRON) && !empty($KATEGORIA) && !empty($JEZYK) && !empty($OPIS)/*potem dodać $OPIS*/){
        if (!empty($nowy_obraz)) {
			
			$query = "INSERT INTO ksiazki(Autor, Tytul, Cykl, Tom, Tlumaczenie, TytulOrg, ISBN, LStron, Kategoria, Jezyk, Opis, Okladka) VALUES('$AUTOR','$TYTUL','$CYKL','$TOM','$TLUMACZENIE','$TYTUL_ORG','$isbn','$LICZBA_STRON','$KATEGORIA','$JEZYK', '$OPIS', '$nowy_obraz')";
			
        }
        else {
			
			$query = "INSERT INTO ksiazki(Autor, Tytul, Cykl, Tom, Tlumaczenie, TytulOrg, ISBN, LStron, Kategoria, Jezyk, Opis, Okladka) VALUES('$AUTOR','$TYTUL','$CYKL','$TOM','$TLUMACZENIE','$TYTUL_ORG','$isbn','$LICZBA_STRON','$KATEGORIA','$JEZYK', '$OPIS', '$nowy_obraz')";
			
        }
        mysqli_query($dbc, $query);
		
		if($error2 == false)
		{
			// Informowanie użytkownika o sukcesie.
			echo '<p>Aktualizacja profilu zakończyła się sukcesem. Czy chcesz <a href="Ksiazka.php">zobaczyć zmiany?</a>?</p>';
		}

        mysqli_close($dbc);
      }
      else {
        echo '<p>Musisz podać wszystkie dane (zdjęcie jest opcjonalne).</p>';
		mysqli_close($dbc);
      }
    }
  } // Koniec obsługi przesyłania formularza.
  
	 mysqli_close($dbc);
?>