<?php

			// Przed przejœciem do dalszych operacji nale¿y siê upewniæ, ¿e u¿ytkownik jest zalogowany.
			if (!isset($_SESSION['ID_user'])) {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
			header('Location: ' . $home_url);
			}
			
			$IDuser = $_SESSION['ID_user'];
			
			// £¹czenie siê z baz¹ danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			$query1 = "SELECT * FROM(SELECT ID_oceny, ID_znajomy, ID_ksiazki, Okladka, ocena, Login FROM ksiazki INNER JOIN oceny INNER JOIN znajomi INNER JOIN loguj ON znajomi.ID_znajomy = loguj.ID_user AND ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy";
			$data1 = mysqli_query($dbc, $query1);
			
			while($row1 = mysqli_fetch_array($data1))
			$rows1[]=$row1;
			echo '<table id="MP">';
			foreach($rows1 as $row1)
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<div style="float:left; margin:5px"><div><a href="Profil.php?ID_user='.$row1['ID_znajomy'].'" style="color:white">'. $row1['Login'] .'</a><p>&nbsp</p></div><a href="KsiazkaKonkretna.php?ID_ksiazki=' . $row1['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $row1['Okladka'] .
						'" alt="Ok³adka" /></a><div style="clear:both"><meter style="width:140px" min="1" max="10" value='. $row1['ocena'] .' name="skala" style="width:200px"></meter>&nbsp  '. $row1['ocena'] .'/10</div></div>';
				}
			}
			echo '</table>';
			
			mysqli_close($dbc);

?>