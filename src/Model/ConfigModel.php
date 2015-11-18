<?php

namespace Reliv\RcmConfig\Model;

use Reliv\RcmConfig\Exception\DefaultMissingException;
use Reliv\RcmConfig\Exception\CategoryMissingException;
use Reliv\RcmConfig\Exception\SaveNotSupportedException;

/**
 * Class ConfigModel
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
class ConfigModel implements ModelInterface, CategoryModelInterface
{
    /**
     * @var string
     */
    protected $configKey = 'Reliv\RcmConfig';

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $category = null;

    /**
     * @param array $config
     * @param null  $category
     */
    public function __construct($config, $category = null)
    {
        $this->config = $config[$this->configKey];
        $this->setCategory($category);
    }

    /**
     * getCategoryConfig
     *
     * @param string $category
     *
     * @return array
     */
    public function getCategoryConfig($category)
    {
        return $this->config[$category];
    }

    /**
     * setCategory
     *
     * @param string $category
     *
     * @return void
     */
    public function setCategory($category)
    {
        $this->category = (string)$category;
    }

    /**
     * getCategory
     *
     * @return string
     * @throws CategoryMissingException
     */
    public function getCategory()
    {
        if (empty($this->category)) {
            throw new CategoryMissingException('ConfigModel requires category to be set');
        }

        return $this->category;
    }

    /**
     * Get All config entries
     *
     * @return array
     */
    public function getList()
    {
        $category = $this->getCategory();

        $list = $this->getCategoryConfig($category);

        foreach ($list as $context => $config) {
            $list[$context] = $this->getAll($context);
        }

        return $list;
    }

    /**
     * Get All config entries with only value described by $name
     *
     * @return array
     */
    public function getListValue($name, $default = null)
    {
        $category = $this->getCategory();

        $list = $this->getCategoryConfig($category);

        foreach ($list as $context => $config) {
            $list[$context] = $this->getValue($context, $name, $default);
        }

        return $list;
    }

    /**
     * Get All values of a config entry if found
     * If entry not found, call get default values
     *
     * @param string|int $context
     *
     * @return array
     * @throws DefaultMissingException
     * @throws CategoryMissingException
     */
    public function getAll($context)
    {
        $category = $this->getCategory();

        $entry = $this->getDefault();

        $categoryConfig = $this->getCategoryConfig($category);

        if (isset($categoryConfig[$context])) {
            $actual = $categoryConfig[$context];
            $entry = array_merge($entry, $actual);
        }

        return $entry;
    }

    /**
     * Get specific value by name of an entry if found
     * If entry not found, get value by name of default
     *
     * @param string|int $context
     * @param string     $name
     * @param mixed      $default
     *
     * @return mixed
     */
    public function getValue($context, $name, $default = null)
    {
        $all = $this->getAll($context);

        if (array_key_exists($name, $all)) {
            return $all[$name];
        }

        return $default;
    }

    /**
     * Get primary (first) value of an entry if found
     * If entry not found, get first value of default
     *
     * @param string|int $context
     *
     * @return mixed
     */
    public function getPrimary($context)
    {
        $all = $this->getAll($context);

        // Get the first in the array
        return $all[array_keys($all)[0]];
    }

    /**
     * Get default values
     *
     * @return array
     * @throws DefaultMissingException
     * @throws CategoryMissingException
     */
    public function getDefault()
    {
        $category = $this->getCategory();

        $categoryConfig = $this->getCategoryConfig($category);

        if (!isset($categoryConfig[ModelInterface::DEFAULT_CONTEXT])) {
            throw new DefaultMissingException(
                'ConfigModel requires default to be set'
            );
        }

        return $categoryConfig[ModelInterface::DEFAULT_CONTEXT];
    }
}
