@echo off
chcp 65001 >nul
cd /d "%~dp0"

php run_console.php

echo.
echo ==========================
echo End program
pause
