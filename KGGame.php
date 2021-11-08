<?php

class Pig
{

    public $total = 0;

    /**
     * constructor$
     */
    public function _construct() {}

    public function throwDie($min, $max) {
        $score = mt_rand($min, $max);

        return $score;
    }

    /**
     * @throws Exception
     */
    public function main() {
        $result = $this->startGame();

        if($result) {
            printf("New Game\n");
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
            $this->total = 0;
        } else {
            $this->total = $this->total + $score1 + $score2;
        }

	printf("Throw: %d %d\nScore: %d\n", $score1, $score2, $this->total);
	if ($this->total === 0) {
	    printf("\nZero - you lost: %d %d\nScore: %d\n\n", $score1, $score2, $this->total);
	    return false;
	}

        echo "Play. Type 'y' to continue, or any other key to stop.";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);

        if(trim($line) != 'y'){
            echo "Stopped\n";
        } else {
	    $success = $this->startGame();
	    if ($this->total === 0) { 
	        return false;
	    } else {
                return true;
	    }
        }

        if ($this->total === 0) {
          return false;
        } else {
          return true;
        }
    }
}


$players = 0;
printf("%s\n%s\n", 'DSmith - Kurt Geiger Pig Game', 'Enter number of players 1 to 4: ');
$handle = fopen ("php://stdin","r");
$line = fgets($handle);

if ($x = in_array(trim($line), [1,2,3,4])) {
    $players = (int) trim($line);
} else {
    printf("Please choose 1, 2, 3 or 4 players\n");
    exit($x);
}

if ($players > 1) {
    printf("Players %d\n", $players);
} elseif ($players === 1) {
    printf("Player %d\n", $players);
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
    $pigs[$i] = new Pig();
}

foreach ($pigs as $key => $pig) {
    printf("Player %d\n", $key);
    echo "Throw or stop?  Type 'y' to continue: ";
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
    if(trim($line) != 'y'){
        printf("Stopping at Score: %d\n");
    } else {
        $pig->main();
    }
}

$max = ['player' => 0, 'score' => 0];

foreach ($pigs as $key => $pig) {
    $max['player'] = $pig->total > $max['score'] ? $key : $max['player'];
    $max['score'] = $pig->total > $max['score'] ? $pig->total : $max['score'];
    printf("Player %d scored: %d\n", $key, $pig->total);
}

if ($max['score'] === 0) {
    echo "No winner - all zeroes\nBetter luck next time!\n";
} else {
    echo "Player " . $max['player'] . " won with " . $max['score'] . " points\n";
}

