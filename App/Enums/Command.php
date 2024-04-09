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
            'L' => new TurnLeftCommand(),
            'R' => new TurnRightCommand(),
            'M' => new MoveForwardCommand(),
            default => throw new InvalidArgumentException("Invalid command: $command"),
        };
    }
}