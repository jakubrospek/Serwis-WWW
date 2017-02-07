<?php
			
			// Łączenie się z bazą danych.
			
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
			$ksiazkiID = $_GET['ID_ksiazki'];
			
			$na_stronie = 5; // ilość wpisów na 1 stronie
			

			$zapytanie = "SELECT COUNT(ID_kom) FROM komentarze WHERE id_ksiazki=$ksiazkiID";
			$wynik = mysqli_query($dbc, $zapytanie);
			$a = mysqli_fetch_array($wynik);
	
			$liczba_wpisow = $a[0];
			$liczba_stron = ceil($liczba_wpisow / $na_stronie);
    

			if (isset($_GET['strona'])){

				if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;

				else $strona = $_GET['strona'];

			}

			else $strona = 1;

			$od = $na_stronie * ($strona - 1);
			
			// Pobieranie danych użytkowników z bazy MySQL.
			$query = "SELECT dodal, opinia, ocena, data_dodania, czas_dodania FROM komentarze WHERE id_ksiazki=$ksiazkiID  ORDER BY data_dodania DESC LIMIT $od , $na_stronie";
			$data = mysqli_query($dbc, $query);
				
			
			
			$query1 = "SELECT Avatar, Login, ID_user FROM loguj WHERE Login IS NOT NULL";
			$data1 = mysqli_query($dbc, $query1);
			
			while($row = mysqli_fetch_array($data))
			$rows[]=$row;
			
			while($row1 = mysqli_fetch_array($data1))
			$rows1[]=$row1;
		
			// Przejście w pętli po tablicy danych użytkowników i wyświetlenie ich w kodzie HTML.
			echo '<table>';
			
			if($rows!=0)
			{
			foreach($rows as $row) //&& $row1 = mysqli_fetch_array($data1))
			{
				if (isset($_SESSION['ID_user']))
				{
					foreach($rows1 as $row1)
					{
						if($row['dodal']==$row1['Login'])
						{
										if($_SESSION['ID_user']==$row1['ID_user']) // warunek, który umiejscawia usuń w odpowiednim komenarzu
										{
											$Usun = '<a href="KodPHP/Usun.php?id_ksiazki='.$_GET['ID_ksiazki'].'" id="kom">Usuń</a>';
										}
										else if($_SESSION['ID_user']==6)
										{
											$Usun = '<a href="KodPHP/Usun.php?id_ksiazki='.$_GET['ID_ksiazki'].'" id="kom">Usuń</a>';
										}
										else
										{
											$Usun = '';
										}
								if (is_file(MM_UPLOADPATH . $row1['Avatar']) && filesize(MM_UPLOADPATH . $row1['Avatar']) > 0)
								{
									if($row['ocena']!=0)
									{
										
										echo '<a href="Profil.php?ID_user=' . $row1['ID_user'] . '"><img src="' . MM_UPLOADPATH . $row1['Avatar'] . '" alt="' . $row1['Avatar'] . '" /></a><aside id="kom">&nbsp<p style="color:black; float:right">' . $row['dodal'] . '---[' . $row['data_dodania'] . ' (' . $row['czas_dodania'] . ')]</br></p>
										<p>&nbsp</p>
										<p style="color: black">' . $row['opinia'] . '<hr>Ocena:'.$row['ocena'].'/10<div style="float:right">' .$Usun. '</div></p></aside>';
									}
									else
									{
										
										echo '<a href="Profil.php?ID_user=' . $row1['ID_user'] . '"><img src="' . MM_UPLOADPATH . $row1['Avatar'] . '" alt="' . $row1['Avatar'] . '" /></a><aside id="kom">&nbsp<p style="color:black; float:right">' . $row['dodal'] . '---[' . $row['data_dodania'] . ' (' . $row['czas_dodania'] . ')]</br></p>
										<p>&nbsp</p>
										<p style="color: black">' . $row['opinia'] . '<hr>Ocena: brak<div style="float:right">'.$Usun.'</div></p></aside>';
									}
								}
								else
								{
									if($row['ocena']!=0)
									{
										echo '<a href="Profil.php?ID_user=' . $row1['ID_user'] . '"><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row1['Login'] . '" /></a><aside id="kom">&nbsp<p style="color: black; float:right">' . $row['dodal'] . '---[' . $row['data_dodania'] . ' (' . $row['czas_dodania'] . ')]</br></p>
										<p>&nbsp</p>
										<p style="color: black">' . $row['opinia'] . '<hr>Ocena:'.$row['ocena'].'/10<div style="float:right">'.$Usun.'</div></p></aside>';
									}
									else
									{
										echo '<a href="Profil.php?ID_user=' . $row1['ID_user'] . '"><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row1['Login'] . '" /></a><aside id="kom">&nbsp<p style="color: black; float:right">' . $row['dodal'] . '---[' . $row['data_dodania'] . ' (' . $row['czas_dodania'] . ')]</br></p>
										<p>&nbsp</p>
										<p style="color: black">' . $row['opinia'] . '<hr>Ocena: brak<div style="float:right">'.$Usun.'</div></p></aside>';
									}
								}
						}
					}
				}
			}
			}
			echo '</table>';
			
			if ($liczba_wpisow > $na_stronie)
			{
				$poprzednia = $strona - 1;
				$nastepna = $strona + 1;



					if ($poprzednia > 0)
					{
						echo '<a href="KsiazkaKonkretna.php?ID_ksiazki='.$ksiazkiID.'&strona='.$poprzednia.'"><<</a>';
					}
					
					for($i=1; $i<=$liczba_stron; $i++)
					{
						if(isset($_GET['strona']) && $_GET['strona']==$i)
						{
							echo ' <u>'.$i.'</u> ';
						}
						else
						{
							echo '<a href="KsiazkaKonkretna.php?ID_ksiazki='.$ksiazkiID.'&strona='.$i.'"> '.$i.' </a>';
						}
					}

					if ($nastepna <= $liczba_stron)
					{
						echo '<a href="KsiazkaKonkretna.php?ID_ksiazki='.$ksiazkiID.'&strona='.$nastepna.'">>></a>';
					}
			}
			
			mysqli_close($dbc);
			
?>