<?php

namespace Reliv\RcmConfig\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RcmConfig
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
 *
 * @ORM\Entity
 * @ORM\Table(name="rcm_config_config")
 */
class RcmConfig
{
    /**
     * @var int Auto-Incremented Primary Key
     *
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $entryType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $entryId = '';

    /**
     * @var mixed
     *
     * @ORM\Column(type="text")
     */
    protected $value = '';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getEntryType
     *
     * @return string
     */
    public function getEntryType()
    {
        return $this->entryType;
    }

    /**
     * setEntryType
     *
     * @param string $entryType
     *
     * @return void
     */
    public function setEntryType($entryType)
    {
        $this->entryType = $entryType;
    }

    /**
     * getEntryId
     *
     * @return string
     */
    public function getEntryId()
    {
        return $this->entryId;
    }

    /**
     * setEntryId
     *
     * @param string $entryId
     *
     * @return void
     */
    public function setEntryId($entryId)
    {
        $this->entryId = $entryId;
    }

    /**
     * getValue
     *
     * @return mixed
     */
    public function getValue()
    {
        return json_decode($this->value, true);
    }

    /**
     * setValue
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->value = json_encode($value);
    }
}
