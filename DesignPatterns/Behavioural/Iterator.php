<?php
    namespace DesignPatterns\Behavioural\Iterator;

    abstract class Unit {
        protected int $id;

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function getId(): int {
            return $this->id;
        }

        abstract function getName(): string;
    }

    class House extends Unit {
        private array $inhabitants;

        public function __construct() {
            $this->inhabitants = array();
        }

        public function addInhabitant(string $name): House {
            $this->inhabitants[] = $name;
            return $this;
        }

        public function removeInhabitant(string $name): void {
            $this->inhabitants = array_filter($this->inhabitants, function ($inhabitant) use ($name){
                return $inhabitant != $name;
            });
        }

        public function getName(): string {
            return "The house[id = $this->id] of ".implode(',', $this->inhabitants);
        }
    }

    class Store extends Unit {
        private string $name;

        public function __construct(string $name) {
            $this->name = $name;
        }

        public function getName(): string {
            return "Store[id = $this->id] $this->name";
        }
    }

    abstract class NeighbourhoodIterator {
        protected Neighbourhood $neighbourhood;

        protected array $content;
        protected int $currentPos;

        public function __construct(Neighbourhood $neighbourhood) {
            $this->neighbourhood = $neighbourhood;
            $this->content = array();
            $this->currentPos = 0;
        }

        abstract protected function fetch(): void;

        public function getNext(): Unit {
            $res = $this->content[$this->currentPos];
            $this->currentPos++;
            return $res;
        }

        public function hasMore(): bool {
            $this->fetch();
            return $this->currentPos < count($this->content) ;
        }
    }

    class HouseIterator extends NeighbourhoodIterator {
        protected function fetch(): void {
            if (count($this->content) == 0)
                $this->content = array_values($this->neighbourhood->getHouses());
        }
    }

    class StoreIterator extends NeighbourhoodIterator {
        protected function fetch(): void {
            if (count($this->content) == 0)
                $this->content = array_values($this->neighbourhood->getStores());
        }
    }

    interface IterableNeighbourhood {
        public function getHouseIterator(): NeighbourhoodIterator;
        public function getStoreIterator(): NeighbourhoodIterator;
    }

    class Neighbourhood implements IterableNeighbourhood {
        static private int $count;
        private array $units;

        public function __construct() {
            $this->units = array();
            self::$count = 0;
        }

        public static function getTotalUnits(): int {
            return self::$count;
        }

        public function addUnit(Unit $unit): Neighbourhood {
            self::$count++;
            $unit->setId(self::$count);

            $this->units[] = $unit;

            return $this;
        }

        public function getHouses(): array {
            return array_filter($this->units, function ($unit) {
               return $unit instanceof House;
            });
        }

        public function getStores(): array {
            return array_filter($this->units, function ($unit) {
                return $unit instanceof Store;
            });
        }

        public function getStoreIterator(): NeighbourhoodIterator {
            return new StoreIterator($this);
        }

        public function getHouseIterator(): NeighbourhoodIterator {
            return new HouseIterator($this);
        }
    }

    class Driver {
        public static function run(): void {
            $neighbourhood = new Neighbourhood();

            $house1 = new House();

            $house1->addInhabitant("Cristi")
                ->addInhabitant("Emanuel")
                ->addInhabitant("Alexia");

            $house2 = new House();

            $house2->addInhabitant("Ion")
                ->addInhabitant("Radu")
                ->addInhabitant("Matei");

            $store1 = new Store("Noriel");
            $store2 = new Store("La doi pasi");
            $store3 = new Store("Big family");


            $neighbourhood
                ->addUnit($house1)
                ->addUnit($house2);

            $neighbourhood
                ->addUnit($store1)
                ->addUnit($store2)
                ->addUnit($store3);

            $houseIterator = $neighbourhood->getHouseIterator();
            $storeIterator = $neighbourhood->getStoreIterator();

            while ($houseIterator->hasMore())
                echo $houseIterator->getNext()->getName()."\n";

            while ($storeIterator->hasMore())
                echo $storeIterator->getNext()->getName()."\n";
        }
    }