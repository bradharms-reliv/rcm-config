<?php

namespace Reliv\RcmConfig\Service;

use Reliv\RcmConfig\Exception\ServiceConfigException;
use Reliv\RcmConfig\Model\ModelInterface;
use Reliv\RcmConfig\Model\TypeModelInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ConfigService
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ConfigService
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @param array                   $config
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(
        $config,
        ServiceLocatorInterface $serviceLocator
    ) {
        $this->config = $config['Reliv\RcmConfig'];
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * getAll
     *
     * @param $type
     * @param $id
     *
     * @return array
     * @throws ServiceConfigException
     */
    public function getAll($type, $id)
    {
        $model = $this->getModel($type);

        return $model->getAll($id);
    }

    /**
     * getPrimary
     *
     * @param $type
     * @param $id
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getPrimary($type, $id)
    {
        $model = $this->getModel($type);

        return $model->getPrimary($id);
    }

    /**
     * getDefault
     *
     * @param $type
     * @param $id
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getDefault($type, $id)
    {
        $model = $this->getModel($type);

        return $model->getDefault();
    }

    /**
     * getModel
     *
     * @param string $type
     *
     * @return ModelInterface
     * @throws ServiceConfigException
     */
    protected function getModel($type)
    {
        $type = (string)$type;

        if (!isset($this->config['Reliv\RcmConfig'][$type])) {
            throw new ServiceConfigException(
                "Service configuration not defined for type: {$type}"
            );
        }

        $service = $this->config['Reliv\RcmConfig'][$type];

        if (!$this->serviceLocator->has($service)) {
            throw new ServiceConfigException(
                "Service configuration not defined for type: {$type}"
            );
        }

        $service = $this->serviceLocator->get($service);

        if ($service instanceof TypeModelInterface) {
            $service->setType($type);
        }

        return $service;
    }
}
