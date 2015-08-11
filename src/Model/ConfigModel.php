<?php

namespace Reliv\RcmConfig\Model;

use Reliv\RcmConfig\Exception\DefaultMissingException;
use Reliv\RcmConfig\Exception\TypeMissingException;

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
class ConfigModel implements ModelInterface, TypeModelInterface
{
    /**
     * @var string
     */
    protected $defaultKey = '_DEFAULT';

    /**
     * @var string
     */
    protected $configKey = 'Reliv\RcmConfig';

    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @param array $config
     * @param null  $type
     */
    public function __construct($config, $type = null)
    {
        $this->config = $config[$this->configKey];
        $this->setType($type);
    }

    /**
     * setType
     *
     * @param string $type
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = (string)$type;
    }

    /**
     * getType
     *
     * @return string
     * @throws TypeMissingException
     */
    public function getType()
    {
        if (empty($this->type)) {
            throw new TypeMissingException('ConfigModel requires type to be set');
        }

        return $this->type;
    }

    /**
     * Get All config entries
     *
     * @return array
     */
    public function getList()
    {
        $type = $this->getType();

        $list = $this->config[$type];

        foreach ($list as $id => $config) {
            $list[$id] = $this->getAll($id);
        }

        return $list;
    }

    /**
     * Get All config entries with only value described by $key
     *
     * @return array
     */
    public function getListValue($key, $default = null)
    {
        $type = $this->getType();

        $list = $this->config[$type];

        foreach ($list as $id => $config) {
            $list[$id] = $this->getValue($id, $key, $default);
        }

        return $list;
    }

    /**
     * Get All values of a config entry if found
     * If entry not found, call get default values
     *
     * @param string|int $id
     *
     * @return array
     * @throws DefaultMissingException
     * @throws TypeMissingException
     */
    public function getAll($id)
    {
        $type = $this->getType();

        $entry = $this->getDefault();

        if (isset($this->config[$type][$id])) {
            $actual = $this->config[$type][$id];
            $entry = array_merge($entry, $actual);
        }

        return $entry;
    }

    /**
     * Get specific value by key of an entry if found
     * If entry not found, get value by key of default
     *
     * @param string|int $id
     * @param string     $key
     * @param mixed      $default
     *
     * @return mixed
     */
    public function getValue($id, $key, $default = null)
    {
        $all = $this->getAll($id);

        if (array_key_exists($key, $all)) {
            return $all[$key];
        }

        return $default;
    }

    /**
     * Get primary (first) value of an entry if found
     * If entry not found, get first value of default
     *
     * @param string|int $id
     *
     * @return mixed
     */
    public function getPrimary($id)
    {
        $all = $this->getAll($id);

        // Get the first in the array
        return $all[array_keys($all)[0]];
    }

    /**
     * Get default values
     *
     * @return array
     * @throws DefaultMissingException
     * @throws TypeMissingException
     */
    public function getDefault()
    {
        $type = $this->getType();

        if (!isset($this->config[$type][$this->defaultKey])) {
            throw new DefaultMissingException(
                'ConfigModel requires default to be set'
            );
        }

        return $this->config[$type][$this->defaultKey];
    }
}
