<?php

return [
    'console:([-]*(help|h|man))?' => [
        [
            'controller' => 'ConsoleHelpController',
            'method'     => 'help'
        ]
    ],
    'console:[-]*(cache-clear|cc)' => [
        [
            'controller' => 'ConsoleCacheController',
            'method'     => 'cacheClear'
        ]
    ],
    'console:test' => [
        [
            'controller' => 'ConsoleHelpController',
            'method'     => 'test',
            //'argument'   => ['ConsoleCacheController']
        ]
    ]
];