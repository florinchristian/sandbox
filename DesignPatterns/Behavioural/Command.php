<?php
    namespace DesignPatterns\Behavioural\Command;

    interface Order {
        public function prepare();
    }

    class Chef {
        public function makePizza(): void{
            echo "A pizza was made.\n";
        }

        public function makeStew(): void {
            echo "A stew was made.\n";
        }

        public function makeLimonade(): void {
            echo "A limonade was made.\n";
        }
    }

    class OrderPizza implements Order {
        private Chef $chef;

        public function __construct(Chef $chef) {
            $this->chef = $chef;
        }

        public function prepare() {
            $this->chef->makePizza();
        }
    }

    class OrderStew implements Order {
        private Chef $chef;

        public function __construct(Chef $chef) {
            $this->chef = $chef;
        }

        public function prepare() {
            $this->chef->makeStew();
        }
    }

    class OrderLimonade implements Order {
        private Chef $chef;

        public function __construct(Chef $chef) {
            $this->chef = $chef;
        }

        public function prepare() {
            $this->chef->makeLimonade();
        }
    }

    class Waiter {
        private array $orders;

        public function __construct() {
            $this->orders = array();
        }

        public function takeOrder(Order $order): void {
            $this->orders[] = $order;
        }

        public function placeOrders(): void {
            foreach ($this->orders as $order)
                $order->prepare();
        }
    }

    class Restaurant {
        public function runExample(): void {
            $chef = new Chef();
            $waiter = new Waiter();

            $waiter->takeOrder(new OrderPizza($chef));
            $waiter->takeOrder(new OrderStew($chef));
            $waiter->takeOrder(new OrderLimonade($chef));

            $waiter->placeOrders();
        }
    }
