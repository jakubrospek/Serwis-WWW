<?php

			// Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
			if (!isset($_SESSION['ID_user'])) {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
			header('Location: ' . $home_url);
			}
			
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$IDuser = $_SESSION['ID_user'];
			
			//$query1 = "SELECT * FROM(SELECT ID_oceny, ID_znajomy, ID_ksiazki, Okladka, ocena, opinia, dodal FROM ksiazki INNER JOIN oceny INNER JOIN znajomi INNER JOIN komentarze ON ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND ksiazki.ID_ksiazki = komentarze.id_ksiazki AND znajomi.ID_znajomy = komentarze.id_user AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy LIMIT 3";
			//$query1 = "SELECT * FROM(SELECT ID_oceny, ID_znajomy, ID_ksiazki, Okladka, ocena FROM ksiazki INNER JOIN oceny INNER JOIN znajomi ON ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy LIMIT 3";
			$query = "SELECT * FROM(SELECT oceny.ID_oceny, znajomi.ID_znajomy, ksiazki.ID_ksiazki, ksiazki.Okladka, oceny.ocena, komentarze.dodal, komentarze.opinia FROM ksiazki INNER JOIN oceny INNER JOIN znajomi INNER JOIN komentarze ON ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy WHERE znajomi.ID_znajomy = komentarze.ID_user AND ksiazki.ID_ksiazki = komentarze.id_ksiazki GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy";
			$data = mysqli_query($dbc, $query);
			$liczba_wpisow=0;
			
			
			while($row1 = mysqli_fetch_array($data))
			$rows1[]=$row1;
			
			echo '<table id="MP">';
			foreach($rows1 as $row1)
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<div style="float:left"><a href="KsiazkaKonkretna.php?ID_ksiazki=' . $row1['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $row1['Okladka'] .
						'" alt="Okładka" /></a><div style="clear:both"><meter style="width:140px" min="1" max="10" value='. $row1['ocena'] .' name="skala" style="width:200px"></meter>&nbsp  '. $row1['ocena'] .'/10</div><p>&nbsp</p>
						<div style="clear:both; width:197px"><a href="Profil.php?ID_user='.$row1['ID_znajomy'].'" style="color:white">'.$row1['dodal'].'</a> napisał:<p>&nbsp</p><p><textarea style="width:197px" disabled="disabled" rows=10>'.$row1['opinia'].'</textarea><p>&nbsp</p></p></div></div>';
				}
			}
			echo '</table>';
		
			
			
			mysqli_close($dbc);

?>