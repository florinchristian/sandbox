<?php
    namespace DesignPatterns\Structural\Decorator;

    interface ImageProcessor {
        public function exportImage(): string;
    }

    class ImageEditor implements ImageProcessor {
        private string $image;

        public function __construct(string $image) {
            $this->image = $image;
        }

        public function exportImage(): string {
            return $this->image;
        }
    }

    class ImageDecorator implements ImageProcessor {
        protected ImageProcessor $imageProcessor;

        public function __construct(ImageProcessor $imageProcessor) {
            $this->imageProcessor = $imageProcessor;
        }

        public function exportImage(): string {
            return $this->imageProcessor->exportImage();
        }
    }

    class ImageWatermarkDecorator extends ImageDecorator {
        private string $watermark;

        public function __construct(ImageProcessor $imageProcessor, string $watermark) {
            parent::__construct($imageProcessor);
            $this->watermark = $watermark;
        }

        public function exportImage(): string {
           $originalImage = parent::exportImage();

           return "<$this->watermark>$originalImage</$this->watermark>";
        }
    }

    class CensorPixelsDecorator extends ImageDecorator {
        private array $badWords;

        public function __construct(ImageProcessor $imageProcessor, array $badWords) {
            parent::__construct($imageProcessor);
            $this->badWords = $badWords;
        }

        public function exportImage(): string {
            $image =  parent::exportImage();

            return str_replace($this->badWords, '', $image);
        }
    }

    class Driver {
        public static function run(): void {
            $premium = false;
            $censorBadWords = false;

            $badWords = array("cat");

            $imageEditor = new ImageEditor("catImage");

            if ($censorBadWords)
                $imageEditor = new CensorPixelsDecorator($imageEditor, $badWords);

            if (!$premium)
                $imageEditor = new ImageWatermarkDecorator($imageEditor, "made with image editor");

            echo $imageEditor->exportImage();
        }
    }