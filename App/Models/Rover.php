<?php

declare(strict_types=1);

namespace App\Models;

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

    public function setPosition(int $x, int $y): void
    {
        $this->position->setX($x);
        $this->position->setY($y);
    }
}