<?php

declare(strict_types=1);

namespace App;

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

    public function executeCommands(array $commands): void
    {
        foreach ($commands as $command) {
            $command = Command::mapCommand($command);
            $command->execute($this);
        }
    }

    public function getNewPosition(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->direction->value}";
    }
}