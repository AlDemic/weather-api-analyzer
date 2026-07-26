<?php 
    require_once 'WeatherService.php';
    require_once 'ApiRequestService.php';

    class OpenMeteoService extends WeatherService {
        private ApiRequestService $httpReq;
        private $placeLat;
        private $placeLon;

        public function __construct($httpReq, $placeLat, $placeLon) {
            $this->httpReq = $httpReq;

            $this->placeLat = urlencode($placeLat);

            $this->placeLon = urlencode($placeLon);
        }

        public function getWeather(string $wParam = 'allw',  int $utcOffsetSeconds = 0): array {
            $apiUrl = $this->makeUrl(
                $this->placeLat,
                $this->placeLon
            );

            $apiResAr = $this->httpReq->makeRequest($apiUrl);

            //get current weather block
            $curWeatherAr = ($wParam == 'allw' || $wParam == 'cw')
                ? $this->getCurrentWeather($apiResAr['current'])
                : ''; 

            //get next day weather block
            $nextDayWeatherAr = ($wParam == 'allw' || $wParam == 'ndw')
                ? $this->getNextDayWeather($apiResAr['hourly'], $utcOffsetSeconds)
                : '';
            
            $keyName = 'openMeteo';

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

            return "https://api.open-meteo.com/v1/forecast?latitude=$placeLat&longitude=$placeLon&hourly=weather_code,temperature_2m&current=temperature_2m,weather_code&timezone=auto&forecast_days=2";
        }

        private function getCurrentWeather($array) {
            if(!is_array($array)) return '';

            $temp = $array['temperature_2m'] ?? null;

            $curTemp = is_numeric($temp) ? round($temp) : '';

            $curPrecip = $this->precipCode($array['weather_code']);

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
            
            $count = count($array['time']);
            for($i = 0; $i < $count; $i++) {
                $dateCur = new DateTimeImmutable($array['time'][$i]);

                $hour = $dateCur->format('H');

                //take 09:00, 12:00, 15:00, 18:00
                if(
                    $hour == '09'
                    || $hour == '12'
                    || $hour == '15'
                    || $hour == '18'
                ) {
                    $temp = $array['temperature_2m'][$i] ?? null;

                    $nextDayAr[$hour]['temp'] = is_numeric($temp) ? round($temp) : '';

                    $nextDayAr[$hour]['precip'] = is_numeric($array['weather_code'][$i])
                        ? $this->precipCode((int)$array['weather_code'][$i]) 
                        : '';
                }
            }

            return $nextDayAr;
        }

        private function precipCode(int $code) {
            $codeAr = [
                0 => 'Clear sky',
                1 => 'Mainly clear',
                2 => 'Partly cloudy',
                3 => 'Overcast',
                45 => 'Fog',
                48 => 'Depositing rime fog',
                51 => 'Drizzle light',
                53 => 'Drizzle moderate',
                55 => 'Drizzle dense intensity',
                56 => 'Freezing drizzle (light)',
                57 => 'Freezing drizzle (dense intensity)',
                61 => 'Rain (slight)',
                63 => 'Rain (moderate)',
                65 => 'Rain (heavy intensity)',
                66 => 'Freezing rain (slight)',
                67 => 'Freezing rain (heavy intensity)',
                71 => 'Snow fall (slight)',
                73 => 'Snow fall (moderate)',
                75 => 'Snow fall (heavy intensity)',
                77 => 'Snow grains',
                80 => 'Rain showers (slight)',
                81 => 'Rain showers (moderate)',
                82 => 'Rain showers (violent)',
                85 => 'Snow showers (slight)',
                86 => 'Snow showers (heavy)',
                95 => 'Thunderstorm (slight or moderate)',
                96 => 'Thunderstorm with slight and heavy hail',
                99 => 'Thunderstorm with slight and heavy hail',
            ];

            if(!key_exists($code, $codeAr)) return '';

            return $codeAr[$code];
        }
    }
