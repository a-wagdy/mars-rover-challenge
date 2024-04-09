<?php

declare(strict_types=1);

namespace App\Commands;

use App\Enums\Direction;
use App\Rover;

class TurnRightCommand implements CommandInterface
{
    public function execute(Rover $rover): void
    {
        $direction = $rover->getDirection();

        $newDirection = match ($direction) {
            Direction::North => Direction::East,
            Direction::East => Direction::South,
            Direction::South => Direction::West,
            Direction::West => Direction::North,
        };

        $rover->setDirection($newDirection);
    }
}