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

        $commandService = new CommandService($rover, $commands);
        $commandService->executeCommands();
    }
}

$plateau = new Plateau(5,5);
$rovers = [
    [1, 2, Direction::North, 'M'],
];

run($plateau, $rovers);