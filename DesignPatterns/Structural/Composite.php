<?php
    namespace DesignPatterns\Structural\Composite;

    interface Circuit {
        public function turnOff(): void;
        public function turnOn(): bool;

        public function isBroken(): bool;
        public function isRunning(): bool;

        public function printSuccessMessage(): void;
        public function printErrorMessage(): void;
    }

    abstract class Module implements Circuit {
        protected bool $isRunning;
        protected bool $isBroken;
        protected string $name;

        public function __construct(string $name) {
            $this->name = $name;
            $this->isRunning = false;
            $this->isBroken = false;
        }

        // each component implements its way of turning on and may break down in the meanwhile
        abstract function turnOn(): bool;

        public function printSuccessMessage(): void {
            echo "$this successfully turned on.\n";
        }

        public function printErrorMessage(): void {
            echo "$this won't turn on (broken).\n";
        }

        public function __toString(): string {
            return $this->name;
        }

        public function turnOff(): void {
            $this->isRunning = false;
        }

        public function isBroken(): bool {
            return $this->isBroken;
        }

        public function isRunning(): bool {
            return $this->isRunning;
        }
    }

    class CPU extends Module {
        function turnOn(): bool {
            $this->printSuccessMessage();
            $this->isRunning = true;
            return true;
        }
    }

    class GPU extends Module {
        function turnOn(): bool {
            $this->printSuccessMessage();
            $this->isRunning = true;
            return true;
        }
    }

    class RAM extends Module {
        function turnOn(): bool {
            $this->printSuccessMessage();
            $this->isRunning = true;
            return true;
        }
    }

    class Computer extends Module {
        private array $components;

        public function __construct(string $name) {
            parent::__construct($name);
            $this->components = array();
        }

        public function addComponent(Circuit $component) {
            $this->components[] = $component;
        }

        public function turnOff(): void {
            foreach ($this->components as $component)
                $component->turnOff();
        }

        public function turnOn(): bool {
            foreach ($this->components as $component) {
                if (!$component->turnOn()) {
                    $component->printErrorMessage();
                    $this->printErrorMessage();

                    $this->isRunning = false;
                    $this->isBroken = true;

                    return false;
                }
            }

            $this->printSuccessMessage();

            $this->isRunning = true;
            return true;
        }
    }

    class Driver {
        public static function run(): void {
            $computer = new Computer("Gaming PC");

            $computer->addComponent(new RAM("1TB of RAM"));
            $computer->addComponent(new CPU("i69 11ghz Intel CPU"));
            $computer->addComponent(new GPU("nVIDIA 6950 RTX 32GB Gaming GPU"));

            $computer->turnOn();
        }
    }
