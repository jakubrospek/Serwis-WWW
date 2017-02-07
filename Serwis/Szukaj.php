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
				<hr/>
            	<article id="text">
                
                	<h3>Wpisz autora lub tytuł książki:</h3>
					
					<form enctype="multipart/form-data" method="post">
					<input type="search" name="phrase" value="<?php if (!empty($SZUKAJ)) echo $SZUKAJ; ?>" style="width: 300px" />
					<input type="submit" value="Szukaj" name="submit"/>
					<br/>
					<hr/>
					<?php
			
						require_once('kodPHP/Wyszukiwarka.php');
			
					?>
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