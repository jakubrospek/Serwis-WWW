<?php
			
			// ��czenie si� z baz� danych.
			
			$book = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

			// Pobieranie danych u�ytkownik�w z bazy MySQL.
			$B_query = "SELECT ID_ksiazki, Tytul, Okladka FROM ksiazki WHERE ID_ksiazki= '" . $_GET['ID_ksiazki'] . "'";
			$B_data = mysqli_query($book, $B_query);

			// Przej�cie w p�tli po tablicy danych u�ytkownik�w i wy�wietlenie ich w kodzie HTML.
			echo '<table>';
			while ($B_row = mysqli_fetch_array($B_data))
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<a href="KsiazkaKonkretna.php?ID_ksiazki=' . $B_row['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $B_row['Okladka'] .
						'" alt="Ok�adka" /></a>' ;
				}
			}
			echo '</table>';

			mysqli_close($book);
			
?>