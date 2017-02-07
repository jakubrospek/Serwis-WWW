<?php
			
			// ��czenie si� z baz� danych.
			
			$book = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

			// Pobieranie danych u�ytkownik�w z bazy MySQL.
			$B_query = "SELECT ID_ksiazki, Tytul, Okladka FROM ksiazki WHERE Tytul IS NOT NULL ORDER BY ID_ksiazki DESC LIMIT 1";
			$B_data = mysqli_query($book, $B_query);
			
			echo '<h3><a href="OstDodane.php">Ostatnio dodane:</a></h3>';

			// Przej�cie w p�tli po tablicy danych u�ytkownik�w i wy�wietlenie ich w kodzie HTML.
			echo '<table>';
			while ($B_row = mysqli_fetch_array($B_data))
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<a href="Ksiazka.php?ID_ksiazki=' . $B_row['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $B_row['Okladka'] .
						'" alt="Ok�adka" /></a>' ;
				}
			}
			echo '</table>';

			mysqli_close($book);
			
?>