<?php
return [
    /**
     * Configuration
     */
    'Reliv\RcmConfig' => [
        /* <example> *
        'someConfigType' => [
            '_DEFAULT' => 'DEFAULT-FORMAT',
            'id' => [
                'PRIMARY-VALUE',
                'SECONDARY-VALUE',
                'ETC-VALUE',
            ],
        ],
        'typeModels' => [
            'someConfigType' => 'Reliv\RcmConfig\ConfigModel',
        ],
        /* </example> */
        'typeModels' => [
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Reliv\RcmConfig\ConfigService' => 'Reliv\RcmConfig\Factory\ConfigService',
            'Reliv\RcmConfig\ConfigModel' => 'Reliv\RcmConfig\Factory\ConfigModel',
        ]
    ],
];
