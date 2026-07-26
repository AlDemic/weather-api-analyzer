@echo off
chcp 65001 >nul
cd /d "%~dp0"

php run_bot.php

echo.
echo ==========================
echo End program
pause
