<?php

			// Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
			if (!isset($_SESSION['ID_user'])) {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
			header('Location: ' . $home_url);
			}
			
			$IDuser = $_SESSION['ID_user'];
			
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			//$query1 = "SELECT * FROM(SELECT ID_oceny, ID_znajomy, ID_ksiazki, Okladka, ocena, opinia, dodal FROM ksiazki INNER JOIN oceny INNER JOIN znajomi INNER JOIN komentarze ON ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND ksiazki.ID_ksiazki = komentarze.id_ksiazki AND znajomi.ID_znajomy = komentarze.id_user AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy LIMIT 3";
			//$query1 = "SELECT * FROM(SELECT ID_oceny, ID_znajomy, ID_ksiazki, Okladka, ocena FROM ksiazki INNER JOIN oceny INNER JOIN znajomi ON ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy LIMIT 3";
			$query1 = "SELECT * FROM(SELECT oceny.ID_oceny, znajomi.ID_znajomy, ksiazki.ID_ksiazki, ksiazki.Okladka, oceny.ocena, komentarze.dodal, komentarze.opinia FROM ksiazki INNER JOIN oceny INNER JOIN znajomi INNER JOIN komentarze ON ksiazki.ID_ksiazki =  oceny.oceny_id_ksiazki AND znajomi.ID_zalogowany = '".$_SESSION['ID_user']."' AND oceny_id_user = znajomi.ID_znajomy WHERE znajomi.ID_znajomy = komentarze.ID_user AND ksiazki.ID_ksiazki = komentarze.id_ksiazki GROUP BY ID_oceny DESC) AS tab GROUP BY ID_znajomy LIMIT 3";
			$data1 = mysqli_query($dbc, $query1);
			$spr = 0;
			
			while($row1 = mysqli_fetch_array($data1))
			{
				$spr+=1;
				$rows1[]=$row1;
			}
		
		if($spr!=0)
		{
			echo '<h3><a href="OstOcenione.php?ID_user='.$_SESSION['ID_user'].'" style="color:white">Ostatnio ocenione</a> i <a href="OstSkomentowane.php?ID_user='.$_SESSION['ID_user'].'" style="color:white">skomentowane</a> przez znajomych:</h3>';
			echo '<table id="GlOstOcenione">';
			foreach($rows1 as $row1)
			{
				
				if (isset($_SESSION['ID_user']))
				{
					echo '<div style="float:left"><a href="KsiazkaKonkretna.php?ID_ksiazki=' . $row1['ID_ksiazki'] . '"><img src="' . MM2_UPLOADPATH . $row1['Okladka'] .
						'" alt="Okładka" /></a><div style="clear:both"><meter style="width:140px" min="1" max="10" value='. $row1['ocena'] .' name="skala" style="width:200px"></meter>&nbsp  '. $row1['ocena'] .'/10</div><p>&nbsp</p>
						<div style="clear:both; width:197px"><a href="Profil.php?ID_user='.$row1['ID_znajomy'].'" style="color:white">'.$row1['dodal'].'</a> napisał:<p>&nbsp</p><p><textarea style="width:197px" disabled="disabled" rows=10>'.$row1['opinia'].'</textarea></p></div></div>';
				}
			}
			echo '</table>';
			
		}
		else
		{
			echo '
					
					<h3>Co Admin lubi najbardziej...</h3>
					<a href="KsiazkaKonkretna.php?ID_ksiazki=19"><img src="images/WP.jpg"></a>
                    <p>Jeżeli postawiono by mnie kiedyś przed wyborem najlepszej książki wszech czasów, bez zastanowienia wskazałbym na dzieło Tolkiena.
					"Władca Pierścieni" to piękna, urzekająca opowieść o braterstwie, przyjaźni i poświeceniu. 
					Mistrz Tolkien swoimi długimi opisami miejsc pozwala niemalże ujrzeć na własne oczy krainę Śródziemia. 
					Wędrujemy przez sielskie Shire, piękne Rivendell, mroczną Morię, cudną Lorien. Docieramy do Rohanu i Gondoru by stoczyć walkę z Sauronem. 
					Razem z Frodo i Samem dochodzimy do straszliwego, ciemnego i odrażającego Mordoru chcąc ostatecznie zgładzić Władcy Ciemności. 
					Razem z bohaterami odczuwamy strach i odwagę, przygnębienie i nadzieję, szczęście i smutek. Razem z nimi walczymy o lepsze jutro. 
					Po prostu coś pięknego. Tego arcydzieła nie opiszą żadne słowa, żadne opinie. Moja jest tylko marnym opisem tego, co można tu doświadczyć. 
					A doświadczyć wręcz trzeba. Ja osobiście czytałem "Władcę Pierścieni" więcej razy niż jestem w stanie spamiętać i za każdym razem moje uczucia są takie same. 
					Po prostu arcymistrzostwo. W skali od jeden do 10 dałbym jedenaście, ale niestety nie ma takiej możliwości. 
					Muszę więc zadowolić się "dychą". Polecam każdemu, kto jeszcze nie zgłębił historii Wojny o Pierścień.
					</p>
					</br>
			
			';
		}
			
			mysqli_close($dbc);

?>