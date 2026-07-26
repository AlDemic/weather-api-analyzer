<?php 
    require_once 'WeatherService.php';
    require_once 'ApiRequestService.php';

    class WeatherApiService extends WeatherService {
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
                ? $this->getCurrentWeather($apiResAr['current'])
                : ''; 

            $utcOffsetSeconds = $apiResAr['city']['timezone'] ?? $utcOffsetSeconds;

            //get next day weather block
            $nextDayWeatherAr = ($wParam == 'allw' || $wParam == 'ndw')
                ? $this->getNextDayWeather($apiResAr['forecast']['forecastday'][1]['hour'], $utcOffsetSeconds)
                : '';
            
            $keyName = 'weatherApi';

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

            return "https://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$placeLat,$placeLon&days=2&aqi=no&alerts=no";
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

            foreach($array as $hourData) {
                $dateCur = new DateTimeImmutable($hourData['time']);
                $hour = $dateCur->format('H');

                //take 09:00, 12:00, 15:00, 18:00
                if(
                    $hour == '09' 
                    || $hour == '12' 
                    || $hour == '15' 
                    || $hour == '18'
                ) {
                    [$curTemp, $curPrecip] = $this->paramSetter($hourData);

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
                if($key == 'temp_c' && is_numeric($value)) {
                    $curTemp = round($value);
                }

                if($key == 'condition' && isset($value['text'])) {
                    $curPrecip = $value['text'];
                }
            }

            return [$curTemp, $curPrecip];
        }
    }
