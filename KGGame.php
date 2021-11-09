<?php

class Pig
{
    private int $roundTotal = 0;

    private int $gameTotal = 0;

    private int $playerId = 0;

    public function setRoundTotal(int $roundTotal) {
        $this->roundTotal = $roundTotal;
    }

    public function getRoundTotal() {
        return $this->roundTotal;
    }

    public function setGameTotal(int $gameTotal) {
        $this->gameTotal = $gameTotal;
    }

    public function getGameTotal() {
        return $this->gameTotal;
    }

    public function setPlayerId(int $playerId) {
        $this->playerId = $playerId;
    }

    public function getPlayerId() {
        return $this->playerId;
    }

    /**
     * constructor
     */
    public function __construct(int $playerId) {
        $this->setPlayerId($playerId);
    }

    protected function throwDie($min, $max) {
        $score = mt_rand($min, $max);

        return $score;
    }

    /**
     * @throws Exception
     */
    public function play() {
        $result = $this->startGame();

        if($result) {
            printf(" \n");
        } else {
            printf("Next player... \n");
        }
    }

    /**
     *
     */
    protected function startGame() {
        // init vars
        $score1 = $this->throwDie(1,6);
        $score2 = $this->throwDie(1,6);

        if ($score1 === 1 || $score2 === 1) {
            $this->setRoundTotal(0);
            if ($score1 === 1 && $score2 === 1) {
                $this->setGameTotal(0);
            } 
        } else {
            $this->setRoundTotal($this->getRoundTotal() + $score1 + $score2);
            $this->setGameTotal($this->getGameTotal() + $score1 + $score2);
            /* IF GAME TOTAL REACHES 100 GAME IS WON */
            if ($this->getGameTotal() > 99) {
                $this->gameOver($this->getPlayerId(), $this->getRoundTotal(), $this->getGameTotal());
            }
        }

        printf("[%d] [%d]\nScore: %d GameScore: %d\n", $score1, $score2, $this->getRoundTotal(), $this->getGameTotal());
        if ($this->getRoundTotal() === 0) {
            printf("\nZero - you lost: [%d] [%d]\nScore: %d GameScore: %d\n\n", $score1, $score2, $this->getRoundTotal(), $this->getGameTotal());
            return false;
        }

        echo "Play. Type 'y' to continue, or any other key to stop.";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);

        if(trim($line) != 'y'){
            echo "End of Player " .$this->getPlayerId() . "'s turn\n";
        } else {
            $success = $this->startGame();
            if ($this->getRoundTotal() === 0) { 
                return false;
            } else {
                return true;
            }
        }

        if ($this->getRoundTotal() === 0) {
            return false;
        } else {
            return true;
        }
    }

    protected function gameOver($id) {
        $message = sprintf("Game over\n\nThe winner is \n\n***Player %d***\n\n Yaaaay!!! \n\nRound total: [%d]\nGame total[%d]\n", $id, $this->getRoundTotal(), $this->getGameTotal());
        die($message);
    }
}


/* Start the game */
$players = 0;
printf("%s\n%s\n", 'Kurt Geiger Pig Game by D. Smith, 2021-Nov-08', 'Enter number of players 1 to 4: ');
$handle = fopen ("php://stdin","r");
$line = fgets($handle);

/* Ask how many players are playing - between 1 and 4 */
if ($x = in_array(trim($line), [1,2,3,4])) {
    $players = (int) trim($line);
} else {
    printf("Please choose 1, 2, 3 or 4 players\n");
    exit($x);
}

if ($players > 1) {
    printf("%d players\n", $players);
} elseif ($players === 1) {
    printf("%d player\n", $players);
}

/* Start playing */
echo "Ready to play... type 'y' to continue: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);

if(trim($line) != 'y'){
    echo "Goodbye\n";
    exit;
}

fclose($handle);
echo "\n"; 
echo "Starting...\n";

$pigs = [];

for ($i = 1; $i < $players + 1; $i++) {
    $pigs[$i] = new Pig($i);
}

/* Here we need to set up a game for the number of Players, and continue  */
/* it until everyone has either zeroed or someone has reached 100         */

$gameNotWon = true;

while($gameNotWon) {
    /* Each player takes a turn */
    foreach ($pigs as $pig) {
        if ($pig->getGameTotal() > 99) {
            $gameNotWon = false;
        printf("Game has been won by player %d\n", $pig->getPlayerId());
        }

        printf("\n--------\nPlayer %d\n--------\n", $pig->getPlayerId());
        echo "Throw or stop?  Type 'y' to continue: ";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) != 'y'){
            printf("Stopping at: round: %d game: %d\n", $pig->getRoundTotal(), $pig->getGameTotal());
        } else {
            $pig->play();
        }
    }
}