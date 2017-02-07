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
                
                	<h3>O mnie:</h3>
					<img src="images/kot.jpg" alt="kurs_il">
					<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti 
					atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia 
					deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. 
					Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, 
					omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus 
					saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, 
					ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. 
					Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, 
					eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
					Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione 
					voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
					sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum 
					exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea 
					voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
					
					
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
