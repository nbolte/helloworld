<?php
/* -----------------------------------------------
 * Author: Natascha Bolte
 * Created: 19.11.2016
 --------------------------------------------------*/
require_once('class.tictactoe.php');

session_start();

if(!isset($_SESSION['game']['tictactoe'])){
	$_SESSION['game']['tictactoe'] = new Tictactoe();
}

$_SESSION['game']['tictactoe']->playGame($_POST);
?>