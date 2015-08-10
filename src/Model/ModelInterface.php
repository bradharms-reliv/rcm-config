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
     * getFormats
     *
     * @param mixed $id
     *
     * @return array
     */
    public function getAll($id);

    /**
     * getFormat
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function getPrimary($id);

    /**
     * getDefault
     *
     * @return mixed
     */
    public function getDefault();
}