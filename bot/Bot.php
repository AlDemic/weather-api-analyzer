<?php
    require_once dirname(__DIR__) . '/services/BotHttpRequestService.php';
    require_once __DIR__ . '/BotHandler.php';

    class Bot {
        private const API_KEY = 'TG BOT TOKEN HERE';

        private static function getUrl(string $method) {
            return "https://api.telegram.org/bot" . self::API_KEY . "/{$method}";
        }

        public static function getUpdate($offset, $timeout) {

            //check API KEY
            $isKeyChanged = self::isApiKeyChanged(self::API_KEY);
            if(!$isKeyChanged) {
                throw new RuntimeException('Set correct TG API KEY');
            }

            $getUrl = self::getUrl('getUpdates');

            $req = new BotHttpRequestService();

            $resAr = $req->makeRequest($getUrl, 'GET', "?offset=$offset&timeout=$timeout");

            if(!$resAr['ok'] || empty($resAr['result'])) {
                return $offset;
            }
            
            $botHandler = new BotHandler();

            foreach($resAr['result'] as $res) {
                $text = $res['message']['text'];

                $comRes = $botHandler->checkCommand($text);

                if($comRes !== '') {
                    //send to tg chat
                    self::sendMsg($req, $res['message']['chat']['id'], $comRes);
                }

                $offset = $res['update_id'] + 1;
            }
            
            return $offset;
        }

        private static function sendMsg(BotHttpRequestService $req, $chatId, $text) {
            $sendMsgUrl = self::getUrl('sendMessage');

            $req->makeRequest(
                $sendMsgUrl,
                'POST',
                '',
                [
                    'chat_id' => $chatId,
                    'text' => $text,
                ]
            );
        }

        private static function isApiKeyChanged($apiKey) {
            $apiKey = trim($apiKey);
            return ($apiKey !== 'TG BOT TOKEN HERE') ? true : false; 
        }
    }
