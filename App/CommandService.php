<?php

declare(strict_types=1);

namespace App;

use App\Enums\Command;
use App\Models\Rover;

class CommandService
{
    public function __construct(private readonly Rover $rover, private readonly array $commands)
    {
    }

    public function executeCommands(): void
    {
        foreach ($this->commands as $command) {
            $command = Command::mapCommand($command);
            $command->execute($this->rover);
        }
    }
}