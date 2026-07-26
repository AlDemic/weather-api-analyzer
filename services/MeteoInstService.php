<?php 
    require_once 'WeatherService.php';
    require_once 'ApiRequestService.php';

    class MeteoInstService extends WeatherService {
        private ApiRequestService $httpReq;
        private $placeLat;
        private $placeLon;

        public function __construct($httpReq, $placeLat, $placeLon) {
            $this->httpReq = $httpReq;

            $this->placeLat = urlencode($placeLat);

            $this->placeLon = urlencode($placeLon);
        }

        public function getWeather(string $wParam = 'allw', int $utcOffsetSeconds = 0): array {
            $apiUrl = $this->makeUrl(
                $this->placeLat,
                $this->placeLon
            );

            $apiResAr = $this->httpReq->makeRequest($apiUrl);

            //get current weather block
            $curWeatherAr = ($wParam == 'allw' || $wParam == 'cw')
                ? $this->getCurrentWeather($apiResAr['properties']['timeseries'][0])
                : ''; 

            //get next day weather block
            $nextDayWeatherAr = ($wParam == 'allw' || $wParam == 'ndw')
                ? $this->getNextDayWeather($apiResAr['properties']['timeseries'], $utcOffsetSeconds)
                : '';
            
            $keyName = 'meteoInst';

            $finalWeather = [
                $keyName => [
                    'current' => $curWeatherAr,
                    'nextDay' => $nextDayWeatherAr
                ]
            ];

            return $finalWeather;
        }

        private function makeUrl($placeLat, $placeLon) {
            $placeLat = urlencode($placeLat);

            $placeLon = urlencode($placeLon);

            return "https://api.met.no/weatherapi/locationforecast/2.0/compact.json?lat=$placeLat&lon=$placeLon";
        }

        private function getCurrentWeather($array) {
            if(!is_array($array)) return '';

            [$curTemp, $curPrecip] = $this->paramSetter($array['data']);

            return [
                'temp' => $curTemp,
                'precip' => $curPrecip
            ];
        }

        private function getNextDayWeather($array, $utcOffsetSeconds) {
            if(!is_array($array)) return '';

            $nextDayAr = [
                '09' => [
                    'temp' => '',
                    'precip' => ''
                ],
                '12' => [
                    'temp' => '',
                    'precip' => ''
                ],
                '15' => [
                    'temp' => '',
                    'precip' => ''
                ],
                '18' => [
                    'temp' => '',
                    'precip' => ''
                ],
            ];
            
            $utc = new DateTimeZone('UTC');

            //add utcoffset to equal correct
            $tomorrowLocalDate = (new DateTimeImmutable('now', $utc))
                ->modify("+{$utcOffsetSeconds} seconds")
                ->modify('+1 day')
                ->format('Y-m-d');

            $count = count($array);
            for($i = 0; $i < $count; $i++) {     
                $dateCur = (new DateTimeImmutable($array[$i]['time'], $utc))
                    ->modify("+{$utcOffsetSeconds} seconds");

                if($tomorrowLocalDate !== $dateCur->format('Y-m-d')) continue;
                
                $hour = $dateCur->format('H');

                //take 09:00, 12:00, 15:00, 18:00
                if(
                    $hour == '09' 
                    || $hour == '12' 
                    || $hour == '15' 
                    || $hour == '18'
                ) {
                    [$curTemp, $curPrecip] = $this->paramSetter($array[$i]['data']);

                    $nextDayAr[$hour]['temp'] = $curTemp;
                    $nextDayAr[$hour]['precip'] = $curPrecip;
                }
            } 

            return $nextDayAr;
        }

        private function paramSetter($array) {
            $curTemp = '';
            $curPrecip = '';

            foreach($array as $key => $value) {
                if($key == 'instant' && is_numeric($value['details']['air_temperature'])) {
                    $curTemp = round($value['details']['air_temperature']);
                }

                if($key == 'next_1_hours' && isset($value['summary']['symbol_code'])) {
                    $curPrecip = $value['summary']['symbol_code'];
                    $curPrecip = preg_replace('/_(day|night)$/', '', $curPrecip);
                }
            }

            return [$curTemp, $curPrecip];
        }
    }
