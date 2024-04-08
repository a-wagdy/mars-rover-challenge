<?php

declare(strict_types=1);

class Rover
{
    private Position $position;
    private Direction $direction;
    private int $plateauWidth;
    private int $plateauHeight;

    public function __construct(Position $position, Direction $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function move(string $command): void
    {
        match ($command) {
            'L' => $this->direction = $this->turnLeft(),
            'R' => $this->direction = $this->turnRight(),
            'M' => $this->moveForward(),
            default => throw new InvalidArgumentException("Invalid command: $command"),
        };
    }

    private function turnLeft(): Direction
    {
        return match ($this->direction) {
            Direction::North => Direction::West,
            Direction::East => Direction::North,
            Direction::South => Direction::East,
            Direction::West => Direction::South,
        };
    }

    private function turnRight(): Direction
    {
        return match ($this->direction) {
            Direction::North => Direction::East,
            Direction::East => Direction::South,
            Direction::South => Direction::West,
            Direction::West => Direction::North,
        };
    }

    private function moveForward(): void
    {
        $newX = $this->position->getX();
        $newY = $this->position->getY();

        switch ($this->direction) {
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

        if ($newX < 0 || $newX > $this->getPlateauWidth() || $newY < 0 || $newY > $this->getPlateauHeight()) {
            throw new InvalidArgumentException('Rover cannot move beyond plateau boundaries');
        }

        $this->position->setX($newX);
        $this->position->setY($newY);
    }


    public function setPlateauWidth(int $width): void
    {
        $this->plateauWidth = $width;
    }

    public function getPlateauWidth(): int
    {
        return $this->plateauWidth;
    }

    public function setPlateauHeight(int $height): void
    {
        $this->plateauHeight = $height;
    }

    public function getPlateauHeight(): int
    {
        return $this->plateauHeight;
    }

    public function getPosition(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->direction->value}";
    }
}