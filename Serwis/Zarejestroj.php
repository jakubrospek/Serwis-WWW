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
        
        </div>
        
        <div id="main">
            
            <section id="content">
            
            	<h2>Rejestracja</h2>
            
            	<article>
                
                <form action="Zarejestroj.php" method="post">
					<p style="margin-left:71px">Login: <input type="text" name="Login"/></p></br>
					<p style="margin-left:71px">Hasło: <input type="password" name="Haslo" /></p></br>
					<p>Powtórz Hasło: <input type="password" name="Haslo2"/></p></br>
					<input type="submit" value="Zarejestruj" name="submit"/>
				</form>
                
				<?php
			
				require_once('kodPHP/Rej.php');
			
				?>
				
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
