<?php 
    // weather controller
    require_once __DIR__ . '/Params.php';
    require_once __DIR__ . '/dict/WeatherDictionary.php';
    require_once __DIR__ . '/services/ApiRequestService.php';
    require_once __DIR__ . '/services/PlaceService.php';
    require_once __DIR__ . '/services/OpenMeteoService.php';
    require_once __DIR__ . '/services/OpenWeatherService.php';
    require_once __DIR__ . '/services/WeatherApiService.php';
    require_once __DIR__ . '/services/MeteoInstService.php';
    require_once __DIR__ . '/services/FinalMessageService.php';
    require_once __DIR__ . '/services/TimezoneService.php';


    class WeatherController {

        public function getWeatherMsg(Params $params, $placeName, $wParam, $needJson = false) {

            $httpReq = new ApiRequestService();
                
            $place = new PlaceService();

            $wDictClass = new WeatherDictionary();
                
            $placeUrl = $place->getUrl($placeName);

            $placeArray = $httpReq->makeRequest($placeUrl);

            //coordinates
            $placeLat = $placeArray[0]['lat'] ?? '';
            $placeLon = $placeArray[0]['lon'] ?? '';

            if($placeLat == '' || $placeLon == '') {
                return $wDictClass::getHolderDict()['notFoundPlaceMsg'][$params::getLang()];
            }

            //get utc seconds to fix UTC 0 difference
            $tzService = new TimezoneService($httpReq);
            $utcOffsetSeconds = $tzService->getUtcOffsetSeconds($placeLat, $placeLon);

            //get api weather array
            $apiWeatherAr = self::getApiWeatherArray(
                $params,
                $httpReq,
                $placeLat,
                $placeLon,
                $wParam,
                $utcOffsetSeconds
            );

            if($needJson) {
                $time = date('Y-m-d_H-i-s');
                $file = __DIR__ . '/json_raw/' . $time . '.json';

                file_put_contents($file, json_encode($apiWeatherAr, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
            }

            //get final text
            $msgClass = new FinalMessageService();

            $finalMsgStr = $msgClass->getMessage($placeName, $apiWeatherAr, $wDictClass, $params::getLang());

            return $finalMsgStr;  
        }

        private function getApiWeatherArray(
            Params $params,
            ApiRequestService $httpReq,
            $placeLat,
            $placeLon,
            $wParam,
            $utcOffsetSeconds
        ): array {
            $apiWeatherAr = [];

            foreach($params::getList() as $param) {
                    
                $apiClass = isset($param['apiKey'])
                    ? new $param['class']($httpReq, $placeLat, $placeLon, $param['apiKey'])
                    : new $param['class']($httpReq, $placeLat, $placeLon);
                    
                $apiWeatherAr[] = $apiClass->getWeather($wParam, $utcOffsetSeconds);
            }
            
            return $apiWeatherAr;
        }
    }