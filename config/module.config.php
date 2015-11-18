<?php
return [

    /**
     * Doctrine Config - Used for DoctrineModel
     */
    'doctrine' => [
        'driver' => [
            'Reliv\RcmConfig' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Reliv\RcmConfig' => 'Reliv\RcmConfig'
                ]
            ]
        ]
    ],

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
            'Reliv\RcmConfig\DoctrineModel' => 'Reliv\RcmConfig\Factory\DoctrineModel',
        ]
    ],
];
