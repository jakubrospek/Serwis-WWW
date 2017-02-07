<?php

  require_once('ZmiennePlikow.php');
  require_once('ZmiennePolaczenia.php');

  // Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    echo '<p>Zaloguj się, aby uzyskać dostęp do tej strony.</p>';
    exit();
  }

  // Łączenie się z bazą danych.
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Pobieranie danych użytkownika z bazy.
  if (!isset($_GET['ID_ksiazki'])) {
    $query = "SELECT Opis FROM ksiazki WHERE ID_ksiazki = '" . $_GET['ID_ksiazki'] . "'";
  }
  else {
	  $query = "SELECT Opis FROM ksiazki WHERE ID_ksiazki = '" . $_GET['ID_ksiazki'] . "'";
    //$query = "SELECT Login, Imie, Nazwisko, Plec, DataUrodz, Miasto, Wojewodztwo, Avatar FROM loguj WHERE ID_user = '" . $_GET['ID_user'] . "'";
  }
  $data = mysqli_query($dbc, $query);

if (mysqli_num_rows($data) == 1) {
    // Znaleziono wiersz z danymi użytkownika, dlatego należy je wyświetlić.
    $row = mysqli_fetch_array($data);
    echo '<table>';
	if (!empty($row['Opis'])) {
      echo '<tr><td>' . $row['Opis'] . '</td></tr>';
    }
	echo '</table>';
	
	} // Koniec przetwarzania wiersza z danymi użytkownika.
  else {
    echo '<p>Wystąpił problem przy próbie dostępu do danych.</p>';
  }

  mysqli_close($dbc);
	
	?>