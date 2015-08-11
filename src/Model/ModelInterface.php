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
     * Get All config entries
     *
     * @return array
     */
    public function getList();

    /**
     * Get All config entries with only value described by $key
     *
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    public function getListValue($key, $default = null);

    /**
     * Get All values of a config entry if found
     * If entry not found, call get default values
     *
     * @param string|int $id
     *
     * @return array
     */
    public function getAll($id);

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
    public function getValue($id, $key, $default = null);

    /**
     * Get primary (first) value of an entry if found
     * If entry not found, get first value of default
     *
     * @param string|int $id
     *
     * @return mixed
     */
    public function getPrimary($id);

    /**
     * Get default values
     *
     * @return array
     */
    public function getDefault();
}
