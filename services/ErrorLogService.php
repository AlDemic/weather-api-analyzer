<?php
 final class ErrorLogService {
    public static function writeErrorLog($errMsg) {
        $file = dirname(__DIR__) . '/error_log.txt';

        $time = date('Y-m-d H:i:s');

        $str = "[$time] $errMsg" . PHP_EOL;

        //write to file
        file_put_contents($file, $str, FILE_APPEND);
    }
 }