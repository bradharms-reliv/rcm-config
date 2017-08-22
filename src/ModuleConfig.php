<?php

namespace Reliv\RcmConfig;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        $config = include __DIR__ . '/../config/module.config.php';

        return [
            'doctrine' => $config['doctrine'],
            'Reliv\RcmConfig' => $config['Reliv\RcmConfig'],
            'Reliv\RcmConfig\Models' => $config['Reliv\RcmConfig\Models'],
            'dependencies' => $config['service_manager'],
        ];
    }
}
