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
    public function testCommandExecutionPlateau5and5(): void
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

            $actualOutput = $this->getActualOutput($rover);
            $expectedOutput = $roverData[4];

            $this->assertEquals($actualOutput, $expectedOutput);

        }
    }

    public function testCommandExecutionForPlateau7and10(): void
    {
        $plateau = new Plateau(7, 10);

        // Index number 4 is the expected output
        $rovers = [
            [1, 2, Direction::North, 'MMMMMM', '1 8 N'],
            [3, 5, Direction::East, 'LLMMM', '0 5 W'],
            [0, 0, Direction::North, 'RRRRRRRRMMMMMMM', '0 7 N'],
            [3, 4, Direction::South, 'MMMRMMRMMRMMM', '4 3 E'],
        ];


        foreach ($rovers as $roverData) {
            $position = new Position($roverData[0], $roverData[1]);
            $rover = new Rover($plateau, $position, $roverData[2]);

            $commands = str_split($roverData[3]);

            $commandService = new CommandService($rover, $commands);
            $commandService->executeCommands();

            $actualOutput = $this->getActualOutput($rover);
            $expectedOutput = $roverData[4];

            $this->assertEquals($actualOutput, $expectedOutput);

        }
    }

    public function testMoveBeyondPlateauDimension(): void
    {
        $plateau = new Plateau(5, 5);

        $roverData = [4, 4, Direction::North, 'MMMMMM'];

        $position = new Position($roverData[0], $roverData[1]);
        $rover = new Rover($plateau, $position, $roverData[2]);

        $commands = str_split($roverData[3]);

        $this->expectException(InvalidArgumentException::class);

        $commandService = new CommandService($rover, $commands);
        $commandService->executeCommands();
    }

    public function testInvalidCommand(): void
    {
        $plateau = new Plateau(5, 5);

        $roverData = [4, 4, Direction::North, 'SSS'];

        $position = new Position($roverData[0], $roverData[1]);
        $rover = new Rover($plateau, $position, $roverData[2]);

        $commands = str_split($roverData[3]);

        $this->expectException(InvalidArgumentException::class);

        $commandService = new CommandService($rover, $commands);
        $commandService->executeCommands();
    }

    private function getActualOutput(Rover $rover): string
    {
        return $rover->getPosition()->getX() . ' ' . $rover->getPosition()->getY() . ' ' . $rover->getDirection()->value;
    }
}
