<?php
			
			// Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
			if (!isset($_SESSION['ID_user'])){
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
			header('Location: ' . $home_url);
			}		
				
			// Łączenie się z bazą danych.
			
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$IDuser = $_SESSION['ID_user'];
			
			$na_stronie = 24;
			
			$B_query = "SELECT COUNT(ID_user) FROM znajomi, loguj WHERE znajomi.ID_zalogowany=$IDuser  AND loguj.ID_user=znajomi.ID_znajomy";
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
			
			// Pobieranie danych użytkowników z bazy MySQL.
			$B_query1 = "SELECT ID_user, ID_zalogowany, ID_znajomy, Login, Avatar FROM loguj, znajomi WHERE znajomi.ID_zalogowany=$IDuser  AND loguj.ID_user=znajomi.ID_znajomy LIMIT $od , $na_stronie";
			$B_data1 = mysqli_query($dbc, $B_query1);
			
			echo '<table id="obserwowani">';
			while ($row = mysqli_fetch_array($B_data1))
			{
				if (is_file(MM_UPLOADPATH . $row['Avatar']) && filesize(MM_UPLOADPATH . $row['Avatar']) > 0)
				{
					echo '<div id="listaObser"><a href="Profil.php?ID_user=' . $row['ID_user'] . '"><img src="' . MM_UPLOADPATH . $row['Avatar'] . '" alt="' . $row['Avatar'] . '" /></a><div><a href="Profil.php?ID_user=' . $row['ID_user'] . '">' . $row['Login'] . '</a></div></div>';
				}
				else
				{
					echo '<div id="listaObser"><a href="Profil.php?ID_user=' . $row['ID_user'] . '"><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['Login'] . '" /></a><div><a href="Profil.php?ID_user=' . $row['ID_user'] . '">' . $row['Login'] . '</a></div></div>';
				}
			}
			echo '</table>';
			
			if ($liczba_wpisow > $na_stronie)
			{
				$poprzednia = $strona - 1;
				$nastepna = $strona + 1;



					if ($poprzednia > 0)
					{
						echo '<a href="Obserwowani.php?strona='.$poprzednia.'"><<</a>';
					}
					
					for($i=1; $i<=$liczba_stron; $i++)
					{
						if(isset($_GET['strona']) && $_GET['strona']==$i)
						{
							echo ' <u>'.$i.'</u> ';
						}
						else
						{
							echo '<a href="Obserwowani.php?strona='.$i.'"> '.$i.' </a>';
						}
					}

					if ($nastepna <= $liczba_stron)
					{
						echo '<a href="Obserwowani.php?strona='.$nastepna.'">>></a>';
					}
			}

			mysqli_close($dbc);
			
?>