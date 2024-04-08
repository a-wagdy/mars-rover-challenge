<?php

declare(strict_types=1);

require_once 'Rover.php';
require_once 'Position.php';
require_once 'Direction.php';

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
        $direction = $testCase['rover'][2];
        $rover = new Rover($position, $direction);

        $rover->setPlateauWidth($plateauWidth);
        $rover->setPlateauHeight($plateauHeight);

        $commands = $testCase['rover'][3];
        foreach (str_split($commands) as $command) {
            try {
                $rover->move($command);
            } catch (InvalidArgumentException $e) {
                echo $e->getMessage() . "\n";
            }
        }

        $actualPosition = $rover->getPosition();
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