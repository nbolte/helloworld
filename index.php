<?php
/* -----------------------------------------------
* Author: Natascha Bolte
* Created: 19.11.2016
* Description: Tic Tac Toe Game
--------------------------------------------------*/
require_once('src/class.tictactoe.php');

session_start();

if(!isset($_SESSION['game']['tictactoe'])){
    $_SESSION['game']['tictactoe'] = new Tictactoe();
}
?>
<html>
    <head>
        <title>Tic Tac Toe</title>
        
        <style>
        	.board_row{
        		clear:both;
        	}
        	
        	.board_cell{
        		border:1px solid #000;
        		float:left;
        		padding: 20px;
        	}
        </style>
    </head>
    <body>
    	<h1>Tic Tac Toe - Hello Git-World!!</h1>
        <div id="content">
	        <?php $_SESSION['game']['tictactoe']->playGame(); ?>
        </div>
        
        <script>
			function doAjaxRequest(post_params){
				var xhttp = new XMLHttpRequest();
	    	  	xhttp.onreadystatechange = function(){
	    	    	if(this.readyState == 4 && this.status == 200) {
	    	     		document.getElementById("content").innerHTML = this.responseText;
	    	    	}
	    	  	};
	    	  	xhttp.open("POST", "src/ajax-post.php", true);
	    	  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    	  	xhttp.send(post_params);
			}
        
	        function doMove(player, row, cell){
		        var post_params = 'move=true&player='+player+'&row='+row+'&cell='+cell;
		        doAjaxRequest(post_params);
			}

			function restartGame(){
				var post_params = 'newgame=true';
		        doAjaxRequest(post_params);
			}
        </script>
    </body>
</html>
