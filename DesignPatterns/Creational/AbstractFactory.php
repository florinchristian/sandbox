<?php
    namespace DesignPatterns\Creational\AbstractFactory;

    interface UFO {
        function consumeFuel();
    }

    class ElectricUFO implements UFO {
        function consumeFuel() {

        }
    }

    class GasUFO implements UFO {
        function consumeFuel() {

        }
    }

    class HybridUFO implements UFO {
        function consumeFuel() {

        }
    }

    interface Caruta {
        function consumeFuel();
    }

    class ElectricCaruta implements Caruta {
        function consumeFuel() {

        }
    }

    class GasCaruta implements Caruta {
        function consumeFuel() {

        }
    }

    class HybridCaruta implements Caruta {
        function consumeFuel() {

        }
    }

    interface Bicycle {
        function consumeFuel();
    }

    class ElectricBicycle implements Bicycle {
        function consumeFuel() {

        }
    }

    class GasBicycle implements Bicycle {
        function consumeFuel() {

        }
    }

    class HybridBicycle implements Bicycle {
        function consumeFuel() {

        }
    }

    abstract class VehicleFactory {
        abstract function createUFO(): UFO;
        abstract function createCaruta(): Caruta;
        abstract function createBycicle(): Bicycle;
    }

    class ElectricFactory extends VehicleFactory {
        function createUFO(): UFO {
            return new ElectricUFO();
        }

        function createCaruta(): Caruta {
            return new ElectricCaruta();
        }

        function createBycicle(): Bicycle {
            return new ElectricBicycle();
        }
    }

    class GasFactory extends VehicleFactory {
        function createUFO(): UFO {
            return new GasUFO();
        }

        function createCaruta(): Caruta {
            return new GasCaruta();
        }

        function createBycicle(): Bicycle {
            return new GasBicycle();
        }
    }

    class HybridFactory extends VehicleFactory {
        function createUFO(): UFO {
            return new HybridUFO();
        }

        function createCaruta(): Caruta {
            return new HybridCaruta();
        }

        function createBycicle(): Bicycle {
            return new HybridBicycle();
        }
    }

