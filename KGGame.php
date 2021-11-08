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
     * constructor$
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
            printf("Continuing... \n");
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
        }

	    printf("Throw: [%d] [%d]\nScore: %d\n", $score1, $score2, $this->getRoundTotal());
	    if ($this->getRoundTotal() === 0) {
	        printf("\nZero - you lost: [%d] [%d]\nScore: %d\n\n", $score1, $score2, $this->getRoundTotal());
	        return false;
    	}

        echo "Play. Type 'y' to continue, or any other key to stop.";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);

        if(trim($line) != 'y'){
            echo "Stopped\n";
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
}

$players = 0;
printf("%s\n%s\n", 'Kurt Geiger Pig Game by D. Smith, 2021-Nov-08', 'Enter number of players 1 to 4: ');
$handle = fopen ("php://stdin","r");
$line = fgets($handle);

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

foreach ($pigs as $pig) {
    printf("Player %d\n", $pig->getPlayerId());
    echo "Throw or stop?  Type 'y' to continue: ";
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    if(trim($line) != 'y'){
        printf("Stopping at: %d\n");
    } else {
        $pig->play();
    }
}

$max = ['player' => 0, 'score' => 0];

foreach ($pigs as $pig) {
    $max['player'] = $pig->getRoundTotal() > $max['score'] ? $pig->getPlayerId() : $max['player'];
    $max['score'] = $pig->getRoundTotal() > $max['score'] ? $pig->getRoundTotal() : $max['score'];
    printf("Player %d scored: %d\n", $pig->getPlayerId(), $pig->getRoundTotal());
    printf("Player %d game total: %d\n", $pig->getPlayerId(), $pig->getGameTotal());
}

if ($max['score'] === 0) {
    echo "No winner - all zeroes\nBetter luck next time!\n";
} else {
    echo "Player " . $max['player'] . " won with " . $max['score'] . " points\n";
}
