<?php 
    final class WeatherDictionary {

        public static function getHolderDict() {
            return [
                'place' => [
                    'ru' => 'Место',
                    'en' => 'Place',
                ],
                'today' => [
                    'ru' => 'Сегодня',
                    'en' => 'Today',
                ],
                'now' => [
                    'ru' => 'Сейчас',
                    'en' => 'Now',
                ],
                'temp' => [
                    'ru' => 'Температура',
                    'en' => 'Temperature',
                ],
                'avgTemp' => [
                    'ru' => 'Средняя температура',
                    'en' => 'Average temperature',
                ],
                'tomorrow' => [
                    'ru' => 'Завтра',
                    'en' => 'Tomorrow',
                ],
                'weather' => [
                    'ru' => 'Погода',
                    'en' => 'Weather',
                ],
                'accord' => [
                    'ru' => 'На основании',
                    'en' => 'According',
                ],
                'source' => [
                    'ru' => 'Источника(ов)',
                    'en' => 'Source(es)',
                ],
                'noData' => [
                    'ru' => 'Отсутствуют данные',
                    'en' => 'No data',
                ],
                'unExistKeyPrecip' => [
                    'ru' => 'Отсутствует в словаре',
                    'en' => 'Unexist in dictionary'
                ],
                'sumResult' => [
                    'ru' => 'Итоговый вывод',
                    'en' => 'Final result'
                ],
                'notFoundPlaceMsg' => [
                    'ru' => 'место не найдено',
                    'en' => 'place not found',
                ],
            ];
        }

        public static function getApiNamesDict() {
            return [
                'openMeteo' => 'Open Meteo',
                'openWeather' => 'Open Weather',
                'weatherApi' => 'Weather API',
                'meteoInst' => 'Norway Meteo Institute'
            ];
        }

        public static function getWeatherDict() {
            return [
                'clear' => [
                    'ru' => 'Ясно',
                    'en' => 'Clear',
                    'values' => [
                        'clear sky',
                        'clearsky',
                        'fair',
                        'sunny',
                        'clear',
                    ]
                ],
                'mostly_clear' => [
                    'ru' => 'Преимущественно ясно',
                    'en' => 'Mostly clear',
                    'values' => [
                        'mainly clear',
                    ]
                ],
                'partly_cloudy' => [
                    'ru' => 'Переменная облачность',
                    'en' => 'Partly cloudy',
                    'values' => [
                        'partly cloudy',
                        'partlycloudy',
                        'few clouds',
                        'scattered clouds',
                    ]
                ],
                'cloudy' => [
                    'ru' => 'Облачно',
                    'en' => 'Cloudy',
                    'values' => [
                        'cloudy',
                        'broken clouds',
                    ]
                ],
                'overcast' => [
                    'ru' => 'Пасмурно',
                    'en' => 'Overcast',
                    'values' => [
                        'overcast',
                        'overcast clouds',
                    ]
                ],
                'fog' => [
                    'ru' => 'Туман',
                    'en' => 'Fog',
                    'values' => [
                        'fog',
                    ]
                ],
                'freezing_fog' => [
                    'ru' => 'Ледяной туман',
                    'en' => 'Freezing fog',
                    'values' => [
                        'freezing fog',
                    ]
                ],
                'rime_fog' => [
                    'ru' => 'Изморозь',
                    'en' => 'Rime fog',
                    'values' => [
                        'depositing rime fog',
                    ]
                ],
                'haze' => [
                    'ru' => 'Дымка',
                    'en' => 'Haze',
                    'values' => [
                        'dust haze',
                        'haze',
                        'smoky haze',
                    ]
                ],
                'smoke' => [
                    'ru' => 'Дым',
                    'en' => 'Smoke',
                    'values' => [
                        'severe smog',
                        'smog',
                        'smoke',
                    ]
                ],
                'dust' => [
                    'ru' => 'Пыль',
                    'en' => 'Dust',
                    'values' => [
                        'blowing dust',
                        'dust',
                        'saharan dust',
                        'sand',
                        'sand/dust whirls',
                    ]
                ],
                'sandstorm' => [
                    'ru' => 'Песчаная буря',
                    'en' => 'Sandstorm',
                    'values' => [
                        'dust storm',
                        'sandstorm',
                        'severe sandstorm',
                    ]
                ],
                'mist' => [
                    'ru' => 'Мгла',
                    'en' => 'Mist',
                    'values' => [
                        'mist',
                    ]
                ],
                'volcanic_ash' => [
                    'ru' => 'Вулканический пепел',
                    'en' => 'Volcanic ash',
                    'values' => [
                        'volcanic ash',
                    ]
                ],
                'squalls' => [
                    'ru' => 'Шквалы',
                    'en' => 'Squalls',
                    'values' => [
                        'squalls',
                    ]
                ],
                'tornado' => [
                    'ru' => 'Торнадо',
                    'en' => 'Tornado',
                    'values' => [
                        'tornado',
                    ]
                ],
                'drizzle' => [
                    'ru' => 'Морось',
                    'en' => 'Drizzle',
                    'values' => [
                        'drizzle',
                        'drizzle dense intensity',
                        'drizzle light',
                        'drizzle moderate',
                        'drizzle rain',
                        'heavy intensity drizzle',
                        'heavy intensity drizzle rain',
                        'heavy shower rain and drizzle',
                        'light drizzle',
                        'light intensity drizzle',
                        'light intensity drizzle rain',
                        'patchy light drizzle',
                        'shower drizzle',
                        'shower rain and drizzle',
                    ]
                ],
                'freezing_drizzle' => [
                    'ru' => 'Ледяная морось',
                    'en' => 'Freezing drizzle',
                    'values' => [
                        'freezing drizzle',
                        'freezing drizzle (dense intensity)',
                        'freezing drizzle (light)',
                        'heavy freezing drizzle',
                        'patchy freezing drizzle nearby',
                    ]
                ],
                'rain' => [
                    'ru' => 'Дождь',
                    'en' => 'Rain',
                    'values' => [
                        'patchy rain nearby',
                        'rain',
                    ]
                ],
                'light_rain' => [
                    'ru' => 'Небольшой дождь',
                    'en' => 'Light rain',
                    'values' => [
                        'light rain',
                        'lightrain',
                        'patchy light rain',
                        'rain (slight)',
                    ]
                ],
                'moderate_rain' => [
                    'ru' => 'Умеренный дождь',
                    'en' => 'Moderate rain',
                    'values' => [
                        'moderate rain',
                        'moderate rain at times',
                        'rain (moderate)',
                    ]
                ],
                'heavy_rain' => [
                    'ru' => 'Сильный дождь',
                    'en' => 'Heavy rain',
                    'values' => [
                        'extreme rain',
                        'heavy intensity rain',
                        'heavy rain',
                        'heavy rain at times',
                        'heavyrain',
                        'rain (heavy intensity)',
                        'very heavy rain',
                    ]
                ],
                'freezing_rain' => [
                    'ru' => 'Ледяной дождь',
                    'en' => 'Freezing rain',
                    'values' => [
                        'freezing rain',
                        'freezing rain (heavy intensity)',
                        'freezing rain (slight)',
                        'light freezing rain',
                        'moderate or heavy freezing rain',
                    ]
                ],
                'light_rain_shower' => [
                    'ru' => 'Небольшой ливень',
                    'en' => 'Light rain shower',
                    'values' => [
                        'light intensity shower rain',
                        'light rain shower',
                        'lightrainshowers',
                        'rain showers (slight)',
                        'shower rain',
                    ]
                ],
                'moderate_rain_shower' => [
                    'ru' => 'Умеренный ливень',
                    'en' => 'Moderate rain shower',
                    'values' => [
                        'moderate or heavy rain shower',
                        'rain showers (moderate)',
                        'rainshowers',
                    ]
                ],
                'heavy_rain_shower' => [
                    'ru' => 'Сильный ливень',
                    'en' => 'Heavy rain shower',
                    'values' => [
                        'heavy intensity shower rain',
                        'heavyrainshowers',
                        'ragged shower rain',
                        'rain showers (violent)',
                        'torrential rain shower',
                    ]
                ],
                'sleet' => [
                    'ru' => 'Мокрый снег',
                    'en' => 'Sleet',
                    'values' => [
                        'light rain and snow',
                        'rain and snow',
                        'sleet',
                    ]
                ],
                'light_sleet' => [
                    'ru' => 'Небольшой мокрый снег',
                    'en' => 'Light sleet',
                    'values' => [
                        'light sleet',
                        'lightsleet',
                        'patchy sleet nearby',
                    ]
                ],
                'heavy_sleet' => [
                    'ru' => 'Сильный мокрый снег',
                    'en' => 'Heavy sleet',
                    'values' => [
                        'heavysleet',
                        'moderate or heavy sleet',
                    ]
                ],
                'light_sleet_shower' => [
                    'ru' => 'Небольшой ливень с мокрым снегом',
                    'en' => 'Light sleet shower',
                    'values' => [
                        'light shower sleet',
                        'light sleet showers',
                        'lightsleetshowers',
                    ]
                ],
                'moderate_sleet_shower' => [
                    'ru' => 'Умеренный ливень с мокрым снегом',
                    'en' => 'Moderate sleet shower',
                    'values' => [
                        'heavysleetshowers',
                        'moderate or heavy sleet showers',
                        'shower sleet',
                        'sleetshowers',
                    ]
                ],
                'snow' => [
                    'ru' => 'Снег',
                    'en' => 'Snow',
                    'values' => [
                        'patchy snow nearby',
                    ]
                ],
                'light_snow' => [
                    'ru' => 'Небольшой снег',
                    'en' => 'Light snow',
                    'values' => [
                        'light snow',
                        'lightsnow',
                        'patchy light snow',
                        'snow',
                        'snow fall (slight)',
                    ]
                ],
                'moderate_snow' => [
                    'ru' => 'Умеренный снег',
                    'en' => 'Moderate snow',
                    'values' => [
                        'moderate snow',
                        'patchy moderate snow',
                        'snow fall (moderate)',
                    ]
                ],
                'heavy_snow' => [
                    'ru' => 'Сильный снег',
                    'en' => 'Heavy snow',
                    'values' => [
                        'heavy snow',
                        'heavysnow',
                        'patchy heavy snow',
                        'snow fall (heavy intensity)',
                    ]
                ],
                'light_snow_shower' => [
                    'ru' => 'Небольшой снегопад',
                    'en' => 'Light snow shower',
                    'values' => [
                        'light shower snow',
                        'light snow showers',
                        'lightsnowshowers',
                        'snow showers (slight)',
                    ]
                ],
                'moderate_snow_shower' => [
                    'ru' => 'Умеренный снегопад',
                    'en' => 'Moderate snow shower',
                    'values' => [
                        'moderate or heavy snow showers',
                        'shower snow',
                        'snowshowers',
                    ]
                ],
                'heavy_snow_shower' => [
                    'ru' => 'Сильный снегопад',
                    'en' => 'Heavy snow shower',
                    'values' => [
                        'heavy shower snow',
                        'heavysnowshowers',
                        'snow showers (heavy)',
                    ]
                ],
                'snow_grains' => [
                    'ru' => 'Снежная крупа',
                    'en' => 'Snow grains',
                    'values' => [
                        'snow grains',
                    ]
                ],
                'ice_pellets' => [
                    'ru' => 'Ледяные гранулы',
                    'en' => 'Ice pellets',
                    'values' => [
                        'ice pellets',
                    ]
                ],
                'light_ice_pellets_shower' => [
                    'ru' => 'Небольшой ливень из ледяных гранул',
                    'en' => 'Light showers of ice pellets',
                    'values' => [
                        'light showers of ice pellets',
                    ]
                ],
                'moderate_ice_pellets_shower' => [
                    'ru' => 'Умеренный ливень из ледяных гранул',
                    'en' => 'Moderate showers of ice pellets',
                    'values' => [
                        'moderate or heavy showers of ice pellets',
                    ]
                ],
                'blizzard' => [
                    'ru' => 'Метель',
                    'en' => 'Blizzard',
                    'values' => [
                        'blizzard',
                    ]
                ],
                'blowing_snow' => [
                    'ru' => 'Позёмок',
                    'en' => 'Blowing snow',
                    'values' => [
                        'blowing snow',
                    ]
                ],
                'thunderstorm' => [
                    'ru' => 'Гроза',
                    'en' => 'Thunderstorm',
                    'values' => [
                        'thunderstorm',
                        'thunderstorm (slight or moderate)',
                        'thunderstorm with slight and heavy hail',
                        'thundery outbreaks in nearby',
                        'ragged thunderstorm',
                    ]
                ],
                'thunderstorm_light' => [
                    'ru' => 'Слабая гроза',
                    'en' => 'Light thunderstorm',
                    'values' => [
                        'light thunderstorm',
                    ]
                ],
                'thunderstorm_heavy' => [
                    'ru' => 'Сильная гроза',
                    'en' => 'Heavy thunderstorm',
                    'values' => [
                        'heavy thunderstorm',
                    ]
                ],
                'thunderstorm_rain' => [
                    'ru' => 'Гроза с дождём',
                    'en' => 'Thunderstorm with rain',
                    'values' => [
                        'moderate or heavy rain in area with thunder',
                        'rainandthunder',
                        'thunderstorm with rain',
                    ]
                ],
                'thunderstorm_light_rain' => [
                    'ru' => 'Гроза с небольшим дождём',
                    'en' => 'Thunderstorm with light rain',
                    'values' => [
                        'lightrainandthunder',
                        'patchy light rain in area with thunder',
                        'thunderstorm with light rain',
                    ]
                ],
                'thunderstorm_heavy_rain' => [
                    'ru' => 'Гроза с сильным дождём',
                    'en' => 'Thunderstorm with heavy rain',
                    'values' => [
                        'heavyrainandthunder',
                        'thunderstorm with heavy rain',
                    ]
                ],
                'thunderstorm_drizzle' => [
                    'ru' => 'Гроза с моросью',
                    'en' => 'Thunderstorm with drizzle',
                    'values' => [
                        'thunderstorm with drizzle',
                    ]
                ],
                'thunderstorm_light_drizzle' => [
                    'ru' => 'Гроза с небольшой моросью',
                    'en' => 'Thunderstorm with light drizzle',
                    'values' => [
                        'thunderstorm with light drizzle',
                    ]
                ],
                'thunderstorm_heavy_drizzle' => [
                    'ru' => 'Гроза с сильной моросью',
                    'en' => 'Thunderstorm with heavy drizzle',
                    'values' => [
                        'thunderstorm with heavy drizzle',
                    ]
                ],
                'thunderstorm_rain_shower' => [
                    'ru' => 'Гроза с ливнем',
                    'en' => 'Thunderstorm with rain shower',
                    'values' => [
                        'rainshowersandthunder',
                    ]
                ],
                'thunderstorm_heavy_rain_shower' => [
                    'ru' => 'Гроза с сильным ливнем',
                    'en' => 'Thunderstorm with heavy rain shower',
                    'values' => [
                        'heavyrainshowersandthunder',
                    ]
                ],
                'thunderstorm_sleet' => [
                    'ru' => 'Гроза с мокрым снегом',
                    'en' => 'Thunderstorm with sleet',
                    'values' => [
                        'sleetandthunder',
                    ]
                ],
                'thunderstorm_light_sleet' => [
                    'ru' => 'Гроза с небольшим мокрым снегом',
                    'en' => 'Thunderstorm with light sleet',
                    'values' => [
                        'lightsleetandthunder',
                    ]
                ],
                'thunderstorm_heavy_sleet' => [
                    'ru' => 'Гроза с сильным мокрым снегом',
                    'en' => 'Thunderstorm with heavy sleet',
                    'values' => [
                        'heavysleetandthunder',
                    ]
                ],
                'thunderstorm_snow' => [
                    'ru' => 'Гроза со снегом',
                    'en' => 'Thunderstorm with snow',
                    'values' => [
                        'moderate or heavy snow in area with thunder',
                        'snowandthunder',
                    ]
                ],
                'thunderstorm_light_snow' => [
                    'ru' => 'Гроза с небольшим снегом',
                    'en' => 'Thunderstorm with light snow',
                    'values' => [
                        'lightsnowandthunder',
                        'patchy light snow in area with thunder',
                    ]
                ],
                'thunderstorm_heavy_snow' => [
                    'ru' => 'Гроза с сильным снегом',
                    'en' => 'Thunderstorm with heavy snow',
                    'values' => [
                        'heavysnowandthunder',
                    ]
                ],
                'thunderstorm_sleet_shower' => [
                    'ru' => 'Гроза с ливнем мокрого снега',
                    'en' => 'Thunderstorm with sleet shower',
                    'values' => [
                        'sleetshowersandthunder',
                    ]
                ],
                'thunderstorm_light_sleet_shower' => [
                    'ru' => 'Гроза с небольшим ливнем мокрого снега',
                    'en' => 'Thunderstorm with light sleet shower',
                    'values' => [
                        'lightssleetshowersandthunder',
                    ]
                ],
                'thunderstorm_heavy_sleet_shower' => [
                    'ru' => 'Гроза с сильным ливнем мокрого снега',
                    'en' => 'Thunderstorm with heavy sleet shower',
                    'values' => [
                        'heavysleetshowersandthunder',
                    ]
                ],
                'thunderstorm_snow_shower' => [
                    'ru' => 'Гроза со снегопадом',
                    'en' => 'Thunderstorm with snow shower',
                    'values' => [
                        'snowshowersandthunder',
                    ]
                ],
                'thunderstorm_light_snow_shower' => [
                    'ru' => 'Гроза с небольшим снегопадом',
                    'en' => 'Thunderstorm with light snow shower',
                    'values' => [
                        'lightssnowshowersandthunder',
                    ]
                ],
                'thunderstorm_heavy_snow_shower' => [
                    'ru' => 'Гроза с сильным снегопадом',
                    'en' => 'Thunderstorm with heavy snow shower',
                    'values' => [
                        'heavysnowshowersandthunder',
                    ]
                ],
            ];
        }
 }