<?php
    namespace DesignPatterns\Behavioural\State;

    class Position {
        private int $x;
        private int $y;

        public function __construct(int $x, int $y) {
            $this->x = $x;
            $this->y = $y;
        }
        public function getX(): int {
            return $this->x;
        }

        public function getY(): int {
            return $this->y;
        }

        public function moveBy(Position $position): void {
            $this->x += $position->getX();
            $this->y += $position->getY();
        }
    }

    class Player {
        private Position $position;

        public function __construct() {
            $this->position = new Position(0, 0);
        }

        public function moveBy(Position $position): void {
            $this->position->moveBy($position);
            echo "Player moved to position ".$position->getX()." ".$position->getY()."\n";
        }

        public function getPosition(): Position {
            return $this->position;
        }
    }

    class Game {
        private State $currentState;

        private Player $player;

        public function __construct() {
            $this->setState(new LoadingState($this));
        }

        public function setState(State $state): void {
            $this->currentState = $state;
            echo "Switched to $state state!";
        }

        public function movePlayer(Position $position): void {
            $this->player->moveBy($position);
        }
    }

    abstract class State {
        protected Game $game;

        public function __construct(Game $game) {
            $this->game = $game;
        }

        abstract function onKeyPress(string $key): void;
    }

    class LoadingState extends State {
        public function __toString(): string {
            return __CLASS__;
        }

        function onKeyPress(string $key): void {

        }
    }

    class PauseState extends State {
        public function __toString(): string {
            return __CLASS__;
        }

        function onKeyPress(string $key): void {
            if ($key == 'ESC')
                $this->game->setState(new PlayState($this->game));
        }
    }

    class PlayState extends State {
        private array $keys;

        public function __toString(): string {
            return __CLASS__;
        }

        public function __construct(Game $game) {
            parent::__construct($game);

            $this->keys = array(
                "W" => new Position(1, 0),
                "A" => new Position(-1, 0),
                "S" => new Position(0, -1),
                "D" => new Position(0, 1)
            );
        }

        function onKeyPress(string $key): void {
            if ($key == 'ESC')
                $this->game->setState(new PauseState($this->game));

            if (isset($this->keys[$key]))
                $this->game->movePlayer($this->game[$key]);
        }
    }



