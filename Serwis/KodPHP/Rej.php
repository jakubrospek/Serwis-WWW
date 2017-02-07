<?php

  
  require_once('ZmiennePolaczenia.php');

  // Łączenie się z bazą danych.
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Pobieranie danych do profilu z żądania POST.
    $USER = mysqli_real_escape_string($dbc, trim($_POST['Login']));
    $HASLO1 = mysqli_real_escape_string($dbc, trim($_POST['Haslo']));
    $HASLO2 = mysqli_real_escape_string($dbc, trim($_POST['Haslo2']));
	$szyfr = sha1($HASLO1);

    if (!empty($USER) && !empty($HASLO1) && !empty($HASLO2) && ($HASLO1 == $HASLO2)){
		
      // Sprawdzanie, czy dana nazwa nie jest już zajęta.
      $query = "SELECT * FROM loguj WHERE Login = '$USER'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // Nazwa jest nowa, dlatego można wstawić dane do bazy.
        $query = "INSERT INTO loguj (Login, Haslo) VALUES ('$USER', '$szyfr')";
        mysqli_query($dbc, $query);
		
		header("Location: Zaloguj.php");

        mysqli_close($dbc);
        exit();
      }
      else {
        // Dana nazwa jest już zajęta, dlatego należy wyświetlić komunikat o błędzie.
		echo '<br>';
        echo '<p>Dana nazwa jest już zajęta - spróbuj użyć innej.</p>';
		$USER = "";
      }
    }
    else {
		echo '<br>';
		echo '<p>Musisz wpisać wszystkie dane (hasło należy wprowadzić ' .
        'dwukrotnie).</p>';
    }
  }

  mysqli_close($dbc);
?>