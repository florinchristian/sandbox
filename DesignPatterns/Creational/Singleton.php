<?php
    namespace DesignPatterns\Creational\Singleton;

    class DBConnection {
        private static DBConnection $instance;

        private function __construct() {

        }

        public static function getInstance(): DBConnection {
            if (self::$instance == null)
                self::$instance = new DBConnection();

            return self::$instance;
        }

        public function query(string $query): void {

        }
    }