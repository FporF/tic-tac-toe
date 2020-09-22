<?php


class tictactoe extends game
{
	var $player = "X";			//de quem é a vez
	var $board = array();		//tabuleiro??
	var $totalMoves = 0;		//movimentos feitos		

	
	function tictactoe()
	{
	
		game::start();
        $this->newBoard();
	}
	
	
	function newGame()
	{
		//começa o game
		$this->start();
		
		//reinicia o jogador
		$this->player = "X";
		$this->totalMoves = 0;
        $this->newBoard();
	}
    
   
    function newBoard() {
    
        //limpa o tabuleiro
		$this->board = array();
        
        //criação do mesmo
        for ($x = 0; $x <= 2; $x++)
        {
            for ($y = 0; $y <= 2; $y++)
            {
                $this->board[$x][$y] = null;
            }
        }
    }
	
	
	function playGame($gamedata)
	{
		if (!$this->isOver() && isset($gamedata['move'])) {
			$this->move($gamedata);
        }
			
		
		if (isset($gamedata['newgame'])) {
			$this->newGame();
        }
				
		//mostra o jogo
		$this->displayGame();
	}
	
	
	function displayGame()
	{
		
		//quando o jogo acabar
		if (!$this->isOver())
		{
			echo "<div id=\"board\">";
			
			for ($x = 0; $x < 3; $x++)
			{
				for ($y = 0; $y < 3; $y++)
				{
					echo "<div class=\"board_cell\">";
					
					
					if ($this->board[$x][$y])
						echo "<img src=\"images/{$this->board[$x][$y]}.jpg\" alt=\"{$this->board[$x][$y]}\" title=\"{$this->board[$x][$y]}\" />";
					else
					{
						
						echo "<select name=\"{$x}_{$y}\">
								<option value=\"\"></option>
								<option value=\"{$this->player}\">{$this->player}</option>
							</select>";
					}
					
					echo "</div>";
				}
				
				echo "<div class=\"break\"></div>";
			}
			
			echo "
				<p align=\"center\">
					<input type=\"submit\" name=\"move\" value=\"Jogar\" /><br/>
					<b>É a vez do jogador  {$this->player}.</b></p>
			</div>";
		}
		else
		{
			
			//caso tenha empate
			if ($this->isOver() != "Tie")
				echo successMsg("PARABÉNS jogador " . $this->isOver() . ", você venceu o jogo!");
			else if ($this->isOver() == "Tie")
				echo errorMsg("EMPATOU!!, bora tentar novamente?");
				
			session_destroy(); 
				
			echo "<p align=\"center\"><input type=\"submit\" name=\"newgame\" value=\"NOVO JOGO\" /></p>";
		}
	}
	
	
	function move($gamedata)
	{			

		if ($this->isOver())
			return;

		//tira duplicação
		$gamedata = array_unique($gamedata);
		
		foreach ($gamedata as $key => $value)
		{
			if ($value == $this->player)
			{	
				
				$coords = explode("_", $key);
				$this->board[$coords[0]][$coords[1]] = $this->player;

				//troca o turno para o outro jogador
				if ($this->player == "X")
					$this->player = "O";
				else
					$this->player = "X";
					
				$this->totalMoves++;
			}
		}
	
		if ($this->isOver())
			return;
	}
	
	
	function isOver()
	{
		
		//top row
		if ($this->board[0][0] && $this->board[0][0] == $this->board[0][1] && $this->board[0][1] == $this->board[0][2])
			return $this->board[0][0];
			
		//middle row
		if ($this->board[1][0] && $this->board[1][0] == $this->board[1][1] && $this->board[1][1] == $this->board[1][2])
			return $this->board[1][0];
			
		//bottom row
		if ($this->board[2][0] && $this->board[2][0] == $this->board[2][1] && $this->board[2][1] == $this->board[2][2])
			return $this->board[2][0];
			
		//first column
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][0] && $this->board[1][0] == $this->board[2][0])
			return $this->board[0][0];
			
		//second column
		if ($this->board[0][1] && $this->board[0][1] == $this->board[1][1] && $this->board[1][1] == $this->board[2][1])
			return $this->board[0][1];
			
		//third column
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][2] && $this->board[1][2] == $this->board[2][2])
			return $this->board[0][2];
			
		//diagonal 1
		if ($this->board[0][0] && $this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2])
			return $this->board[0][0];
			
		//diagonal 2
		if ($this->board[0][2] && $this->board[0][2] == $this->board[1][1] && $this->board[1][1] == $this->board[2][0])
			return $this->board[0][2];
			
		if ($this->totalMoves >= 9)
			return "Tie";
	}
}