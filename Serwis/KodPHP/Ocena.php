<?php
	
	require_once('ZmiennePlikow.php');
	require_once('ZmiennePolaczenia.php');
	error_reporting(E_ALL ^ E_NOTICE);
	
  // Przed przejściem do dalszych operacji należy się upewnić, że użytkownik jest zalogowany.
  if (!isset($_SESSION['ID_user'])) {
    echo '<p>Zaloguj się, aby uzyskać dostęp do strony.</p>';
    exit();
  }
  

  // łączenie się z bazą danych.
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $error = false;
  $OcenaUzytkownikID = $_SESSION['ID_user'];
  $OcenaKsiazkiID = $_GET['ID_ksiazki'];
  
  if (isset($_POST['zatwierdz'])) // po naciśnięciu przycisku "dodaj"
  {
	  
	  $OCENA = mysqli_real_escape_string($dbc, trim($_POST['ocena']));
	  
	  if(empty($OCENA))
	  {
		  $error==true;
	  }
	  
	  // Aktualizowanie komentarza w bazie danych.
    if ($error==false) {
		  
			$query1="SELECT oceny_id_user, oceny_id_ksiazki FROM oceny WHERE oceny_id_user='$OcenaUzytkownikID' AND oceny_id_ksiazki='$OcenaKsiazkiID'";
			$sprawdz=mysqli_query($dbc, $query1);
			$Licz=mysqli_num_rows($sprawdz);
			
			
			if($Licz==0)
			{
				$query2 = "INSERT INTO oceny(oceny_id_user, oceny_id_ksiazki, ocena) VALUES('$OcenaUzytkownikID','$OcenaKsiazkiID','$OCENA')";
				$query3 = "UPDATE komentarze SET ocena='$OCENA' WHERE ID_user='$OcenaUzytkownikID' AND id_ksiazki='$OcenaKsiazkiID'";
				// query3 aktualizuje ocene w komentarzach ponieważ po jego dodaniu jest już tam 0
			}
			else
			{
				$query2 = "UPDATE oceny SET ocena='$OCENA' WHERE oceny_id_user='$OcenaUzytkownikID' AND oceny_id_ksiazki='$OcenaKsiazkiID'";
				$query3 = "UPDATE komentarze SET ocena='$OCENA' WHERE ID_user='$OcenaUzytkownikID' AND id_ksiazki='$OcenaKsiazkiID'";
			}
        
        mysqli_query($dbc, $query2);
		mysqli_query($dbc, $query3);
        

        mysqli_close($dbc);
      }
      else {
        echo '<p>Nie wybrałeś oceny!</p>';
      }
	  
	  header("Location: KsiazkaKonkretna.php?ID_ksiazki=$OcenaKsiazkiID");
	  
    }
   // Koniec obsługi przesyłania formularza.
  

  //mysqli_close($dbc);

	
?>