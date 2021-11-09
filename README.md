==================================================================

Duncan Smith - Kurt Geiger Sofware Engineering Test
---------------------------------------------------

How to Play:
------------

To play the game run on a computer with PHP5 or later installed.

Make sure the file KGGame.php is set to executable by all:

$ chmod 755 KGGame.php

Run the program:

$ php KGGame.php

Follow the instructions on the command line.

Enjoy!

==================================================================

Software Engineering Task
Overview
This task is predominantly an exercise where we expect you to showcase your ability to create modular and re-usable code. Where you would normally want to produce the least amount of code to achieve a given task, this is a special case where we are looking to see the range of your abilities.

Therefore:
Feel free to implement your solution in an elaborate fashion. Showcase your skills in object-orientation and design patterns, for example.
You can complete the task with or without using a framework and using a language of your choice.
Include your tests. We would like to see your development approach, whether you have built this in a test-driven way, or not.
Feel free to polish anything you create with additional frontend styling – but this is not essential.
The task should take you about 2-4 hours, but do not worry if you go over this. Your implementation and the reasoning behind it will then form the basis of discussion with some of our engineers later in the hiring process.

The Task
We require you to build the game of Pig (it’s a dice game) rules can be found below or explained here in this handy video: https://www.youtube.com/watch?v=gVIvB-ahI4A

The Rules
We’re expecting the 2 dice version of the game.

The game requires two or more players.

It requires two 6 sided dice.

Each player in turn roles the dice counting up the numeric scores until either:

a. The Player decides to stop rolling - in which case the user notes down the total they have accumulated from that turn and adds that to their overall score.

b. The Player rolls a 1. – They lose any points they accumulated for that round.

c. The Player rolls two 1’s (snake eyes) and then they lose their points from that round and any points they’ve accumulated from previous rounds. E.g. their score goes back to 0.

When any of the point 2 scenarios have happened play passes to the next player and the cycle repeats.

A winner is the first person to reach 100 points.

Submission
Hopefully with you reading this, we would've already provided access to this repo to your github account to read the instructions!

Please create a github repo under your account, push your commits to your repo as well as any additional instructions you want to supply to get the game running.

Then look to provide your repo link to the HR/Recruitment contact when ready for our engineers to review, who will be asking you questions about this task and also potentially discuss expanding/refactoring your code during the interview.

Good luck and enjoy!
