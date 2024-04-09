<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\CommandService;
use App\Enums\Direction;
use App\Models\Plateau;
use App\Models\Position;
use App\Models\Rover;

function run(Plateau $plateau, array $rovers): void
{
    foreach ($rovers as $roverData) {
        $position = new Position($roverData[0], $roverData[1]);
        $rover = new Rover($plateau, $position, $roverData[2]);

        $commands = str_split($roverData[3]);

        CommandService::executeCommands($rover, $commands);

        $actualPosition = $rover->getCurrentPosition();

        $expectedPosition = $roverData[4];

        if ($actualPosition === $expectedPosition) {
            echo "Test Passed - Expected: $expectedPosition, Actual: $actualPosition\n";
        } else {
            echo "Test Failed - Expected: $expectedPosition, Actual: $actualPosition\n";
        }
    }
}

$plateau = new Plateau(5,5);
$rovers = [
    [1, 2, Direction::North, 'M', '1 3 N'],
    [1, 2, Direction::North, 'RRLL', '1 2 N'],
    [1, 2, Direction::North, 'LMLMLMLMM', '1 3 N'],
    [3, 3, Direction::East, 'MMRMMRMRRM', '5 1 E'],
];

run($plateau, $rovers);