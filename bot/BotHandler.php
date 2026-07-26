<?php 
    require_once dirname(__DIR__, 1) . '/dict/RunDictionary.php';
    require_once dirname(__DIR__, 1) . '/WeatherController.php';
    require_once dirname(__DIR__, 1) . '/Params.php';

    final class BotHandler {
        public static function checkCommand($text): string {
            $text = trim($text);

            if($text == '') return ''; 

            $arText = self::arFromText($text);

            $command = substr($arText[0], 1);

            //send /start in bot
            if($command == 'start') {
                $tgMsg = self::getStartStr(
                    Params::getLang(),
                    RunDictionary::getArHolders(),
                );

                return $tgMsg;
            }

            //GET WEATHER COMMANDS LIST
            if($command == 'wc') {
                $tgMsg = self::getCommandList(
                    Params::getLang(),
                    RunDictionary::getArCommands(),
                    RunDictionary::getArHolders(),
                );

                return $tgMsg;
            }

            //WEATHER SERVICE COMMANDS
            $arCommands = [];
            foreach(RunDictionary::getArCommands() as $key => $value) {
                $arCommands[] = $value['command'];
            }

            if(in_array($command, $arCommands) && count($arText) > 1) {
                $params = new Params();

                $weatherController = new WeatherController();

                $place = self::arTextGetPlace($arText);

                $result = $weatherController->getWeatherMsg($params, $place, $command);

                return $result;
            }

            //if no have correct command
            return '';
        }

        private static function arFromText($text): array {
            $array = explode(" ", $text);

            return $array;
        }

        private static function arTextGetPlace($array): string {
            $place = implode(' ', array_slice($array, 1));

            return $place;
        }

        private static function getCommandList($lang, $arCommands, $arHolders): string {
            $text = "{$arHolders['tgShowCommandsText'][$lang]}:\n\n";

            foreach($arCommands as $key => $value) {
                $text .= "/" . $value['command'] . " " . $arHolders['enterPlaceText'][$lang] . " => " . $value['desc'][$lang] . "\n";
            }

            return $text;
        }

        //if send /start in bot
        private static function getStartStr($lang, $arHolders): string {
            return $arHolders['startBotCommandText'][$lang];
        }
    }