<?php

namespace Reliv\RcmConfig\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ConfigService
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmConfig\Factory
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ConfigService implements FactoryInterface
{

    /**
     * Creates Service
     *
     * @param ServiceLocatorInterface $serviceLocator Zend Service Locator
     *
     * @return \Reliv\RcmConfig\Service\ConfigService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        return new \Reliv\RcmConfig\Service\ConfigService(
            $config,
            $serviceLocator
        );
    }
}
