<?php
    namespace DesignPatterns\Structural\Adapter;

    class JSONData {
        private string $content;

        public function setContent(string $content): void {
            $this->content = $content;
        }

        public function getContent(): string {
            return $this->content;
        }
    }

    class DumbFormat {
        private string $content;

        public function setContent(string $content): void {
            $this->content = $content;
        }

        public function getContent(): string {
            return $this->content;
        }
    }

    class StrangeLibraryThatWorksOnlyWithJSON {
        private string $data;

        public function __construct(JSONData $data) {
            $this->data = $data->getContent();
        }

        public function doItsThing(): void {
            // idk
        }
    }

    class DumbFormatAdapter extends JSONData {
        private DumbFormat $dumbFormat;

        public function __construct(DumbFormat $dumbFormat) {
            $this->dumbFormat = $dumbFormat;
        }

        public function getContent(): string {
            $oldData = $this->dumbFormat->getContent();

            // convert data

            return $oldData;
        }
    }

    class Driver {
        public static function run(): void {
            $data1 = new JSONData();
            $data1->setContent("content123");

            $data2 = new DumbFormat();
            $data2->setContent("dumbContent123");

            $library = new StrangeLibraryThatWorksOnlyWithJSON(new DumbFormatAdapter($data2));
            $library->doItsThing();
        }
    }