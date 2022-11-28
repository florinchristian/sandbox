<?php
    namespace DesignPatterns\Behavioural\Template;

    interface DocumentReader {
        public function extractFileData(string $content): string;
        public function parseFileData(string $content): string;
    }

    abstract class DocumentTool implements DocumentReader {
        public function processFile(string $path): string {
            $content = $this->readFile($path);
            $rawData = $this->extractFileData($content);

            return $this->parseFileData($rawData);
        }

        protected function readFile(string $path): string {
            return "";
        }
    }

    class CSVReader extends DocumentTool {
        public function extractFileData(string $content): string {
            echo "Extracting CSV data.\n";
            return "";
        }

        public function parseFileData(string $content): string {
            echo "Parsing CSV data.\n";
            return "";
        }
    }

    class PDFReader extends DocumentTool {
        public function extractFileData(string $content): string {
            echo "Extracting PDF data.\n";
            return "";
        }

        public function parseFileData(string $content): string {
            echo "Parsing PDF data.\n";
            return "";
        }
    }

    class Driver {
        public static function run(): void {
            $toolName = __NAMESPACE__."\CSVReader";

            $tool = new $toolName();
            $tool->processFile("yourMom.txt");
        }
    }