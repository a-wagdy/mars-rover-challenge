<?php

declare(strict_types=1);

use App\Models\Plateau;
use App\Models\Position;
use App\Models\Rover;
use PHPUnit\Framework\TestCase;
use App\Enums\Direction;
use App\CommandService;

final class RoverTest extends TestCase
{
    public function testCommandExecution(): void
    {
        $plateau = new Plateau(5, 5);

        // Index number 4 is the expected output
        $rovers = [
            [1, 2, Direction::North, 'M', '1 3 N'],
            [1, 2, Direction::North, 'RRLL', '1 2 N'],
            [1, 2, Direction::North, 'LMLMLMLMM', '1 3 N'],
            [3, 3, Direction::East, 'MMRMMRMRRM', '5 1 E'],
            [0, 0, Direction::South, 'RRRR', '0 0 S'],
            [0, 0, Direction::West, '', '0 0 W'],
        ];

        foreach ($rovers as $roverData) {
            $position = new Position($roverData[0], $roverData[1]);
            $rover = new Rover($plateau, $position, $roverData[2]);

            $commands = str_split($roverData[3]);

            $commandService = new CommandService($rover, $commands);
            $commandService->executeCommands();

            $actualOutput = $rover->getCurrentPosition();
            $expectedOutput = $roverData[4];

            $this->assertEquals($actualOutput, $expectedOutput);

        }
    }

    public function testMoveBeyondPlateauDimension(): void
    {
        $plateau = new Plateau(5, 5);

        $rovers = [
            [4, 4, Direction::North, 'MMMMMM'],
        ];

        foreach ($rovers as $roverData) {
            $position = new Position($roverData[0], $roverData[1]);
            $rover = new Rover($plateau, $position, $roverData[2]);

            $commands = str_split($roverData[3]);

            $this->expectException(InvalidArgumentException::class);

            $commandService = new CommandService($rover, $commands);
            $commandService->executeCommands();
        }
    }
}
