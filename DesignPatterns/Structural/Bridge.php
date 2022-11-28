<?php
    namespace DesignPatterns\Structural\Bridge;

    interface Computer {
        public function isRunning(): bool;
        public function shutdown(): void;
        public function powerOn(): void;

        public function hasInternet(): bool;
        public function googleThing(string $query): string;
    }

    class WindowsComputer implements Computer {
        private bool $isRunning;
        private bool $hasInternet;

        public function __construct() {
            $this->isRunning = false;
            $this->hasInternet = true;
        }

        public function isRunning(): bool {
            return $this->isRunning;
        }

        public function shutdown(): void {
            $this->isRunning = false;
        }

        public function powerOn(): void {
            $this->isRunning = true;
        }

        public function hasInternet(): bool {
            return $this->hasInternet;
        }

        public function googleThing(string $query): string {
            // google

            return "";
        }
    }

    class OSInterface {
        private Computer $computer;

        public function __construct(Computer $computer) {
            $this->computer = $computer;
        }

        public function startComputer(): void {
            if (!$this->computer->isRunning())
                $this->computer->powerOn();
        }

        public function stopComputer(): void {
            if ($this->computer->isRunning())
                $this->computer->shutdown();
        }

        public function searchTheInternetFor(string $query): string {
            if ($this->computer->hasInternet())
                return $this->computer->googleThing($query);
            else
                return "";
        }
    }

    class Driver {
        public static function run(): void {
            $computer = new WindowsComputer();
            $os = new OSInterface($computer);

            echo $os->searchTheInternetFor("cute kittens");
        }
    }