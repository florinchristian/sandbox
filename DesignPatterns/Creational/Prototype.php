<?php
    namespace DesignPatterns\Creational\Prototype;

    interface Prototype {
        public function clone(): Prototype;
    }

    class Person implements Prototype {
        public string $name;
        public int $age;

        public function c2(string $name, int $age) {
            $this->name = $name;
            $this->age = $age;
        }

        public function c1(Person $source) {
            $this->name = $source->name;
            $this->age = $source->age;
        }

        public function __construct() {
            $args = func_get_args();
            $count = func_num_args();

            if (method_exists($this, "c$count"))
                call_user_func_array(array($this, "c$count"), $args);
        }

        public function clone(): Prototype {
            return new Person($this);
        }
    }