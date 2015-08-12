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
        $this->config = $config;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get All config entries
     *
     * @param $type
     *
     * @return array
     * @throws ServiceConfigException
     */
    public function getList($type)
    {
        $model = $this->getModel($type);

        return $model->getList();
    }

    /**
     * Get All config entries with only value described by $key
     *
     * @return array
     */
    public function getListValue($type, $key, $default = null)
    {
        $model = $this->getModel($type);

        return $model->getListValue($key, $default);
    }

    /**
     * Get All values of a config entry if found
     * If entry not found, call get default values
     *
     * @param string     $type
     * @param string|int $id
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
     * Get specific value by key of an entry if found
     * If entry not found, get value by key of default
     *
     * @param string     $type
     * @param string|int $id
     * @param string     $key
     * @param mixed      $default
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getValue($type, $id, $key, $default = null)
    {
        $model = $this->getModel($type);

        return $model->getValue($id, $key, $default);
    }

    /**
     * Get primary (first) value of an entry if found
     * If entry not found, get first value of default
     *
     * @param string     $type
     * @param string|int $id
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
     * Get default values
     *
     * @param string     $type
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getDefault($type)
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
    public function getModel($type)
    {
        $type = (string)$type;

        if (!isset($this->config['Reliv\RcmConfig\Models'][$type])) {
            throw new ServiceConfigException(
                "Model configuration not defined for type: {$type}"
            );
        }

        $service = $this->config['Reliv\RcmConfig\Models'][$type];

        if (!$this->serviceLocator->has($service)) {
            throw new ServiceConfigException(
                "Model service not defined for type: {$type}"
            );
        }

        $service = $this->serviceLocator->get($service);

        if ($service instanceof TypeModelInterface) {
            $service->setType($type);
        }

        return $service;
    }
}
