RCM Config
====================

##### Module title: #####
RCM Config

##### Module description: #####
Extend the functionality of ZF2 config as well as allow config sources to be changed

- Models my be written and injected to pull from any source by category
- ZF2 ConfigModel and Doctine ConfigModel is available by default
- Allows for config sources to be changed without impact to existing code
- Allows for a standard for storing config values

##### Config Example:

```php
<?php
    // Example of a config array as might be defined in ZF2 config
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
    ];
```

##### Usage Example

```php
<?php
    /** Using /Zend\ServiceManager/ServiceManager as $serviceLocator */

    $configService = $serviceLocator->get('Reliv\RcmConfig\ConfigService');

    $value = $configService->getValue(
        'myCategory',
        'myContext',
        'myPropertyName1'
    );
    /** Outputs: 'my value over-ride' */
    var_dump($value);
    
    $value = $configService->getValue(
        'myCategory',
        'myContext',
        'myPropertyName2'
    );
    /** Outputs: ['my value1', 'my value2'] */
    var_dump($value);
    
    /** Other Methods */
    var_dump(
        'getValue',
        $cs->getValue(
           'myCategory',
           'myContext',
           'myPropertyName1'
        ),
        'getList',
        $cs->getList('myCategory'),
        'getAll',
        $cs->getAll('myCategory', 'myContext'),
        'getDefault',
        $cs->getDefault('myCategory'),
        'getListValue',
        $cs->getListValue('myCategory', 'myPropertyName1'),
        'getPrimary',
        $cs->getPrimary('myCategory', 'myContext')
    );
```

##### Project author: #####

James Jervis
jjervis@relivinc.com
https://github.com/reliv/rcm-config
Copyright (c) 2015, Reliv' International

