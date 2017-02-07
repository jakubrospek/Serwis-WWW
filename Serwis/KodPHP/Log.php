<?php

require_once('ZmiennePolaczenia.php');

  // Rozpoczynanie sesji.
  session_start();
  echo '</br>';
  echo '<p>Zaloguj się, aby uzyskać dostęp do serwisu.</p>';
  // Usuwanie komunikatu o błędzie.
  $error_msg = "";

  // Jeśli użytkownik nie jest zalogowany, należy spróbować go zalogować.
  if (!isset($_SESSION['ID_user'])) {
    if (isset($_POST['submit'])) {
      // Łączenie się z bazą danych.
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Pobieranie danych logowania wpisanych przez użytkownika.
      $USER = mysqli_real_escape_string($dbc, trim($_POST['Login']));
      $HASLO = mysqli_real_escape_string($dbc, trim($_POST['Haslo']));
	  //$AdminNick='admin';
	  
      if (!empty($USER) && !empty($HASLO)) {
        // Wyszukiwanie nazwy użytkownika i hasła w bazie danych.
        $query = "SELECT ID_user, Login FROM loguj WHERE Login = '$USER' AND Haslo = SHA('$HASLO')";
        $data = mysqli_query($dbc, $query);
		
        if ((mysqli_num_rows($data) == 1)) {
          // Dane logowania są poprawne, dlatego należy ustawić zmienne sesji z
		// identyfikatorem i nazwą użytkownika, a następnie przejść do strony głównej.
          $row = mysqli_fetch_array($data);
          $_SESSION['ID_user'] = $row['ID_user'];
          $_SESSION['Login'] = $row['Login'];
          setcookie('ID_user', $row['ID_user'], time() + (60 * 60 * 24 * 30));    // Wygasa za 30 dni.
          setcookie('Login', $row['Login'], time() + (60 * 60 * 24 * 30));  // Wygasa za 30 dni.
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/STRONAINT/Glowna.php';
          header('Location: ' . $home_url);
        }
        else {
          // Para nazwa użytkownika - hasło jest nieprawidłowa, dlatego należy ustawić komunikat o błędzie.
		 echo '<br>';
         echo '<p>Musisz podać poprawną parę nazwa - hasło, aby się zalogować.</p>';
        }
      }
      else {
        // Użytkownik nie podał pary nazwa - hasło, dlatego należy ustawić komunikat o błędzie.
		echo '<br>';
        echo '<p>Musisz podać parę nazwa - hasło, aby się zalogować.</p>';
      }
    }
  }
  else {
    // Potwierdzenie udanego zalogowania.
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/STRONAINT/Glowna.php';
          header('Location: ' . $home_url);
  }

?>