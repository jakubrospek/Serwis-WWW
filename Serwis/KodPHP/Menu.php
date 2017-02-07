<?php

			require_once('ZmiennePolaczenia.php');
			require_once('ZmiennePlikow.php');

			// Generowanie menu nawigacyjnego.
			if (isset($_SESSION['Login']))
			{
				if($_SESSION['Login']=='admin')
				{
	  
					echo '<nav id="menu">
            
					<ul>
						<li><a href="Glowna.php">Strona główna</a></li>
						<li><a href="Profil.php">Profil</a></li>
						<li><a href="Obserwowani.php">Obserwowani</a></li>
						<li><a href="MP.php">Moja półka</a></li>
						<li><a href="Szukaj.php">Szukaj</a></li>
						<li><a href="Wyloguj.php">Wyloguj</a></li>
						<li></li>
						<li><a href="Dodaj.php">Dodaj książkę</a></li>
					</ul>
					</nav>';
				}
				else
				{
	  
					echo '<nav id="menu">
            
					<ul>
						<li><a href="Glowna.php">Strona główna</a></li>
						<li><a href="Profil.php">Profil</a></li>
						<li><a href="Obserwowani.php">Obserwowani</a></li>
						<li><a href="MP.php">Moja półka</a></li>
						<li><a href="Szukaj.php">Szukaj</a></li>
						<li><a href="Wyloguj.php">Wyloguj</a></li>
					</ul>
					</nav>';
				}
	 
			}
			else
			{
				echo '<nav id="menu">
            
					<ul>
						<li><a href="Zaloguj.php">Zaloguj</a></li>
						<li><a href="Zarejestroj.php">Zarejestruj</a></li>
					</ul>
					</nav>';
			}

?>