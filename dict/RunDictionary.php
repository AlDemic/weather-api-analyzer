<?php 
    final class RunDictionary {
        public static function getArCommands(): array {
            return [
                1 => [
                    'command' => 'allw',
                    'desc' => [
                        'ru' => 'получить текущую погоду и на завтра',
                        'en' => 'get current weather and for tomorrow'
                    ],
                ],
                2 => [
                    'command' => 'cw',
                    'desc' => [
                        'ru' => 'получить текущую погоду',
                        'en' => 'get current weather'
                    ],
                ],
                3 => [
                    'command' => 'ndw',
                    'desc' => [
                        'ru' => 'получить погоду на завтра',
                        'en' => 'get next day weather'
                    ],
                ],
            ];
        }

        public static function getArHolders(): array {
            return [
                'enterText' => [
                    'ru' => 'Введите число согласно выбору',
                    'en' => 'Enter number according to choice',
                ],
                'startBotCommandText' => [
                    'ru' => 'Добро пожаловать! Чтобы узнать команды бота - отправьте текст /wc в чат',
                    'en' => 'Welcome! To know bot\'s commands - send /wc in chat',
                ],
                'enterPlaceText' => [
                    'ru' => 'Укажите место',
                    'en' => 'Write place',
                ],
                'exitText' => [
                    'ru' => 'или введите 0 чтобы выйти из программы',
                    'en' => 'or enter 0 to exit from program',
                ],
                'enterPlaceUser' => [
                    'ru' => 'Напишите место или 0 чтобы выйти из программы',
                    'en' => 'Write place or 0 to exit from program',
                ],
                'enterNumberText' => [
                    'ru' => 'Введите корректное число',
                    'en' => 'Enter correct number',
                ],
                'enterSaveResult' => [
                    'ru' => "Введите как сохранить/показать результат:\n1 => показать в консоли\n2 => сохранить api json(/json_raw/)\n3 => оба\n",
                    'en' => "Enter how to save/show result:\n1 => show in console\n2 => save api json(/json_raw/)\n3 => both\n",
                ],
                'tgShowCommandsText' => [
                    'ru' => "Чтобы узнать погоду введите одну из указанных команд",
                    'en' => "To get weather info enter one of these commands",
                ],
            ];
        }
    }