<?php
    class FinalMessageService {

        public static function getMessage($place, $arWeather, WeatherDictionary $wDictClass, $lang = 'en'): string {
            $today = date('d-m-Y H:i:s');

            $textHolder = $wDictClass->getHolderDict();

            $finalStr = "
                ============WEATHER RESULT============
                {$textHolder['place'][$lang]}: $place \n
                {$textHolder['today'][$lang]}: $today \n
            ";

            $apiNamesDictionary = $wDictClass->getApiNamesDict();

            $wDict = $wDictClass->getWeatherDict();

            $arAvgDataAndApiNames = self::getAvgDataAndApiNames(
                $arWeather, 
                $lang, 
                $textHolder, 
                $apiNamesDictionary,
                $wDict
            );

            //if no data from API
            if(empty($arAvgDataAndApiNames['arAvgData'])) {
                return $textHolder['noData'][$lang];
            }

            //add api names in msg
            $apiNamesStr = implode(', ', $arAvgDataAndApiNames['arApiNames']);
            $finalStr .= "API: $apiNamesStr\n";

            //average block
            $finalStr .= self::getAvgDataStr($arAvgDataAndApiNames['arAvgData'], $lang, $textHolder);

            //REMOVE ALL ODD " " for each line
            $finalStr = preg_replace('/^[ \t]+/m', '', $finalStr);

            return $finalStr;
        }  
        
        private static function getAvgDataAndApiNames(
            $arWeather, 
            $lang, 
            $textHolder, 
            $apiNamesDictionary,
            $wDict
        ): array {
            $arAvgData = [];
            $arApiNames = [];

            foreach($arWeather as $weather) {
                foreach($weather as $apiName => $data) {

                    if(empty($data) || $data == '') {
                        continue;
                    }

                    $arApiNames[] = $apiNamesDictionary[$apiName] ?? $textHolder['noData'][$lang];

                    foreach($data as $keyW => $wDetails) {
                        //CURRENT BLOCK
                        if(
                            $keyW == 'current' && !empty($wDetails)
                            && $wDetails['temp'] != '' 
                            && $wDetails['precip'] != ''
                        ) {
                            $temp = (int)$wDetails['temp'];

                            $precip = self::getPrecipValue($wDetails['precip'], $lang, $wDict);
                            $precip = ($precip == '') ? $textHolder['unExistKeyPrecip'][$lang] : $precip;

                            //FILL UP ARRAY FOR AVERAGE
                            $arAvgData[$keyW]['source'] = ($arAvgData[$keyW]['source'] ?? 0) + 1; 
                            $arAvgData[$keyW]['tempSum'] = ($arAvgData[$keyW]['tempSum'] ?? 0) + $temp; 
                            $arAvgData[$keyW]['weather'][$precip] = ($arAvgData[$keyW]['weather'][$precip] ?? 0) + 1; 
                        } 
                        //NEXT DAY BLOCK
                        if(
                            $keyW == 'nextDay' 
                            && is_array($wDetails) 
                            && !empty($wDetails)
                        ) {
                            foreach($wDetails as $time => $details) {

                                if($details['temp'] == '' || $details['precip'] == '') continue;

                                $temp = (int)$details['temp'];

                                $precip = self::getPrecipValue($details['precip'], $lang, $wDict);
                                $precip = ($precip == '') ? $textHolder['unExistKeyPrecip'][$lang] : $precip;

                                //FILL UP ARRAY FOR AVERAGE
                                $arAvgData[$keyW][$time]['source'] = ($arAvgData[$keyW][$time]['source'] ?? 0) + 1; 
                                $arAvgData[$keyW][$time]['tempSum'] = ($arAvgData[$keyW][$time]['tempSum'] ?? 0) + $temp; 
                                $arAvgData[$keyW][$time]['weather'][$precip] = ($arAvgData[$keyW][$time]['weather'][$precip] ?? 0) + 1;
                            }
                        }
                    }
                }
            }

            return [
                'arAvgData' => $arAvgData,
                'arApiNames' => $arApiNames,
            ];
        } 

        private static function getPrecipValue($apiPrecip, $lang, $dict) {

            foreach($dict as $dictKey => $data) {

                if(in_array(strtolower($apiPrecip), $data['values'])) {
                    return $dict[$dictKey][$lang] ?? '';
                }
            }
        }

        private static function getAvgDataStr($arAvgData, $lang, $textHolder): string {
            if((is_array($arAvgData) && empty($arAvgData)) || !is_array($arAvgData)) return '';

            $avgStr = "
                ===================
                    {$textHolder['sumResult'][$lang]}
                ===================";

            //CURRENT BLOCK
            if(isset($arAvgData['current'])) {
                //AVERAGE CURRENT TEMPERATURE
                $avgTemp = self::getAvgTemp($arAvgData['current']['source'], $arAvgData['current']['tempSum']);

                //AVERAGE CURRENT PRECIP
                $avgPrecipStr = self::getPrecipPercStr(
                    $arAvgData['current']['source'], 
                    $arAvgData['current']['weather'], 
                    $textHolder['unExistKeyPrecip'][$lang]
                );

                //TEXT BLOCK
                $avgStr .= "
                    [{$textHolder['now'][$lang]}]\n
                    {$textHolder['temp'][$lang]}: $avgTemp °C\n
                    {$textHolder['weather'][$lang]}:
                ";
                $avgStr .= $avgPrecipStr;
            }

            //NEXT DAY BLOCK
            if(isset($arAvgData['nextDay'])) {
                $avgStr .= "\n[{$textHolder['tomorrow'][$lang]}]";

                foreach($arAvgData['nextDay'] as $time => $value) {
                    //AVERAGE TIME TEMPERATURE
                    $avgTemp = self::getAvgTemp($value['source'], $value['tempSum']);

                    //AVERAGE TIME PRECIP
                    $avgPrecipStr = self::getPrecipPercStr(
                        $value['source'], 
                        $value['weather'], 
                        $textHolder['unExistKeyPrecip'][$lang]
                    );

                    $timeStr = $time . ":00";
                    //TEXT BLOCK
                    $avgStr .= "
                        $timeStr
                        {$textHolder['avgTemp'][$lang]}: $avgTemp °C\n
                        $avgPrecipStr";
                }
            }

            return $avgStr;
        }

        private static function getAvgTemp($sourceCounter, $tempSum) {
            return round($tempSum / $sourceCounter);
        }

        private static function getPrecipPercStr($sourceCounter, $precipData, $unExistKeyPrecip) {
            $percPerSource = round(100 / $sourceCounter);

            $str = '';

            foreach($precipData as $key => $value) {
                if($key == $unExistKeyPrecip) continue;

                $perc = $value * $percPerSource;

                $str .= $key . " - " . $perc . "%\n";
            }

            return $str;
        }

    }