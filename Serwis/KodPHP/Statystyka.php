<?php

		// Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
			if (!isset($_SESSION['ID_user'])) {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] .  '/STRONAINT/Zaloguj.php';
			header('Location: ' . $home_url);
		}
		
		
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		$query = "SELECT COUNT(ID_user) FROM loguj";
		$data = mysqli_query($dbc, $query);
		
		$query1 = "SELECT COUNT(ID_ksiazki) FROM ksiazki";
		$data1 = mysqli_query($dbc, $query1);
		
		$z = mysqli_fetch_array($data);
		$k = mysqli_fetch_array($data1);
		
		$zarejestrowani = $z[0];
		$ksiazki = $k[0];
		
		echo "<h3><a href='WszyscyZarejestrowani.php'>Zarejestrowanych</a> użytkowników: $zarejestrowani </h3>";
		
		echo "<h3>Dodanych książek: $ksiazki </h3>";

		mysqli_close($dbc);


?>