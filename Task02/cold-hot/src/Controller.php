<?php 
	namespace OlegParamonov\coldhot\Controller;
    use function OlegParamonov\coldhot\View\showGame;
    
    function startGame() {
        echo "Game started".PHP_EOL;
        showGame();
    }
?>