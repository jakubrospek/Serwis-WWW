<?php
			
			// ��czenie si� z baz� danych.
			
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				$uzytkownikID = $_SESSION['ID_user'];

			// Pobieranie danych u�ytkownik�w z bazy MySQL.
			$query = "SELECT ID_user, Login, Avatar FROM loguj WHERE ID_user=$uzytkownikID";
			$data = mysqli_query($dbc, $query);

			// Przej�cie w p�tli po tablicy danych u�ytkownik�w i wy�wietlenie ich w kodzie HTML.
			echo '<table>';
			while ($row = mysqli_fetch_array($data))
			{
				if (is_file(MM_UPLOADPATH . $row['Avatar']) && filesize(MM_UPLOADPATH . $row['Avatar']) > 0)
				{
					echo '<tr><td><img src="' . MM_UPLOADPATH . $row['Avatar'] . '" alt="' . $row['Avatar'] . '" /></td>';
				}
				else
				{
					echo '<tr><td><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['Login'] . '" /></td>';
				}
				
			}
			echo '</table>';

			mysqli_close($dbc);
			
?>