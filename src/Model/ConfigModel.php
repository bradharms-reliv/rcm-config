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
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @param $config
     */
    public function __construct($config, $type = null)
    {
        $this->config = $config['Reliv\RcmConfig'];
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
     * getFormats
     *
     * @param mixed $id
     *
     * @return array
     */
    public function getAll($id)
    {
        $type = $this->getType();

        if (isset($this->config[$type][$id])) {
            return $this->config[$type][$id];
        }

        $default = $this->getDefault();

        return [$default];
    }

    /**
     * getFormat
     *
     * @param mixed $id
     *
     * @return string
     */
    public function getPrimary($id)
    {
        $all = $this->getAll($id);

        // Get the first in the array
        return $all[array_keys($all)[0]];
    }

    /**
     * getDefault
     *
     * @return mixed
     * @throws DefaultMissingException
     * @throws TypeMissingException
     */
    public function getDefault()
    {
        $type = $this->getType();

        if (!isset($this->config[$type][$this->defaultKey])) {
            throw new DefaultMissingException('ConfigModel requires default to be set');
        }

        return $this->config[$type][$this->defaultKey];
    }
}
