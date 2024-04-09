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

        match ($rover->getDirection()) {
            Direction::North => $newY++,
            Direction::East => $newX++,
            Direction::South => $newY--,
            Direction::West => $newX--,
        };

        if ($newX < 0 || $newX > $rover->getPlateau()->getX() || $newY < 0 || $newY > $rover->getPlateau()->getY()) {
            throw new InvalidArgumentException("Rover cannot move beyond plateau boundaries");
        }

        $rover->setPosition($newX, $newY);
    }
}