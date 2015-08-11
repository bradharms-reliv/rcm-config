<?php

namespace Reliv\RcmConfig\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ConfigModel
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
class ConfigModel implements FactoryInterface
{
    /**
     * Creates Service
     *
     * @param ServiceLocatorInterface $serviceLocator Zend Service Locator
     *
     * @return \Reliv\RcmConfig\Model\ConfigModel
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        return new \Reliv\RcmConfig\Model\ConfigModel($config, null);
    }
}
