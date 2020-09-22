<?php

require_once('classes/class.game.php');
require_once('classes/class.tictactoe.php');

//armazena as informações enquanto atualiza
session_start();

//mesmo caso não comece, irá inciar sozinho.
if (!isset($_SESSION['game']['tictactoe']))
	$_SESSION['game']['tictactoe'] = new tictactoe();

?>
<html>
	<head>
		<title>JOGO DA VELHA</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<div id="content">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h2>BORA JOGAR?<br>Jogo da velha simplificado</h2>
		
		<?php
			$_SESSION['game']['tictactoe']->playGame($_POST);
		?>
		</form>
		</div>
	</body>
</html>