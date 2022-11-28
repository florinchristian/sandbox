<?php
    namespace DesignPatterns\Structural\Proxy;

    interface ServerLibrary {
        public function uploadFile(string $content): bool;
    }

    class Server implements ServerLibrary {
        private static Server $instance;

        private function __construct() {

        }

        public static function getInstance(): Server {
            if (!self::$instance)
                self::$instance = new Server();

            return self::$instance;
        }

        public function uploadFile(string $content): bool {
            // upload file

            return true;
        }

        public function checkFile(string $file): bool {
            $fileHash = "md5Hash";

            // if there is a file with the $fileHash hash, return true

            return false;
        }
    }

    class SaveSpaceProxy implements ServerLibrary {
        public function uploadFile(string $content): bool {
            // checks if the file is already on the server
            if (Server::getInstance()->checkFile($content))
                return true;

            return Server::getInstance()->uploadFile($content);
        }
    }

    class CommandCenter {
        private ServerLibrary $serverLibrary;

        public function __construct(ServerLibrary $serverLibrary) {
            $this->serverLibrary = $serverLibrary;
        }

        public function uploadFileToServer(string $content): bool {
            return $this->serverLibrary->uploadFile($content);
        }
    }

    class Driver {
        public static function run(): void {
            $commandCenter = new CommandCenter(new SaveSpaceProxy());

            $commandCenter->uploadFileToServer("catImage");
        }
    }