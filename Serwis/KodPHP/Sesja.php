<?php
  session_start();

  // Je�li zmienne sesji nie s� ustawione, skrypt pr�buje u�y�
  // plik�w cookie.
  if (!isset($_SESSION['ID_user'])) {
    if (isset($_COOKIE['ID_user']) && isset($_COOKIE['Login'])) {
      $_SESSION['ID_user'] = $_COOKIE['ID_user'];
      $_SESSION['Login'] = $_COOKIE['Login'];
    }
  }
?>