<?php

namespace Reliv\RcmConfig\Model;

/**
 * Class CategoryModelInterface
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
interface CategoryModelInterface
{
    /**
     * setCategory
     *
     * @param string $category
     *
     * @return array
     */
    public function setCategory($category);

    /**
     * setCategory
     *
     * @return string
     */
    public function getCategory();

}
