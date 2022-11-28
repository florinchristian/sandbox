<?php
    namespace DesignPatterns\Behavioural\ChainOfResponsibility;


class Person {
        private string $name;
        private int $age;
        private bool $isDrunk;
        private bool $isHigh;

        public function __construct(
            string $name,
            int $age,
            bool $isDrunk,
            bool $isHigh)
        {
            $this->name = $name;
            $this->age = $age;
            $this->isDrunk = $isDrunk;
            $this->isHigh = $isHigh;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @return int
         */
        public function getAge(): int
        {
            return $this->age;
        }

        /**
         * @return bool
         */
        public function isDrunk(): bool
        {
            return $this->isDrunk;
        }

        /**
         * @return bool
         */
        public function isHigh(): bool
        {
            return $this->isHigh;
        }

        public function __toString(): string {
            return $this->name;
        }
    }

    interface Handler {
        public function setNext(Handler $handler): Handler;
        public function check(Person $person): bool;
    }

    abstract class ConditionChecker implements Handler {
        private ?Handler $handler = null;

        public function setNext(Handler $handler): Handler {
            $this->handler = $handler;

            return $handler;
        }

        public function check(Person $person): bool {
            if ($this->handler)
                return $this->handler->check($person);

            echo "$person can enter the club\n";

            return true;
        }
    }

    class AgeChecker extends ConditionChecker {
        public function check(Person $person): bool
        {
            if ($person->getAge() < 18) {
                echo "$person can't enter the club (below 18)\n";
                return false;
            }

            return parent::check($person);
        }
    }

    class DrunkChecker extends ConditionChecker {
        public function check(Person $person): bool
        {
            if ($person->isDrunk()) {
                echo "$person can't enter the club (drunk)\n";
                return false;
            }

            return parent::check($person);
        }
    }

    class HighChecker extends ConditionChecker {
        public function check(Person $person): bool
        {
            if ($person->isHigh()) {
                echo "$person can't enter the club (high)\n";
                return false;
            }

            return parent::check($person);
        }
    }

    class Club {
        private array $queue;

        public function __construct() {
            $this->queue = array();
            $this->queue[] = new Person('Alex', 18, false, false);
            $this->queue[] = new Person('Bob', 10, false, false);
            $this->queue[] = new Person('Jessica', 25, true, false);
            $this->queue[] = new Person('Bianca', 19, false, true);
        }

        public function checkPeople(): void {
            foreach ($this->queue as $person) {
                $request = new AgeChecker();

                $request->setNext(new DrunkChecker())
                    ->setNext(new HighChecker());

                $request->check($person);
            }
        }
    }