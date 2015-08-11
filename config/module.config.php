<?php
return [

    /**
     * Configuration
     */
    'Reliv\RcmConfig' => [
        /* <example> *

        'someConfigType' => [
            '_DEFAULT' => [
                'DEFAULT-PRIMARY-VALUE',
                'DEFAULT-ETC-VALUE',
            ],
            'id' => [
                'PRIMARY-VALUE',
                'SECONDARY-VALUE',
                'ETC-VALUE',
            ],
        ],

        /* </example> */
    ],

    /**
     * Models
     */
    'Reliv\RcmConfig\Models' => [
        /* <example> *

        'someConfigType' => 'Reliv\RcmConfig\ConfigModel',

        /* </example> */
    ],

    /**
     * Services
     */
    'service_manager' => [
        'factories' => [
            'Reliv\RcmConfig\ConfigService' => 'Reliv\RcmConfig\Factory\ConfigService',
            'Reliv\RcmConfig\ConfigModel' => 'Reliv\RcmConfig\Factory\ConfigModel',
        ]
    ],
];
