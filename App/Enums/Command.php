<?php

declare(strict_types=1);

namespace App\Enums;
use App\Commands\CommandInterface;
use App\Commands\MoveForwardCommand;
use App\Commands\TurnLeftCommand;
use App\Commands\TurnRightCommand;
use InvalidArgumentException;

enum Command: string
{
    case Left = 'L';
    case Right = 'R';
    case Forward = 'M';

    public static function mapCommand(string $command): CommandInterface
    {
        return match ($command) {
            Command::Left->value => new TurnLeftCommand(),
            Command::Right->value => new TurnRightCommand(),
            Command::Forward->value => new MoveForwardCommand(),
            default => throw new InvalidArgumentException("Invalid command: $command"),
        };
    }
}