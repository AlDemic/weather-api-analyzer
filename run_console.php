<?php
    require_once __DIR__ . '/Params.php';
    require_once __DIR__ . '/WeatherController.php';
    require_once __DIR__ . '/dict/RunDictionary.php';
    require_once __DIR__ . '/services/ErrorLogService.php';

    $commandSave = 0;
    $commandWeather = '';
    $weatherPlace = '';

    $params = new Params();
    $progLang = $params->getLang();

    $arCommands = RunDictionary::getArCommands();

    $arHolders = RunDictionary::getArHolders();

    while(true) {
        try {
            //ENTER WEATHER CHOICE BLOCK
            echo "{$arHolders['enterText'][$progLang]}:\n\n";

            foreach($arCommands as $key => $value) {
                echo $key . " => " . $value['desc'][$progLang] . "\n";
            }

            echo "{$arHolders['exitText'][$progLang]}:\n\n";

            $isWeathComOk = false;
            while(!$isWeathComOk) {
                echo $arHolders['enterNumberText'][$progLang] . "\n";
                $commandWeather = readline();

                if(
                    $commandWeather == 0
                    || $commandWeather == 1
                    || $commandWeather == 2
                    || $commandWeather == 3
                ) $isWeathComOk = true;
            }

            if($commandWeather == 0) exit;

            //ENTER PLACE NAME BLOCK
            echo "\n" . $arHolders['enterPlaceText'][$progLang] . "\n\n";

            echo "{$arHolders['exitText'][$progLang]}:\n\n";

            $isPlaceOk = false;
            while(!$isPlaceOk) {

                $weatherPlace = readline();
                $weatherPlace = trim($weatherPlace);
                if(
                    $weatherPlace == 0
                    || $weatherPlace !== ''
                ) $isPlaceOk = true;
            }
                
            if($weatherPlace == 0) exit; //if exit

            //ENTER HOW TO SAVE BLOCK
            echo "\n" . $arHolders['enterSaveResult'][$progLang] . "\n";

            echo "{$arHolders['exitText'][$progLang]}:\n\n";

            $isSaveOk = false;
            while(!$isSaveOk) {
                echo $arHolders['enterNumberText'][$progLang] . "\n";

                $commandSave = readline();
                if(
                    $commandSave == 0
                    || $commandSave == 1
                    || $commandSave == 2
                    || $commandSave == 3
                ) $isSaveOk = true;
            }
                
            if($commandSave == 0) exit; //if exit

            $weatherController = new WeatherController();

            //service accept commands without "/"
            switch($commandSave) {
                case 1:
                    $result = $weatherController->getWeatherMsg($params, $weatherPlace, $arCommands[$commandWeather]['command']);
                    echo $result;
                    break;
                case 2:
                    $result = $weatherController->getWeatherMsg($params, $weatherPlace, $arCommands[$commandWeather]['command'], true);
                    break;
                case 3:
                    $result = $weatherController->getWeatherMsg($params, $weatherPlace, $arCommands[$commandWeather]['command'], true);
                    echo $result;
                    break;
            }
        } catch(Throwable $e) {
            ErrorLogService::writeErrorLog($e->getMessage());
            sleep(3);
        }
    }

