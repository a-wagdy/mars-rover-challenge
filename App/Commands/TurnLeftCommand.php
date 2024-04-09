<?php

declare(strict_types=1);

namespace App\Commands;

use App\Enums\Direction;
use App\Models\Rover;

class TurnLeftCommand implements CommandInterface
{
    public function execute(Rover $rover): void
    {
        $direction = $rover->getDirection();

         $newDirection = match ($direction) {
            Direction::North => Direction::West,
            Direction::East => Direction::North,
            Direction::South => Direction::East,
            Direction::West => Direction::South,
        };

         $rover->setDirection($newDirection);
    }
}