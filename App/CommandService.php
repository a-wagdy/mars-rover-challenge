<?php

declare(strict_types=1);

namespace App;

use App\Enums\Command;
use App\Rover;

class CommandService
{
    public static function executeCommands(Rover $rover, array $commands): void
    {
        foreach ($commands as $command) {
            $command = Command::mapCommand($command);
            $command->execute($rover);
        }
    }
}