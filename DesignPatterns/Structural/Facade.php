<?php
    namespace DesignPatterns\Structural\Facade;

    class LibraryA {
        public static function step1(): void {

        }
    }

    class LibraryB {
        public static function step2(): void {

        }
    }

    class LibraryC {
        public static function step3(): void {

        }
    }

    class CommandCenter {
        public static function doImportantStuff(): void {
            LibraryA::step1();
            LibraryB::step2();
            LibraryC::step3();
        }
    }

    class Driver {
        public static function run(): void {
            CommandCenter::doImportantStuff();
        }
    }