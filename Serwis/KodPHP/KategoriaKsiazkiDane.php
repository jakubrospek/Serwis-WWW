<?php

	require_once('ZmiennePlikow.php');
	require_once('ZmiennePolaczenia.php');
	error_reporting(E_ALL ^ E_NOTICE);
	
	// Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
	header('Location: ' . $home_url);

  }

$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if($_GET['Autor'])
	{
		$klucz = 'Autor';
		$fraza = $_GET['Autor'];
		$SZUKAJ = trim($fraza);
		echo'Wyniki wyszukiwania w kategorii "'.$SZUKAJ.'":<br><br>';
	}
	else if($_GET['Cykl'])
	{
		$klucz = 'Cykl';
		$fraza = $_GET['Cykl'];
		$SZUKAJ = trim($fraza);
		echo'Wyniki wyszukiwania w kategorii "'.$SZUKAJ.'":<br><br>';
	}
	else if($_GET['Kategoria'])
	{
		$klucz = 'Kategoria';
		$fraza = $_GET['Kategoria'];
		$SZUKAJ = trim($fraza);
		echo'Wyniki wyszukiwania w kategorii "'.$SZUKAJ.'":<br><br>';
	}
	else if($_GET['Jezyk'])
	{
		$klucz = 'Jezyk';
		$fraza = $_GET['Jezyk'];
		$SZUKAJ = trim($fraza);
		echo'Wyniki wyszukiwania w kategorii "Język '.$SZUKAJ.'":<br><br>';
	}
		
		$na_stronie = 5; // ilość wpisów na 1 stronie
		
		$query="SELECT COUNT(ID_ksiazki) FROM ksiazki WHERE Autor LIKE '%$SZUKAJ%' OR Cykl LIKE '%$SZUKAJ%' OR Kategoria LIKE '%$SZUKAJ%' OR Jezyk LIKE '%$SZUKAJ%'";
		// wysłanie zapytania do bazy danych
		$result = mysqli_query($dbc, $query); //mysql_query($zapytanie);
		$a = mysqli_fetch_array($result);
		
	
			$liczba_wpisow = $a[0];
			$liczba_stron = ceil($liczba_wpisow / $na_stronie);
			
			// wyswietlenie ilości wyszukanych obiektów
			echo'Znaleziono: '.$liczba_wpisow.'<br /><br />';
    

			if (isset($_GET['strona'])){

				if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;

				else $strona = $_GET['strona'];

			}

			else $strona = 1;

			$od = $na_stronie * ($strona - 1);
			
			$query1="SELECT ID_ksiazki, Autor, Tytul, Cykl, Tom, Tlumaczenie, TytulOrg, ISBN, LStron, Kategoria, Jezyk, Okladka FROM ksiazki WHERE Autor LIKE '%$SZUKAJ%' OR Cykl LIKE '%$SZUKAJ%' OR Kategoria LIKE '%$SZUKAJ%' OR Jezyk LIKE '%$SZUKAJ%' LIMIT $od , $na_stronie";
			$result1=mysqli_query($dbc,$query1);
		
		while ($row = mysqli_fetch_array($result1))
		{
			
			echo '<table id="KatKsiazki">';
			echo '<a href="KsiazkaKonkretna.php?ID_ksiazki=' . $row['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $row['Okladka'] .
						'" alt="Okładka" style="margin:5px" /></a>';
			
			if (!empty($row['Autor'])) {
				echo '<tr><td>Autor:</td><td><a href="KategoriaKsiazki.php?Autor='. $row['Autor'] .'" style="color:white">' . $row['Autor'] . '</a></td></tr>';
			}
			if (!empty($row['Tytul'])) {
				echo '<tr><td>Tytul:</td><td>' . $row['Tytul'] . '</td></tr>';
			}
			if (!empty($row['Cykl'])) {
				echo '<tr><td>Cykl:</td><td><a href="KategoriaKsiazki.php?Cykl='. $row['Cykl'] .'" style="color:white">' . $row['Cykl'] . '</a></td></tr>';
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
				echo '<tr><td>Kategoria:</td><td><a href="KategoriaKsiazki.php?Kategoria='. $row['Kategoria'] .'" style="color:white">' . $row['Kategoria'] . '</a></td></tr>';
			}
			if (!empty($row['Jezyk'])) {
				echo '<tr><td>Język:</td><td><a href="KategoriaKsiazki.php?Jezyk='. $row['Jezyk'] .'" style="color:white">' . $row['Jezyk'] . '</a></td></tr>';
			}
			echo '</table>';
			echo '<hr>';
			
		}
		
		if ($liczba_wpisow > $na_stronie)
			{
				$poprzednia = $strona - 1;
				$nastepna = $strona + 1;



					if ($poprzednia > 0)
					{
						echo '<a href="KategoriaKsiazki.php?'.$klucz.'='.$fraza.'&strona='.$poprzednia.'"><<</a>';
					}
					
					for($i=1; $i<=$liczba_stron; $i++)
					{
						if(isset($_GET['strona']) && $_GET['strona']==$i)
						{
							echo ' <u>'.$i.'</u> ';
						}
						else
						{
							echo '<a href="KategoriaKsiazki.php?'.$klucz.'='.$fraza.'&strona='.$i.'"> '.$i.' </a>';
						}
					}

					if ($nastepna <= $liczba_stron)
					{
						echo '<a href="KategoriaKsiazki.php?'.$klucz.'='.$fraza.'&strona='.$nastepna.'">>></a>';
					}
			}

	mysqli_close($dbc);

?>