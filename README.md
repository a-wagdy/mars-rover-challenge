## Stack

PHP 8.2

## Installation

1. Clone the repo.
2. Open the terminal and execute `composer install`

> Composer is only used to autoload files and install PHPUnit.

## Architecture

### Command Pattern

- Command abstraction: `CommandInterface`
- Concrete command classes: `MoveForwardCommand`, `TurnLeftCommand`, and `TurnRightCommand`

## Future Directions

What if other types of rovers execute commands based on their temperature or battery life conditions? 

1. A new superclass (vehicle) will be created with shared properties between all types of rovers
2. Each unique rover will have a relationship (has a) with its relevant conditions (interfaces)

# UML diagram

If the mermaid is not rendered in your IDE, please view the 'UML Diagram.png' located in the root directory.

## Mermaid

> Please note that properties X and Y refer to the grid coordinates.

```mermaid
classDiagram
    class CommandInterface {
        +execute(Rover $rover): void
    }
    CommandInterface <|-- MoveForwardCommand
    CommandInterface <|-- TurnLeftCommand
    CommandInterface <|-- TurnRightCommand

    class Plateau {
        -x: int
        -y: int
        +getX(): int
        +getY(): int
    }

    class Position {
        -x: int
        -y: int
        +getX(): int
        +setX(x: int): void
        +getY(): int
        +setY(y: int): void
    }

    class Direction {
        <<enumeration>>
        North
        East
        South
        West
    }

    class Rover {
        -plateau: Plateau
        -position: Position
        -direction: Direction
        +getPlateau(): Plateau
        +getPosition(): Position
        +setPosition(x: int, y: int): void
        +getDirection(): Direction
        +setDirection(direction: Direction): void
    }

    class Command {
        <<enumeration>>
        Left
        Right
        Forward
    }

    class CommandService {
        -rover: Rover
        -commands: Command[]
        +executeCommands(): void
    }

    Rover *-- CommandService
    Plateau *-- Rover
    Position *-- Rover
    Direction *-- Rover
    CommandInterface <-- CommandService : contains
```

