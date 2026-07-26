<?php 
    require_once 'WeatherService.php';
    require_once 'ApiRequestService.php';

    class OpenWeatherService extends WeatherService {
        private ApiRequestService $httpReq;
        private $placeLat;
        private $placeLon;
        private $apiKey;

        public function __construct($httpReq, $placeLat, $placeLon, $apiKey) {
            $this->httpReq = $httpReq;

            $this->placeLat = urlencode($placeLat);

            $this->placeLon = urlencode($placeLon);

            $this->apiKey = $apiKey;
        }

        public function getWeather(string $wParam = 'allw',  int $utcOffsetSeconds = 0): array {
            $apiUrl = $this->makeUrl(
                $this->placeLat,
                $this->placeLon,
                $this->apiKey
            );

            $apiResAr = $this->httpReq->makeRequest($apiUrl);

            //get current weather block
            $curWeatherAr = ($wParam == 'allw' || $wParam == 'cw')
                ? $this->getCurrentWeather($apiResAr['list'][0])
                : ''; 

            //get next day weather block
            $nextDayWeatherAr = ($wParam == 'allw' || $wParam == 'ndw')
                ? $this->getNextDayWeather($apiResAr['list'], $utcOffsetSeconds)
                : '';
            
            $keyName = 'openWeather';

            $finalWeather = [
                $keyName => [
                    'current' => $curWeatherAr,
                    'nextDay' => $nextDayWeatherAr
                ]
            ];

            return $finalWeather;
        }

        private function makeUrl($placeLat, $placeLon, $apiKey) {
            $placeLat = urlencode($placeLat);

            $placeLon = urlencode($placeLon);

            return "https://api.openweathermap.org/data/2.5/forecast?lat=$placeLat&lon=$placeLon&appid=$apiKey&units=metric";
        }

        private function getCurrentWeather($array) {
            if(!is_array($array)) return '';

            [$curTemp, $curPrecip] = $this->paramSetter($array);

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

            $tomorrowLocalDate = (new DateTimeImmutable('now', $utc))
                ->modify("+{$utcOffsetSeconds} seconds")
                ->modify('+1 day')
                ->format('Y-m-d');

            foreach($array as $time) {     
                $dateCur = (new DateTimeImmutable($time['dt_txt'], $utc))
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
                    [$curTemp, $curPrecip] = $this->paramSetter($time);

                    $nextDayAr[$hour]['temp'] = $curTemp;
                    $nextDayAr[$hour]['precip'] = $curPrecip;
                }
            }

            return $nextDayAr;
        }

        private function paramSetter($array) {
            $curTemp = '';
            $curPrecip = '';

            foreach($array as $key => $params) {
                if($key == 'main' && isset($params['temp']) && is_numeric($params['temp'])) {
                    $curTemp = round($params['temp']);
                }

                if($key == 'weather' && isset($params[0]['description'])) {
                    $curPrecip = $params[0]['description'];
                }
            }

            return [$curTemp, $curPrecip];
        }
    }
