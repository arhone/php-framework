<?php

return [
    'ConsoleHelpController' => [
        'class' => 'console\controller\ConsoleHelpController'
    ],
    'ConsoleCacheController' => [
        'class' => 'console\controller\ConsoleCacheController',
        'construct' => [
            ['Cache']
        ]
    ],
    'ConsoleSymlinkController' => [
        'class' => 'console\controller\ConsoleSymlinkController'
    ]
];
