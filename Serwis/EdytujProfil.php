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
					

				<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<?php
					require_once('kodPHP/EdytujProfilDane.php');
				?>
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MM_MAXFILESIZE; ?>" />
						<fieldset style="width:505px">
							<legend>Dane osobowe</legend>
							<table>
							<tr><td><label for="Imie">Imię:</label>
							<input type="text" id="profil" name="Imie" value="<?php if (!empty($IMIE)) echo $IMIE; ?>"/></td></tr>
							<tr><td><label for="Nazwisko">Nazwisko:</label>
							<input type="text" id="profil" name="Nazwisko" value="<?php if (!empty($NAZWISKO)) echo $NAZWISKO; ?>" /></td></tr>
							<tr><td><label for="Plec">Płeć:</label>
							<select style="margin-left:88px" name="Plec">
								<option value="M" <?php if (!empty($PLEC) && $PLEC == 'M') echo 'selected = "selected"'; ?>>Mężczyzna</option>
								<option value="K" <?php if (!empty($PLEC) && $PLEC == 'K') echo 'selected = "selected"'; ?>>Kobieta</option>
							</select></td></tr><br />
							<tr><td><label for="DataUrodz">Data urodzenia:</label>
							<input type="text" id="profil" name="DataUrodz" value="<?php if (!empty($DATA_URODZ)) echo $DATA_URODZ; else echo 'YYYY-MM-DD'; ?>" /></td></tr>
							<tr><td><label for="Miasto">Miejscowość:</label>
							<input type="text" id="profil" name="Miasto" value="<?php if (!empty($MIASTO)) echo $MIASTO; ?>" /></td></tr>
							<tr><td><label for="Wojewodztwo">Województwo:</label>
							<input type="text" id="profil" name="Wojewodztwo" value="<?php if (!empty($WOJEWODZTWO)) echo $WOJEWODZTWO; ?>" /></td></tr>
							<tr><td><label for="Email">Adres e-mail:</label>
							<input type="text" id="profil" name="Email" value="<?php if (!empty($EMAIL)) echo $EMAIL; ?>" /></td></tr>
							<input type="hidden" id="profil" name="stary_obraz" value="<?php if (!empty($stary_obraz)) echo $stary_obraz; ?>" /></td></tr>
							<tr><td><label for="nowy_obraz">Zdjęcie:</label>
							<input type="file" id="profil" name="nowy_obraz" /></td></tr>
							<?php if (!empty($stary_obraz))
							{
								echo '<img src="' . MM_UPLOADPATH . $stary_obraz . '" alt="Zdjęcie z profilu" />';
							}
							?>
							</table>
						</fieldset>
					<input type="submit" value="Zapisz profil" name="submit" />
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