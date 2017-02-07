<?php
  session_start();

  // Jeœli zmienne sesji nie s¹ ustawione, skrypt próbuje u¿yæ
  // plików cookie.
  if (!isset($_SESSION['ID_user'])) {
    if (isset($_COOKIE['ID_user']) && isset($_COOKIE['Login'])) {
      $_SESSION['ID_user'] = $_COOKIE['ID_user'];
      $_SESSION['Login'] = $_COOKIE['Login'];
    }
  }
?>