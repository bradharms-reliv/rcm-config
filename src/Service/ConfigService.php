<?php

namespace Reliv\RcmConfig\Service;

use Reliv\RcmConfig\Exception\ServiceConfigException;
use Reliv\RcmConfig\Model\ModelInterface;
use Reliv\RcmConfig\Model\CategoryModelInterface;
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
     * @param $category
     *
     * @return array
     * @throws ServiceConfigException
     */
    public function getList($category)
    {
        $model = $this->getModel($category);

        return $model->getList();
    }

    /**
     * Get All config entries with only value described by $name
     *
     * @return array
     */
    public function getListValue($category, $name, $default = null)
    {
        $model = $this->getModel($category);

        return $model->getListValue($name, $default);
    }

    /**
     * Get All values of a config entry if found
     * If entry not found, call get default values
     *
     * @param string     $category
     * @param string     $context
     *
     * @return array
     * @throws ServiceConfigException
     */
    public function getAll($category, $context)
    {
        $model = $this->getModel($category);

        return $model->getAll($context);
    }

    /**
     * Get specific value by name of an entry if found
     * If entry not found, get value by name of default
     *
     * @param string     $category
     * @param string|int $context
     * @param string     $name
     * @param mixed      $default
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getValue($category, $context, $name, $default = null)
    {
        $model = $this->getModel($category);

        return $model->getValue($context, $name, $default);
    }

    /**
     * Get primary (first) value of an entry if found
     * If entry not found, get first value of default
     *
     * @param string     $category
     * @param string|int $context
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getPrimary($category, $context)
    {
        $model = $this->getModel($category);

        return $model->getPrimary($context);
    }

    /**
     * Get default values
     *
     * @param string     $category
     *
     * @return mixed
     * @throws ServiceConfigException
     */
    public function getDefault($category)
    {
        $model = $this->getModel($category);

        return $model->getDefault();
    }

    /**
     * getModel
     *
     * @param string $category
     *
     * @return ModelInterface
     * @throws ServiceConfigException
     */
    public function getModel($category)
    {
        $category = (string)$category;

        if (!isset($this->config['Reliv\RcmConfig\Models'][$category])) {
            throw new ServiceConfigException(
                "Model configuration not defined for category: {$category}"
            );
        }

        $service = $this->config['Reliv\RcmConfig\Models'][$category];

        if (!$this->serviceLocator->has($service)) {
            throw new ServiceConfigException(
                "Model service not defined for category: {$category}"
            );
        }

        $service = $this->serviceLocator->get($service);

        if ($service instanceof CategoryModelInterface) {
            $service->setCategory($category);
        }

        return $service;
    }
}
