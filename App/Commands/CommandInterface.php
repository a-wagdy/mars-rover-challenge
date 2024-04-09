<?php

declare(strict_types=1);

namespace App\Commands;

use App\Models\Rover;

interface CommandInterface
{
    public function execute(Rover $rover): void;
}