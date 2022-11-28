<?php
    namespace DesignPatterns\Behavioural\Visitor;

    interface Mergeable {
        public function acceptMerge(MergeExtension $merger): void;
    }

    interface MergeAlgorithm {
        public function formatPiece(string $content): string;
        public function formatWhole(string $content): string;
    }

    class PDFFormatter implements MergeAlgorithm {
        public function formatPiece(string $content): string {
            return "";
        }

        public function formatWhole(string $content): string {
            return "";
        }
    }

    class CSVFormatter implements MergeAlgorithm {
        public function formatPiece(string $content): string {
            return "";
        }

        public function formatWhole(string $content): string {
            return "";
        }
    }

    class DOCFormatter implements MergeAlgorithm {
        public function formatPiece(string $content): string {
            return "";
        }

        public function formatWhole(string $content): string {
            return "";
        }
    }

    abstract class Document {
        protected string $path;

        protected string $content;
        protected string $parsedContent;

        abstract function parseContent(): void;

        public function __construct(string $path) {
            $this->path = $path;
            $this->content = null;
            $this->parsedContent = null;
        }

        private function readFile(): void {

        }

        public function getRawContent(): string {
            if (!$this->content)
                $this->readFile();

            return $this->content;
        }

        public function getParsedContent(): string {
            if (!$this->parsedContent)
                $this->parseContent();

            return $this->parsedContent;
        }
    }

    class PDFDocument extends Document implements Mergeable {
        function parseContent(): void {

        }

        public function acceptMerge(MergeExtension $merger): void {
            $merger->grabPDF($this);
        }
    }
    class CSVDocument extends Document implements Mergeable {
        function parseContent(): void {

        }

        public function acceptMerge(MergeExtension $merger): void {
            $merger->grabCSV($this);
        }
    }
    class DOCDocument extends Document implements Mergeable {
        function parseContent(): void {

        }

        public function acceptMerge(MergeExtension $merger): void {
            $merger->grabDoc($this);
        }
    }

    interface MergeExtension {
        public function grabPDF(PDFDocument $document): void;
        public function grabCSV(CSVDocument $document): void;
        public function grabDoc(DOCDocument $document): void;
    }

    class MergeTool implements MergeExtension {
        private MergeAlgorithm $formatter;
        private string $output;

        public function setOutputFormatter(MergeAlgorithm $formatter) {
            $this->formatter = $formatter;
        }

        // Stiu ca e cod repetitiv si ca puteam face un singur grabDocument, din moment ce extind ac clasa,
        // dar am facut asa for the sake of example

        public function grabPDF(PDFDocument $document): void  {
            $this->output .= $this->formatter->formatPiece($document->getParsedContent());
        }

        public function grabCSV(CSVDocument $document): void {
            $this->output .= $this->formatter->formatPiece($document->getParsedContent());
        }

        public function grabDoc(DOCDocument $document): void {
            $this->output .= $this->formatter->formatPiece($document->getParsedContent());
        }

        public function saveResult(string $path): void {
            $result =  $this->formatter->formatWhole($this->output);

            // save it somewhere
        }
    }

    class Driver {
        public static function run(): void {
            $documents = array(
                new PDFDocument("document.doc"),
                new CSVDocument("document.csv"),
                new PDFDocument("document.pdf")
            );

            $tool = new MergeTool();
            $tool->setOutputFormatter(new DOCFormatter());

            foreach ($documents as $document)
                $document->acceptMerge($tool);

            $tool->saveResult("result");
        }
    }