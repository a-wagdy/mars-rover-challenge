<?php

declare(strict_types=1);

namespace App\Commands;

use App\Rover;
use App\Enums\Direction;
use InvalidArgumentException;

class MoveForwardCommand implements CommandInterface
{
    public function execute(Rover $rover): void
    {
        $newX = $rover->getPosition()->getX();
        $newY = $rover->getPosition()->getY();

        switch ($rover->getDirection()) {
            case Direction::North:
                $newY++;
                break;
            case Direction::East:
                $newX++;
                break;
            case Direction::South:
                $newY--;
                break;
            case Direction::West:
                $newX--;
                break;
        }

        if ($newX < 0 || $newX > $rover->getPlateau()->getX() || $newY < 0 || $newY > $rover->getPlateau()->getY()) {
            throw new InvalidArgumentException("Rover cannot move beyond plateau boundaries");
        }

        $rover->getPosition()->setX($newX);
        $rover->getPosition()->setY($newY);
    }
}