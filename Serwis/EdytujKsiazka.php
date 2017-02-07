<?php

	require_once('kodPHP/Sesja.php');
	
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
    <title>Książnica</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
	<div id="wrapper">
    	
        <header>
        	<img id="logo" src="images/logo.jpg">
        </header>
        
        <hr/>
        
        <div id="sidebar">
        
        	<?php
			
				require_once('kodPHP/Menu.php');
			
			?>
            
            <aside>
            
            	<p>"Ten, kto czyta książki, przeżywa tysiąc żyć zanim umrze. Ten, kto nie czyta, żyje tylko raz."</p>
					<h5>George R.R. Martin</h5></p>
            
            </aside>
            
            <article id="text">
            
                	<p>Ostatnio dołączyli:</p>
					</br>
					<?php
							require_once('kodPHP/ListaKont.php');
					?>
            
            </article>
        
        </div>
        
        <div id="main">
            
            <section id="content">
            
            	<h2>Książnica - moja literacka przystań</h2>
				<hr>
            	<article id="text">
                
                	<h3>Profil</h3>
					<?php
					require_once('kodPHP/EdytujKsiazkaDane.php');
				?>

				<form enctype="multipart/form-data" method="post" action="<?php echo  $_SERVER['PHP_SELF'].'?ID_ksiazki='.$_GET['ID_ksiazki'].''; ?>">
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
						<fieldset>
						<?php if (!empty($stary_obraz))
							{
								echo '<img src="' . MM_UPLOADPATH . $stary_obraz . '"" style="float:right" />';
							}
							?>
							<label id="dodaj" for="Autor">Autor:</label>
							<input id="dodaj" type="text" name="Autor" value="<?php if (!empty($AUTOR)) echo $AUTOR; ?>" /><br />
							<label id="dodaj" for="Tytul">Tytul:</label>
							<input id="dodaj" type="text" name="Tytul" value="<?php if (!empty($TYTUL)) echo $TYTUL; ?>" /><br />
							<label id="dodaj" for="Cykl">Cykl:</label>
							<input id="dodaj" type="text" name="Cykl" value="<?php if (!empty($CYKL)) echo $CYKL; ?>" /><br />
							<label id="dodaj" for="Tom">Tom:</label>
							<input id="dodaj" type="text" name="Tom" value="<?php if (!empty($TOM)) echo $TOM; ?>" /><br />
							<label id="dodaj" for="Tlumaczenie">Tlumaczenie:</label>
							<input id="dodaj" type="text" name="Tlumaczenie" value="<?php if (!empty($TLUMACZENIE)) echo $TLUMACZENIE; ?>" /><br />
							<label id="dodaj" for="TytulOrg">Tytul oryginału:</label>
							<input id="dodaj" type="text" name="TytulOrg" value="<?php if (!empty($TYTUL_ORG)) echo $TYTUL_ORG; ?>" /><br />
							<label id="dodaj" for="ISBN">ISBN:</label>
							<input id="dodaj" type="text" name="ISBN" value="<?php if (!empty($isbn)) echo $isbn; ?>" /><br />
							<label id="dodaj" for="LStron">Liczba stron:</label>
							<input id="dodaj" type="text" name="LStron" value="<?php if (!empty($LICZBA_STRON)) echo $LICZBA_STRON; ?>" /><br />
							<label id="dodaj" for="Kategoria">Kategoria:</label>
							<input id="dodaj" type="text" name="Kategoria" value="<?php if (!empty($KATEGORIA)) echo $KATEGORIA; ?>" /><br />
							<label id="dodaj" for="Jezyk">Język:</label>
							<input id="dodaj" type="text" name="Jezyk" value="<?php if (!empty($JEZYK)) echo $JEZYK; ?>" /><br />
							<input id="dodaj" type="hidden" name="stary_obraz" value="<?php if (!empty($stary_obraz)) echo $stary_obraz; ?>" />
							<label id="dodaj" for="nowy_obraz">Okładka:</label>
							<input id="dodaj" type="file" name="nowy_obraz" />
							<textarea id="dodaj" type="text" name="Opis" style="resize: none;" rows="20" cols="80" ><?php if (!empty($OPIS)) echo $OPIS; ?></textarea>
							</fieldset>
					<input type="submit" value="Dodaj" name="submit" />
					</form>
					<p></p>
					
					
                </article>
            
            </section>
            
        </div>
        
        <footer>
        	
            <p>
				Copyright &copy;2015 | <a href="Glowna.php">Książnica</a>
			</p>
            
        </footer>
        
    </div>
</body>
</html>