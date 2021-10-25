<?php

namespace Classes;

require 'Classes/Player.php';
require 'Classes/Box.php';

use Classes\Player;


class Game {

    public $player;
    public $computer;
    public $reservedBoxes;
    public $boxes;
    public $remainingBoxes;
    public $allWinConditions;

    public function __construct()
    {
        /**
         * initialize players
         */
        $this->player = new Player('Player');
        $this->computer = new Player('Computer');
        /**
         * Set reservedBoxes to an empty array
         */
        $this->reservedBoxes = [];
        /**
         * intialize remainingBoxes to 9 boxes available to choose
         */
        $this->remainingBoxes = 9;
        /**
         * initialize 9 boxes objects
         */
        $this->boxes = [];
        for ($i=0; $i < 9; $i++) { 
            array_push($this->boxes, new Box);
        }

        /**
         * this all win condtions are possible
         * EX; [0, 1, 2] means if there's X's Or O's that are in reserved boxes array 
         * as the following pattern (indexes)
         * More Explanation using the first array if there is X's in first box, second and third 
         * that means a horizontal arrange
         */
        $this->allWinConditions = [
            /**
             * horizontal Win Conditions
             */
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            /**
             * vertical Win Conditions
             */
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            /**
             * diagonal Win Conditions
             */
            [0, 4, 8],
            [2, 4, 6],
        ];
    }

    public function update($box_index, $sign)
    {

        /**
         * Update the sign of choosen box
         */
        $this->updateBox($box_index, $sign);

        /**
         * Now we need to check if the player win the game
         */
        if ($this->checkIfPlayerOrComputerWinsTheGame('X') == true) {
            /**
             * Update the status of player
             */
            $this->player->setStatus(1);
            $name = $this->player->getName();
            header('Location: notification.php?msg='.$name.' Win');
            exit;
        }
        
        /**
         * Computer's Turn
         * choose randomly between 0 to 8 but avoid any reserved box
         */
        do {   
            $random = rand(0,8);
        
        } while(in_array($random, $this->reservedBoxes));


        /**
         * Update the sign of chosen box by the computer
         */
        $this->updateBox($random, 'O');

        /**
         * Now we need to check if the player win the game
         */
        if ($this->checkIfPlayerOrComputerWinsTheGame('O') == true) {
            /**
             * Update the status of player
             */
            $this->computer->setStatus(1);
            $name = $this->computer->getName();
            header('Location: notification.php?msg='.$name.' Win');
            exit;
        }

        /**
         * Check if the remaining boxes is one 
         * that's mean a darw
         */
        if ($this->remainingBoxes == 1) {
            header('Location: notification.php?msg=Draw');
            exit;
        }
    }

    /**
     * update the sign of chosen box
     * save it's index in reserved boxes
     * then decrease the number of remaining boxes
     */
    public function updateBox($boxIndex, $sign)
    {
        $this->boxes[$boxIndex]->updateSign($sign);
        array_push($this->reservedBoxes, $boxIndex);
        $this->remainingBoxes--;
    }

    /**
     * the sign of player is X and computer is O
     * using the sign we'll check if the given sign is stored in the reserved boxes as the win patterns
     */
    public function checkIfPlayerOrComputerWinsTheGame($sign)
    {
        /**
         * Loop over win all win conditions and check if there's a matching
         */
        foreach ($this->allWinConditions as $key => $winCondition) {
            if ($this->boxes[$winCondition[0]]->getSign() == $sign && 
                $this->boxes[$winCondition[1]]->getSign() == $sign &&
                $this->boxes[$winCondition[2]]->getSign() == $sign
            ) {
                return true;
            }
        }

        return false;
    }


}