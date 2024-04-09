<?php

declare(strict_types=1);

namespace App;

use App\Commands\CommandInterface;
use App\Enums\Command;
use App\Enums\Direction;

class Rover
{
    private Plateau $plateau;
    private Position $position;
    private Direction $direction;

    public function __construct(Plateau $plateau, Position $position, Direction $direction)
    {
        $this->plateau = $plateau;
        $this->position = $position;
        $this->direction = $direction;
    }

    public function executeCommands(array $commands): void
    {
        foreach ($commands as $command) {
            $command = Command::mapCommand($command);
            $command->execute($this);
        }
    }

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    public function setDirection(Direction $direction): void
    {
        $this->direction = $direction;
    }

    public function getPlateau(): Plateau
    {
        return $this->plateau;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getNewPosition(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->direction->value}";
    }

//    public function turnLeft(): void
//    {
//        $this->direction = match ($this->direction) {
//            Direction::North => Direction::West,
//            Direction::East => Direction::North,
//            Direction::South => Direction::East,
//            Direction::West => Direction::South,
//        };
//    }

//    public function turnRight(): void
//    {
//        $this->direction = match ($this->direction) {
//            Direction::North => Direction::East,
//            Direction::East => Direction::South,
//            Direction::South => Direction::West,
//            Direction::West => Direction::North,
//        };
//    }

//    public function moveForward(): void
//    {
//        $newX = $this->position->getX();
//        $newY = $this->position->getY();
//
//        switch ($this->direction) {
//            case Direction::North:
//                $newY++;
//                break;
//            case Direction::East:
//                $newX++;
//                break;
//            case Direction::South:
//                $newY--;
//                break;
//            case Direction::West:
//                $newX--;
//                break;
//        }
//
//        if ($newX < 0 || $newX > $this->plateauWidth || $newY < 0 || $newY > $this->plateauHeight) {
//            throw new InvalidArgumentException("Rover cannot move beyond plateau boundaries");
//        }
//
//        $this->position->setX($newX);
//        $this->position->setY($newY);
//    }
}