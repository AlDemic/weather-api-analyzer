<?php 
    /*
        $wParam - selector to take weather info:
        allw -> weather all - take all
        cw -> current weather - take only current 
        ndw -> next day weather - take only next day 
    */
    abstract class WeatherService {
        abstract public function getWeather(string $wParam, int $utcOffsetSeconds): array;
    }