<?php
/* -----------------------------------------------
* Author: Natascha Bolte
* Created: 19.11.2016
--------------------------------------------------*/

class Tictactoe {
	private $player = "X";
	private $board = array();
	private $totalMoves = 0;

	public function __construct(){
        $this->newBoard();
	}
	
	private function restartGame(){
		$this->player = "X";
		$this->totalMoves = 0;
        $this->newBoard();
	}
    
    private function newBoard() {
		$this->board = array();

        for($row = 0; $row <= 2; $row++){
            for($cell = 0; $cell <= 2; $cell++){
                $this->board[$row][$cell] = null;
            }
        }
    }
	
	public function playGame($gameAction = array()){
		if(!$this->checkIfGameIsOver() && isset($gameAction['move'])) {
			$this->move($gameAction);
        }
			
		if(isset($gameAction['newgame'])) {
			$this->restartGame();
        }
				
        $this->displayGame();
	}
	
	private function displayGame(){
		echo '<h3>Spieler '.$this->player.' ist an der Reihe.</h3>';
		echo '<div id="board">';
		
		if(!$this->checkIfGameIsOver()){
			
			for($row = 0; $row < 3; $row++){
				echo '<div class="board_row">';
		
				for($cell = 0; $cell < 3; $cell++){
					echo '<div class="board_cell">';
					
					if(!empty($this->board[$row][$cell])){
						echo '<span>'.$this->board[$row][$cell].'</span>';
					} else {
						echo '<a href="#" onclick="doMove(\''.$this->player.'\', '.$row.', '.$cell.');return false;">'.$this->player.'</a>';
					}
					
					echo '</div>';
				}
				
				echo '</div>';
			}
		} else {
			if($this->checkIfGameIsOver() !== "Tie"){
				echo '<p>Herzlichen Glückwunsch '.$this->checkIfGameIsOver().', du hast gewonnen.</p>';
			} else if($this->checkIfGameIsOver() === "Tie"){
				echo '<p>Unentschieden</p>';
			}	
			echo '<a href="" onclick="restartGame(); return false;">Neues Spiel</a>';
		}
		echo '</div>';
	}
	
	private function move($gameAction){			

		if($gameAction['player'] === $this->player){	
			$this->board[$gameAction['row']][$gameAction['cell']] = $this->player;
				
			$this->player = ($this->player === 'X') ? 'O':'X';	
			$this->totalMoves++;
		}
	}
	
	private function checkIfGameIsOver(){
        for($i = 0; $i < 3; $i++){
            if($this->checkRow($i)){
			     return $this->board[$i][0];
            }
        }
		
        for($i = 0; $i < 3; $i++){
            if($this->checkColumn($i)){
                return $this->board[0][$i];
            }
        }
			
		//Diagonale links oben - rechts unten
		if(!empty($this->board[0][0]) && $this->board[0][0] === $this->board[1][1] && $this->board[1][1] === $this->board[2][2]){
			return $this->board[0][0];
        }
			
		//Diagonale links unten - rechte oben
		if(!empty($this->board[0][2]) && $this->board[0][2] === $this->board[1][1] && $this->board[1][1] === $this->board[2][0]){
			return $this->board[0][2];
        }
			
		if($this->totalMoves >= 9){
			return "Tie";
        }
	}
    
    
    private function checkRow($row_index){
        return (!empty($this->board[$row_index][0]) && $this->board[$row_index][0] === $this->board[$row_index][1] && $this->board[$row_index][1] === $this->board[$row_index][2]);
    }
    
    private function checkColumn($column_index){
        return (!empty($this->board[0][$column_index]) && $this->board[0][$column_index] === $this->board[1][$column_index] && $this->board[1][$column_index] === $this->board[2][$column_index]);
    }
}