<?php
    namespace DesignPatterns\Creational\Builder;

    enum Engine {
        case WeakEngine;
        case MediumEngine;
        case PowerfulEngine;
        case Horse;
    }

    interface Builder {
        public function reset(): void;
        public function setEngine(Engine $engine): void;
        public function setNumberOfSeats(int $numberOfSeats): void;
        public function setNumberOfDoors(int $numberOfDoors): void;
        public function setGPS(bool $hasGPS): void;
    }

    class Dacia {

    }

    class Caruta {

    }

    class Director {
        private Builder $builder;

        public function __construct(Builder $builder) {
            $this->builder = $builder;
        }

        public function setBuilder(Builder $builder): void {
            $this->builder = $builder;
        }

        public function makeDacia(): void {
            $this->builder->setEngine(Engine::PowerfulEngine);
            $this->builder->setNumberOfDoors(4);
            $this->builder->setNumberOfSeats(4);
            $this->builder->setGPS(false);
        }

        public function makeCaruta(): void {
            $this->builder->setEngine(Engine::Horse);
            $this->builder->setNumberOfDoors(0);
            $this->builder->setNumberOfSeats(15);
            $this->builder->setGPS(true);
        }
    }

    class DaciaBuilder implements Builder {
        private Dacia $result;

        public function __construct() {
            $this->result = new Dacia();
        }

        public function setEngine(Engine $engine): void {
        }

        public function setNumberOfSeats(int $numberOfSeats): void {
        }

        public function setNumberOfDoors(int $numberOfDoors): void {
        }

        public function setGPS(bool $hasGPS): void {
        }

        public function reset(): void {
            unset($this->result);
            $this->result = new Dacia();
        }

        public function getResult(): Dacia {
            $product = $this->result;
            $this->reset();
            return $product;
        }
    }

    class CarutaBuilder implements Builder {
        private Caruta $result;

        public function __construct() {
            $this->result = new Caruta();
        }

        public function setEngine(Engine $engine): void {
        }

        public function setNumberOfSeats(int $numberOfSeats): void {
        }

        public function setNumberOfDoors(int $numberOfDoors): void {
        }

        public function setGPS(bool $hasGPS): void {
        }

        public function reset(): void {
            unset($this->result);
            $this->result = new Caruta();
        }

        public function getResult(): Caruta {
            $product = $this->result;
            $this->reset();
            return $product;
        }
    }