<?php
			
			// Przed przejœciem do dalszych operacji nale¿y siê upewniæ, ¿e u¿ytkownik jest zalogowany.
			if (!isset($_SESSION['ID_user'])) {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
			header('Location: ' . $home_url);
	
			//exit();
  }
			
			// £¹czenie siê z baz¹ danych.
			
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$IDuser = $_GET['ID_user'];
			
			$na_stronie = 6;
			
			
			// Pobieranie danych u¿ytkowników z bazy MySQL.
			$B_query = "SELECT COUNT(ID_ksiazki) FROM ksiazki, oceny WHERE oceny.oceny_id_user='$IDuser' AND oceny.oceny_id_ksiazki=ksiazki.ID_ksiazki ORDER BY ID_ksiazki DESC";
			$B_data = mysqli_query($dbc, $B_query);
			$a = mysqli_fetch_array($B_data);
	
			$liczba_wpisow = $a[0];
			$liczba_stron = ceil($liczba_wpisow / $na_stronie);
    

			if (isset($_GET['strona'])){

				if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;

				else $strona = $_GET['strona'];

			}

			else $strona = 1;

			$od = $na_stronie * ($strona - 1);
			
			
			$B_query1 = "SELECT ID_ksiazki, Tytul, Okladka, ocena FROM ksiazki, oceny WHERE oceny.oceny_id_user='$IDuser' AND oceny.oceny_id_ksiazki=ksiazki.ID_ksiazki ORDER BY ID_ksiazki DESC LIMIT $od , $na_stronie";
			$B_data1 = mysqli_query($dbc, $B_query1);
			
			// Przejœcie w pêtli po tablicy danych u¿ytkowników i wyœwietlenie ich w kodzie HTML.
			echo '<table id="MP">';
			while ($B_row = mysqli_fetch_array($B_data1))
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<div style="float:left; margin:5px"><a href="KsiazkaKonkretna.php?ID_ksiazki=' . $B_row['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $B_row['Okladka'] .
						'" alt="Ok³adka" /></a><div style="clear:both"><meter style="width:140px" min="1" max="10" value='. $B_row['ocena'] .' name="skala" style="width:200px"></meter>&nbsp  '. $B_row['ocena'] .'/10</div></div>';
				}
			}
			echo '</table>';
			
			if ($liczba_wpisow > $na_stronie)
			{
				$poprzednia = $strona - 1;
				$nastepna = $strona + 1;



					if ($poprzednia > 0)
					{
						echo '<a href="P.php?ID_user='.$IDuser.'&strona='.$poprzednia.'"><<</a>';
					}
					
					for($i=1; $i<=$liczba_stron; $i++)
					{
						if(isset($_GET['strona']) && $_GET['strona']==$i)
						{
							echo ' <u>'.$i.'</u> ';
						}
						else
						{
							echo '<a href="P.php?ID_user='.$IDuser.'&strona='.$i.'"> '.$i.' </a>';
						}
					}

					if ($nastepna <= $liczba_stron)
					{
						echo '<a href="P.php?ID_user='.$IDuser.'&strona='.$nastepna.'">>></a>';
					}
			}
			
			mysqli_close($dbc);
			
?>