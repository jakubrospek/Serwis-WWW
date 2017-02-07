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

//$B_query = "SELECT ID_ksiazki, Autor, Tytul, Cykl, Tom, Tlumaczenie, TytulOrg, ISBN, LStron, Kategoria, Jezyk FROM ksiazki WHERE Tytul IS NOT NULL ORDER BY ID_ksiazki DESC LIMIT 1";
$B_query = "SELECT ID_ksiazki, Autor, Tytul, Cykl, Tom, Tlumaczenie, TytulOrg, ISBN, LStron, Kategoria, Jezyk FROM ksiazki WHERE Tytul IS NOT NULL ORDER BY ID_ksiazki";
$B_data = mysqli_query($book, $B_query);

//if (mysqli_num_rows($B_data) == 1) {
    // Znaleziono wiersz z danymi użytkownika, dlatego należy je wyświetlić.
    while($row = mysqli_fetch_array($B_data)) {
    echo '<table>';
	if (!empty($row['Autor'])) {
      echo '<tr><td>Autor:</td><td>' . $row['Autor'] . '</td></tr>';
    }
    if (!empty($row['Tytul'])) {
      echo '<tr><td>Tytul:</td><td>' . $row['Tytul'] . '</td></tr>';
    }
    if (!empty($row['Cykl'])) {
      echo '<tr><td>Cykl:</td><td>' . $row['Cykl'] . '</td></tr>';
    }
	if (!empty($row['Tom'])) {
      echo '<tr><td>Tom:</td><td>' . $row['Tom'] . '</td></tr>';
    }
	if (!empty($row['Tlumaczenie'])) {
      echo '<tr><td>Tłumaczenie:</td><td>' . $row['Tlumaczenie'] . '</td></tr>';
    }
	if (!empty($row['TytulOrg'])) {
      echo '<tr><td>Tytuł oryginału:</td><td>' . $row['TytulOrg'] . '</td></tr>';
    }
	if (!empty($row['ISBN'])) {
      echo '<tr><td>ISBN:</td><td>' . $row['ISBN'] . '</td></tr>';
    }
	if (!empty($row['LStron'])) {
      echo '<tr><td>Liczba stron:</td><td>' . $row['LStron'] . '</td></tr>';
    }
	if (!empty($row['Kategoria'])) {
      echo '<tr><td>Kategoria:</td><td>' . $row['Kategoria'] . '</td></tr>';
    }
	if (!empty($row['Jezyk'])) {
      echo '<tr><td>Język:</td><td>' . $row['Jezyk'] . '</td></tr>';
    }
	echo '</table>';
	} // Koniec przetwarzania wiersza z danymi użytkownika.
  /*else {
    echo '<p class="error">Wystąpił problem przy próbie dostępu do danych.</p>';
  }*/

  mysqli_close($book);
	
	?>