<?php 

    final class Params {
        //final text language => en/ru
        private const TEXT_LANG = 'en';

        //api keys
        private const OPEN_WEATHER_KEY = '76b2ac5e12995ba59fe5c8a93d4ab8cb';
        private const WEATHER_API_KEY = 'b6e7b5ca35664f739de163317261207';

        /*
            Which api in service
            status => on/off
        */
        private static $apiAr = [
            'openMeteo' => [
                'status' => 'on',
                'class' => OpenMeteoService::class
            ],
            'openWeather' => [
                'status' => 'on',
                'class' => OpenWeatherService::class,
                'apiKey' => self::OPEN_WEATHER_KEY
            ],
            'weatherApi' => [
                'status' => 'on',
                'class' => WeatherApiService::class,
                'apiKey' => self::WEATHER_API_KEY
            ],
            'meteoInst' => [
                'status' => 'on',
                'class' => MeteoInstService::class
            ],
        ];

        public static function getList(): array {
            return self::$apiAr;
        }

        public static function getLang(): string {
            return self::TEXT_LANG;
        }
    }