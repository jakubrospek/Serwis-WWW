<?php

		$nazwaBazy='baza2';
		$mysqlHost='localhost';
	
		$pdo = new PDO('mysql:host='.$mysqlHost, 'root', '');
		$pdo->query("USE baza2");
		
		if (isset($_POST['Login']) && ($_POST['Haslo']) && ($_POST['Haslo2']))
		{
			
			if(($_POST['Haslo'])==($_POST['Haslo2']))
			{
			
			$nick=$_POST['Login'];
			$haslo=$_POST['Haslo']; 
			$haslo = sha1($haslo);
			
			
			$sprawdzenie=$pdo->prepare("SELECT * FROM loguj WHERE Login= :nick");
			$sprawdzenie->bindParam(':nick', $nick);
			$sprawdzenie->execute();
			$licz=$sprawdzenie->fetch(PDO::FETCH_NUM);
			
			if($licz==0)
			{
			
				$pdo->query("INSERT INTO loguj(Login, Haslo) VALUES ('$nick', '$haslo')");
				
				header("Location: Zaloguj.php");
			
			}
			else
			{
				echo '<br><p style="color:white">Konto o podanym Loginie już istnieje!</p>';
			}
			}
			else
			{
				echo '<br><p style="color:white">Wprowadzołeś błędne dane. Spróbuj jeszcze raz.</p>';
			}
		}

		/*$wyn=$pdo->query("SELECT * FROM loguj");
		
		echo '<table border="1">
		<tr>
		<th>Login</th>
		</tr>';

		while($kol=$wyn->fetch())
		{
			echo "<tr>";
			echo "<td>".$kol['Login']."</td>";
			echo "</tr>";
		}
*/
?>