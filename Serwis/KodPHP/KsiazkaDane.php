<?php
  require_once('ZmiennePlikow.php');
  require_once('ZmiennePolaczenia.php');

  // Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    echo '<p>Zaloguj się, aby uzyskać dostęp do tej strony.</p>';
    exit();
  }

  // Łączenie się z bazą danych.
  $book = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Pobieranie danych użytkownika z bazy.
/*  if (!isset($_GET['ID_ksiazki'])) {
    $query = "SELECT Okladka FROM ksiazki WHERE ID_ksiazki = '" . $_GET['ID_ksiazki'] . "'";
  }
  else {
	  $query = "SELECT Okladka FROM ksiazki WHERE ID_ksiazki = '" . $_GET['ID_ksiazki'] . "'";
    //$query = "SELECT Login, Imie, Nazwisko, Plec, DataUrodz, Miasto, Wojewodztwo, Avatar FROM loguj WHERE ID_user = '" . $_GET['ID_user'] . "'";
  }
  $data = mysqli_query($book, $query);
*/

	$B_query = "SELECT ID_ksiazki, Tytul, Okladka FROM ksiazki WHERE Tytul IS NOT NULL ORDER BY ID_ksiazki DESC LIMIT 1";
	$B_data = mysqli_query($book, $B_query);

  if (mysqli_num_rows($B_data) == 1) {
    // Znaleziono wiersz z danymi użytkownika, dlatego należy je wyświetlić.
    $row = mysqli_fetch_array($B_data);
    echo '<table>';
	if (!empty($row['Okladka'])) {
      echo '<tr><td><img src="' . MM2_UPLOADPATH . $row['Okladka'] .
        '" alt="Okładka" /></td></tr>';
    }
	echo '</table>';
    
  } // Koniec przetwarzania wiersza z danymi użytkownika.
  else {
    echo '<p>Wystąpił problem przy próbie dostępu do danych.</p>';
  }

  mysqli_close($book);
?>