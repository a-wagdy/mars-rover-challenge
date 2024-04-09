<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Enums\Direction;
use App\Plateau;
use App\Position;
use App\Rover;

function runTestCases(int $plateauWidth, int $plateauHeight): void
{
    $testCases = [
        [
            'rover' => [1, 2, Direction::North, 'M'],
            'expected' => '1 3 N',
        ],
        [
            'rover' => [1, 2, Direction::North, 'RRLL'],
            'expected' => '1 2 N',
        ],
        [
            'rover' => [1, 2, Direction::North, 'LMLMLMLMM'],
            'expected' => '1 3 N',
        ],
        [
            'rover' => [3, 3, Direction::East, 'MMRMMRMRRM'],
            'expected' => '5 1 E',
        ],
    ];

    foreach ($testCases as $testCase) {
        $position = new Position($testCase['rover'][0], $testCase['rover'][1]);
        $plateau = new Plateau($plateauWidth, $plateauHeight);
        $direction = $testCase['rover'][2];
        $rover = new Rover($plateau, $position, $direction);

        $commands = $testCase['rover'][3];
        $commands = str_split($commands);

        $rover->executeCommands($commands);

        $actualPosition = $rover->getNewPosition();
        $expectedPosition = $testCase['expected'];

        if ($actualPosition === $expectedPosition) {
            echo "Test Passed - Expected: $expectedPosition, Actual: $actualPosition\n";
        } else {
            echo "Test Failed - Expected: $expectedPosition, Actual: $actualPosition\n";
        }
    }
}

// You can set the plateau dimensions here before running the test cases
$plateauWidth = 5;
$plateauHeight = 5;
runTestCases($plateauWidth, $plateauHeight);