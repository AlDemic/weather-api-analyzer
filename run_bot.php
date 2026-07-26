<?php 
    require_once __DIR__ . '/bot/Bot.php';

    $offsetFileName = __DIR__ . '/bot/offset.txt';

    $timeout = 30;

    $tgBot = new Bot();

    echo "Bot is running...";

    while(true) {
        try {
            $offset = file_exists($offsetFileName) ? file_get_contents($offsetFileName) : 0;

            $res = $tgBot->getUpdate($offset, $timeout);

            file_put_contents($offsetFileName, $res);
        } catch(Throwable $e) {
            ErrorLogService::writeErrorLog($e->getMessage());
            sleep(3);
        }
    }

