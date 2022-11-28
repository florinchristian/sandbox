<?php
    namespace DesignPatterns\Behavioural\Observer;

    interface Observer {
        public function notify(string $message): void;
    }

    class Customer implements Observer {
        private string $name;

        public function __construct(string $name) {
            $this->name = $name;
        }

        public function getName(): string {
            return $this->name;
        }

        public function notify(string $message): void {
            echo "Customer $this->name got the message: $message\n";
        }
    }

    class MobileShop {
        private array $subscribers;

        public function __construct() {
            $this->subscribers = array();
        }

        public function addSubscriber(Observer $subscriber, string $topic): void {
            $this->subscribers[$topic][] = $subscriber;
        }

        public function newProduct(string $product): void {
            if (isset($this->subscribers[$product]))
                foreach ($this->subscribers[$product] as $customer)
                    $customer->notify("Your desired $product is now available!");
        }
    }

    class Driver {
        public static function run(): void {
            $shop = new MobileShop();

            $a = new Customer("Alex");
            $b = new Customer("Kate");

            $shop->addSubscriber($a, "iPhone 17 Extra Large");
            $shop->addSubscriber($b, "Samsung Galaxy S69");

            $shop->newProduct("Xiaomi 20");

            $shop->newProduct("iPhone 17 Extra Large");
            $shop->newProduct("Samsung Galaxy S69");
        }
    }