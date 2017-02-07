<?php
			
			// £¹czenie siê z baz¹ danych.
			
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

			// Pobieranie danych u¿ytkowników z bazy MySQL.
			$query = "SELECT ID_user, Login, Avatar FROM loguj WHERE Login IS NOT NULL ORDER BY ID_user DESC LIMIT 5";
			$data = mysqli_query($dbc, $query);

			// Przejœcie w pêtli po tablicy danych u¿ytkowników i wyœwietlenie ich w kodzie HTML.
			echo '<table>';
			while ($row = mysqli_fetch_array($data))
			{
				if (is_file(MM_UPLOADPATH . $row['Avatar']) && filesize(MM_UPLOADPATH . $row['Avatar']) > 0)
				{
					echo '<tr><td><a href="Profil.php?ID_user=' . $row['ID_user'] . '"><img src="' . MM_UPLOADPATH . $row['Avatar'] . '" alt="' . $row['Avatar'] . '" /></a></td>';
				}
				else
				{
					echo '<tr><td><a href="Profil.php?ID_user=' . $row['ID_user'] . '"><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['Login'] . '" /></a></td>';
				}
				if (isset($_SESSION['ID_user']))
				{
					echo '<td><a href="Profil.php?ID_user=' . $row['ID_user'] . '">' . $row['Login'] . '</a></td></tr>';
				}
			}
			echo '</table>';

			mysqli_close($dbc);
			
?>