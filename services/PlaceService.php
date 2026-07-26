<?php 
    require_once dirname(__DIR__) . '/exceptions/PlaceException.php';

    class PlaceService {
        public function getUrl($place) {
            $place = urlencode($place);

            if($place === '') {
                throw new PlaceException('Place is empty');
            }

            $url = "https://nominatim.openstreetmap.org/search?q=$place&format=jsonv2&limit=1";

            return $url;
        } 
    }