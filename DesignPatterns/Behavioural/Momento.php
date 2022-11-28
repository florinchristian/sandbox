<?php
    namespace DesignPatterns\Behavioural\Momento;

    class Game {
        private int $progress;
        private array $friends;

        public function __construct() {
            $this->progress = 0;
            $this->friends = array();
        }

        public function setProgress(int $progress): void {
            $this->progress = $progress;
        }

        public function addFriend(string $friend): Game {
            $this->friends[] = $friend;
            return $this;
        }

        public function setFriends(array $friends): void {
            $this->friends = $friends;
        }

        public function __toString(): string {
            return "Current game: $this->progress% progress and friends="
                .implode(',', $this->friends);
        }

        public function makeBackup(): GameBackup {
            return new GameBackup($this, $this->progress, $this->friends);
        }
    }

    class GameBackup {
        private Game $game;
        private int $progress;
        private array $friends;

        public function __construct(Game $game, int $progress, array $friends) {
            $this->game = $game;
            $this->progress = $progress;
            $this->friends = $friends;
        }

        public function restore(): void {
            $this->game->setProgress($this->progress);
            $this->game->setFriends($this->friends);
        }
    }

    class Driver {
        private GameBackup $backup;

        public function run(): void {
            $game = new Game();

            $game
                ->addFriend('Maya')
                ->addFriend('Alex');

            $game->setProgress(15);

            echo $game."\n";

            $this->backup = $game->makeBackup();

            $game
                ->addFriend('Ion')
                ->addFriend('Gebadaia');

            $game->setProgress(47);

            echo $game."\n";

            $this->backup->restore();

            echo $game."\n";
        }
    }