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
                
                	<!--<h3>Ostatnio czytane</h3>-->
					<p>
					<?php
							require_once('kodPHP/ListaKsiazek.php');
					
							require_once('kodPHP/KsiazkaDane2.php');
					?>
					</p>
					
                </article>
				
				<fieldset>
				<form enctype="multipart/form-data" method="post">
				<?php
							require_once('kodPHP/Ocena.php');
				
							require_once('kodPHP/OcenaPokaz.php');
				?>
				<legend><p>Oceń:</p></legend>
				</br>
				<p>1 <input type="radio" value="1" name="ocena" <?=$o1?> />
				2 <input type="radio" value="2" name="ocena" <?=$o2?> />
				3 <input type="radio" value="3" name="ocena" <?=$o3?> />
				4 <input type="radio" value="4" name="ocena" <?=$o4?> />
				5 <input type="radio" value="5" name="ocena" <?=$o5?> />
				6 <input type="radio" value="6" name="ocena" <?=$o6?> />
				7 <input type="radio" value="7" name="ocena" <?=$o7?> />
				8 <input type="radio" value="8" name="ocena" <?=$o8?> />
				9 <input type="radio" value="9" name="ocena" <?=$o9?> />
				10 <input type="radio" value="10" name="ocena" <?=$o10?> />
				&nbsp
				|
				&nbsp
				<meter min="1" max="10" value="<?=$zaokraglenie?>" name="skala" style="width:200px"></meter>&nbsp  <?=$zaokraglenie?>/10</p>
				</br>
				<input type="submit" value="Zatwierdź ocenę" name="zatwierdz"/><p style="float:right">Oceniło osób:<?=$ileOsob?>&nbsp </p>
				</br>
				</form>
				</fieldset>
				
                <article id="text">
				</br>
                	
				<?php
				
					require_once('kodPHP/KsiazkaDane3.php');
					
				?>
                
                </article>
                <hr>  
            </section>
			
			<article>
                	<h3>Komentarze:</h3>
                    <p>
						<form enctype="multipart/form-data" method="post">
						<?php
				
							require_once('kodPHP/Komentarze.php');
					
						?>
						<fieldset id="komentarz">
							<textarea id="komentarz" name="opinia" style="resize: none;" rows="10" value="<?php if (!empty($OPINIA)) echo $OPINIA; ?>"></textarea>
							<input type="submit" value="Dodaj" name="dodaj" />
						</fieldset>
						</form>
					</p>
                </article>
				<hr>
				<article>
					<?php
				
							require_once('kodPHP/KomentarzePokaz.php');
					
						?>
				</article>
            
        </div>
        
        <footer>
        	
            <p>
				Copyright &copy;2015 | <a href="Glowna.php">Książnica</a>
			</p>
            
        </footer>
        
    </div>
</body>
</html>
