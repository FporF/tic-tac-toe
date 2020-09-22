<?php


class game {

	var $health;	//int - vida do jogador
	var $over;		//bool - fim de jogo
	var $score;		//int - pontuação
	var $won;		//bool - vencedor

	
	function start()
	{
		$this->score = 0;
		$this->health = 100;
		$this->over = false;
		$this->won = false;
	}
	
	
	function end()
	{
		$this->over = true;
	}
	
	

	function setScore($amount = 0)
	{
		return $this->score += $amount;
	}
	
	
	function setHealth($amount = 0)
	{			
		return ceil($this->health += $amount);
	}
	
	
	function isOver()
	{
		if ($this->won)
			return true;
			
		if ($this->over)
			return true;
			
		if ($this->health < 0) 
			return true;
			
		return false;
	}

} //classe fim de jogo


function debug($object = NULL, $msg = "")
{
	if (isset($object) || isset($msg))
	{
		echo "<pre>";
		
		if (isset($object))
			print_r($object);
			
		if (isset($msg))
			echo "\n\t$msg\n";
		
		echo "\n</pre>";
	}
}


function errorMsg($msg)
{
	return "<div class=\"errorMsg\">$msg</div>";
}


function successMsg($msg)
{
	return "<div class=\"successMsg\">$msg</div>";
}