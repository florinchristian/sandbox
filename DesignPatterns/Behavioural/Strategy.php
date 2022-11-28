<?php
    namespace DesignPatterns\Behavioural\Strategy;

    interface Filter {
        public function filter(array $places): array;
    }

    class PopularityFilter implements Filter {
        public function filter(array $places): array {
            // filter by popularity

            return array();
        }
    }

    class DistanceFilter implements Filter {
        public function filter(array $places): array {
            // filter by distance

            return array();
        }
    }

    class MapsApp {
        private Filter $filter;

        public function setFilter(Filter $filter): void {
            $this->filter = $filter;
        }

        public function filterPlaces(array $places): array {
            return $this->filter->filter($places);
        }
    }

    class Driver {
        public static function run(): void {
            $places = array();

            $maps = new MapsApp();

            $maps->setFilter(new PopularityFilter());

            $byPopularity = $maps->filterPlaces($places);

            $maps->setFilter(new DistanceFilter());

            $byDistance = $maps->filterPlaces($places);
        }
    }