<?php
return [

    /**
     * Doctrine Config - Used for DoctrineModel
     */
    'doctrine' => [
        'driver' => [
            'Reliv\RcmConfig' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
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

        'myCategory' => \Reliv\RcmConfig\Model\ConfigModel::class,

        /* </example> */
    ],

    /**
     * Services
     */
    'service_manager' => [
        'factories' => [
            // @todo BC ONLY
            'Reliv\RcmConfig\ConfigService'
            => \Reliv\RcmConfig\Factory\ConfigService::class,
            // @todo BC ONLY
            'Reliv\RcmConfig\ConfigModel'
            => \Reliv\RcmConfig\Factory\ConfigModel::class,
            // @todo BC ONLY
            'Reliv\RcmConfig\DoctrineModel'
            => \Reliv\RcmConfig\Factory\DoctrineModel::class,

            \Reliv\RcmConfig\Service\ConfigService::class
            => \Reliv\RcmConfig\Factory\ConfigService::class,

            \Reliv\RcmConfig\Model\ConfigModel::class
            => \Reliv\RcmConfig\Factory\ConfigModel::class,

            \Reliv\RcmConfig\Model\DoctrineModel::class
            => \Reliv\RcmConfig\Factory\DoctrineModel::class,
        ]
    ],
];
