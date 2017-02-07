<?php
  require_once('ZmiennePlikow.php');
  require_once('ZmiennePolaczenia.php');

  // Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
	header('Location: ' . $home_url);
  }
  else {
    //echo('<p>Zalogowany użytkownik: ' . $_SESSION['Login']);
  }

  // Łączenie się z bazą danych.
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  // Pobieranie danych użytkownika z bazy.
		if (!isset($_GET['ID_user']))
		{
			$query = "SELECT Login, Imie, Nazwisko, Plec, DataUrodz, Miasto, Wojewodztwo, Email, Avatar FROM loguj WHERE ID_user = '" . $_SESSION['ID_user'] . "'";
		}
		else
		{
			$query = "SELECT ID_user, Login, Imie, Nazwisko, Plec, DataUrodz, Miasto, Wojewodztwo, Email, Avatar FROM loguj WHERE ID_user = '" . $_GET['ID_user'] . "'";
		}
		$data = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($data);
  
  if($_SESSION['Login']!=$row['Login'])				// to jest warunek gdy wchodzimy na czyjś profil a nie na własny.
  {
			echo('<p>Profil użytkownika: ' . $row['Login'] . '</p>');
			echo '<br>';
			$IDuser = $_GET['ID_user'];
			// Pobieranie danych użytkowników z bazy MySQL.
			$B_query = "SELECT ID_ksiazki, Tytul, Okladka, ocena FROM ksiazki INNER JOIN oceny ON oceny.oceny_id_user='$IDuser' AND oceny.oceny_id_ksiazki=ksiazki.ID_ksiazki ORDER BY ID_ksiazki DESC LIMIT 3";  // wyświetla ostatnie 3 ocenione książki przez danego użytkownika.
			$B_data = mysqli_query($dbc, $B_query);
			
			$zalogowany = $_SESSION['ID_user'];
			
			$P_query = "SELECT ID_zalogowany, ID_znajomy FROM znajomi WHERE ID_zalogowany='$zalogowany' AND ID_znajomy ='$IDuser'";
			$P_data = mysqli_query($dbc, $P_query);
	
	if(mysqli_num_rows($P_data)!=0)
	{
		if (mysqli_num_rows($data) == 1)
		{
			// Znaleziono wiersz z danymi użytkownika, dlatego należy je wyświetlić.
			
			echo '<table>';
			if($_SESSION['ID_user']==6)
			{
				echo '<a href="KodPHP/UsunKonto.php?ID_user='.$_GET['ID_user'].'" style="float:right">Usuń konto</a>';
			}
			if (!empty($row['Imie']))
			{
				echo '<tr><td>Imię:</td><td>' . $row['Imie'] . '</td></tr>';
			}
			if (!empty($row['Nazwisko']))
			{
				echo '<tr><td>Nazwisko:</td><td>' . $row['Nazwisko'] . '</td></tr>';
			}
			if (!empty($row['Plec']))
			{
				echo '<tr><td>Płeć:</td><td>';
				if ($row['Plec'] == 'M')
				{
					echo 'Mężczyzna';
				}
				else if ($row['Plec'] == 'K')
				{
					echo 'Kobieta';
				}
				else
				{
					echo '?';
				}
				echo '</td></tr>';
			}
			if (!empty($row['DataUrodz']))
			{
				if (!isset($_GET['ID_user']) || ($_SESSION['ID_user'] == $_GET['ID_user']))
				{
					// Wyświetlanie dnia urodzenia danemu użytkownikowi.
					echo '<tr><td>Data urodzenia:</td><td>' . $row['DataUrodz'] . '</td></tr>';
				}
				else
				{
					// Wyświetlanie samego roku pozostałym użytkownikom.
					list($year, $month, $day) = explode('-', $row['DataUrodz']);
					echo '<tr><td>Rok urodzenia:</td><td>' . $year . '</td></tr>';
				}
			}
			if (!empty($row['Miasto']) || !empty($row['Wojewodztwo']))
			{
				echo '<tr><td>Miejscowość:</td><td>' . $row['Miasto'] . ', ' . $row['Wojewodztwo'] . '</td></tr>';
			}
			if(!empty($row['Email']))
			{
				echo '<tr><td>Adres e-mail:</td><td>' . $row['Email'] . '</td></tr>';
			}
			if(!empty($row['Avatar']))
			{
				echo '<tr><td>Zdjęcie:</td><td><img src="' . MM_UPLOADPATH . $row['Avatar'] .
				'" alt="Zdjęcie z profilu" /></td></tr>';
			}
			echo '</table>';
			if(!isset($_GET['ID_user']) || ($_SESSION['ID_user'] == $_GET['ID_user']))
			{
				echo '<p>Czy chcesz <a href="EdytujProfil.php">zmodyfikować profil</a>?</p>';
			}
		} 	// Koniec przetwarzania wiersza z danymi użytkownika.
		else
		{
			echo '<p>Wystąpił problem przy próbie dostępu do profilu.</p>';
		}
	}
	else
	{
			echo 'Szczegółowe dane o użytkowniku są niewidoczne ponieważ nie należy do kręgu osób obserwowanych.';
			echo '<br>';
			if($_SESSION['ID_user']==6)
			{
				echo '<a href="KodPHP/UsunKonto.php?ID_user='.$_GET['ID_user'].'" style="float:right">Usuń konto</a>';
			}
	}
			
			echo '<br>';
			echo '<h1>Ostatnio ocenił:</h1>';
			echo '<br>';
			// Przejście w pętli po tablicy danych użytkowników i wyświetlenie ich w kodzie HTML.
			
		if(mysqli_num_rows($B_data)!=0)
		{
			echo '<table id="MP">';
			while ($B_row = mysqli_fetch_array($B_data))
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<div style="float:left"><a href="KsiazkaKonkretna.php?ID_ksiazki=' . $B_row['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $B_row['Okladka'] .
						'" alt="Okładka" /></a><div style="clear:both"><meter style="width:140px" min="1" max="10" value='. $B_row['ocena'] .' name="skala" style="width:200px"></meter>&nbsp  '. $B_row['ocena'] .'/10</div></div>';
				}
			}
			echo '</table>';
		}
		else
		{
			echo '<table id="MP">';
			echo '<img src="images/miniatura.jpg"/>';
			echo '<img src="images/miniatura.jpg"/>';
			echo '<img src="images/miniatura.jpg"/>';
			echo '</table>';
			
		}
			
			
			
			if(mysqli_num_rows($P_data)==0)
			{
				$przycisk1 = '<a href="kodPHP/Obserwuj.php?ID_user='.$_GET['ID_user'].'">Obserwuj</a>&nbsp';
				$przycisk = '';
			}
			else
			{
				$przycisk1 = '<a href="kodPHP/Nieobserwuj.php?ID_user='.$_GET['ID_user'].'">Usun z obserwowanych</a>&nbsp';
				$przycisk = '<a href="P.php?ID_user='.$_GET['ID_user'].'">Zobacz półkę</a>';
			}
			
			
			
			echo '<nav id="przycisk">
            
					<ul>
						<li>'.$przycisk1.''.$przycisk.'</li>
						<br>
						<li></li>
					</ul>
					</nav>';
	
}
else
{
			echo '<table>';
			if(!empty($row['Login']))
			{
				echo '<tr><td>Nazwa użytkownika:</td><td>' . $row['Login'] . '</td></tr>';
				echo '<tr><td>&nbsp</td></tr>';
			}
			if (!empty($row['Imie']))
			{
				echo '<tr><td>Imię:</td><td>' . $row['Imie'] . '</td></tr>';
			}
			if (!empty($row['Nazwisko']))
			{
				echo '<tr><td>Nazwisko:</td><td>' . $row['Nazwisko'] . '</td></tr>';
			}
			if (!empty($row['Plec']))
			{
				echo '<tr><td>Płeć:</td><td>';
				if ($row['Plec'] == 'M')
				{
					echo 'Mężczyzna';
				}
				else if ($row['Plec'] == 'K')
				{
					echo 'Kobieta';
				}
				else
				{
					echo '?';
				}
				echo '</td></tr>';
			}
			if (!empty($row['DataUrodz']))
			{
				if (!isset($_GET['ID_user']) || ($_SESSION['ID_user'] == $_GET['ID_user']))
				{
					// Wyświetlanie dnia urodzenia danemu użytkownikowi.
					echo '<tr><td>Data urodzenia:</td><td>' . $row['DataUrodz'] . '</td></tr>';
				}
				else
				{
					// Wyświetlanie samego roku pozostałym użytkownikom.
					list($year, $month, $day) = explode('-', $row['DataUrodz']);
					echo '<tr><td>Rok urodzenia:</td><td>' . $year . '</td></tr>';
				}
			}
			if (!empty($row['Miasto']) || !empty($row['Wojewodztwo']))
			{
				echo '<tr><td>Miejscowość:</td><td>' . $row['Miasto'] . ', ' . $row['Wojewodztwo'] . '</td></tr>';
			}
			if(!empty($row['Email']))
			{
				echo '<tr><td>Adres e-mail:</td><td>' . $row['Email'] . '</td></tr>';
			}
			if (!empty($row['Avatar']))
			{
				echo '<tr><td>Zdjęcie:</td><td><img src="' . MM_UPLOADPATH . $row['Avatar'] .
				'" alt="Zdjęcie z profilu" /></td></tr>';
			}
			echo '</table>';
			
			if (!isset($_GET['ID_user']) || ($_SESSION['ID_user'] == $_GET['ID_user']))
			{
				echo '<p>Czy chcesz <a href="EdytujProfil.php">zmodyfikować profil</a>?</p>';
			}
} 	// Koniec przetwarzania wiersza z danymi użytkownika.

  mysqli_close($dbc);
?>