<?php
  // Jeœli u¿ytkownik jest zalogowany, nale¿y usun¹æ zmienne sesji, aby go wylogowaæ.
  session_start();
  if (isset($_SESSION['ID_user'])) {
    // Usuniêcie zmiennych sesji przez wykasowanie elementów tablicy $_SESSION.
    $_SESSION = array();

    // Usuniêcie pliku cookie sesji przez ustawienie daty wygasania na godzinê (3600 sekund) wstecz.
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }

    // Koñczenie sesji.
    session_destroy();
  }

  // Usuniêcie plików cookie z identyfikatorem i nazw¹ u¿ytkownika
  // przez ustawienie ich daty wygasania na godzinê wstecz (3600 sekund).
  setcookie('ID_user', '', time() - 3600);
  setcookie('Login', '', time() - 3600);

  // Skierowanie u¿ytkownika do strony logowania.
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
  header('Location: ' . $home_url);
  
?>