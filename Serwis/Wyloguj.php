<?php
  // Je�li u�ytkownik jest zalogowany, nale�y usun�� zmienne sesji, aby go wylogowa�.
  session_start();
  if (isset($_SESSION['ID_user'])) {
    // Usuni�cie zmiennych sesji przez wykasowanie element�w tablicy $_SESSION.
    $_SESSION = array();

    // Usuni�cie pliku cookie sesji przez ustawienie daty wygasania na godzin� (3600 sekund) wstecz.
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }

    // Ko�czenie sesji.
    session_destroy();
  }

  // Usuni�cie plik�w cookie z identyfikatorem i nazw� u�ytkownika
  // przez ustawienie ich daty wygasania na godzin� wstecz (3600 sekund).
  setcookie('ID_user', '', time() - 3600);
  setcookie('Login', '', time() - 3600);

  // Skierowanie u�ytkownika do strony logowania.
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
  header('Location: ' . $home_url);
  
?>