<?php

namespace Reliv\RcmConfig\Model;

/**
 * Class ModelInterface
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   Reliv\RcmConfig\Model
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
interface ModelInterface
{
    /**
     * Default Context
     */
    const DEFAULT_CONTEXT = '_DEFAULT';

    /**
     * Get raw configuration for a category
     *
     * @param string $category
     *
     * @return array
     */
    public function getCategoryConfig($category);

    /**
     * Get All config entries
     *
     * @return array
     */
    public function getList();

    /**
     * Get All config entries with only value described by $name
     *
     * @param      $name
     * @param null $default
     *
     * @return mixed
     */
    public function getListValue($name, $default = null);

    /**
     * Get All values of a config entry if found
     * If entry not found, call get default values
     *
     * @param string|int $context
     *
     * @return array
     */
    public function getAll($context);

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
    public function getValue($context, $name, $default = null);

    /**
     * Get primary (first) value of an entry if found
     * If entry not found, get first value of default
     *
     * @param string|int $context
     *
     * @return mixed
     */
    public function getPrimary($context);

    /**
     * Get default values
     *
     * @return array
     */
    public function getDefault();
}
