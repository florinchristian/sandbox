<?php
    interface Vaccine {
        function fightDisease(): bool;
    }

    class Sputnik implements Vaccine {
        function fightDisease(): bool {
            # Sputnik gives Covid some vodka. Covid can't handle it and dies.

            return true;
        }
    }

    class Pfizer implements Vaccine {
        public function fightDisease(): bool {
            # Pfizer shows Covid the trending YouTube videos in Romania. Covid dies of cringe.

            return true;
        }
    }

    abstract class VaccineFactory {
        abstract function createVaccine(): Vaccine;
    }

    class RomaniaCenter extends VaccineFactory {
        function createVaccine(): Vaccine {
            return new Pfizer();
        }
    }

    class RussiaCenter extends VaccineFactory {
        function createVaccine(): Vaccine {
            return new Sputnik();
        }
    }

