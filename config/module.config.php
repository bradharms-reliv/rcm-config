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

        [
            'myCategory' => [
                '_DEFAULT' => [
                    'myPropertyName1' => 'my value',
                    'myPropertyName2' => ['my value1', 'my value2'],
                ],
                'myContext' => [
                    'myPropertyName1' => 'my value over-ride',
                ]
            ]
        ]

        /* </example> */
    ],

    /**
     * Models:
     * Configure each category to use a model to access the data
     */
    'Reliv\RcmConfig\Models' => [
        /* <example> *

        'someConfigCategory' => 'Reliv\RcmConfig\ConfigModel',

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
