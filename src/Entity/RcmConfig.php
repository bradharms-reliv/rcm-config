<?php

namespace Reliv\RcmConfig\Entity;

use Doctrine\ORM\Mapping as ORM;
use Reliv\RcmConfig\Exception\InvalidJsonException;

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
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $context = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $name = '';

    /**
     * @var mixed
     *
     * @ORM\Column(type="text")
     */
    protected $value = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description = '';

    /**
     * getId
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getCategory
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * setCategory
     *
     * @param $category
     *
     * @return void
     */
    public function setCategory($category)
    {
        $this->category = (string)$category;
    }

    /**
     * getContext
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * setContext
     *
     * @param $context
     *
     * @return void
     */
    public function setContext($context)
    {
        $this->context = (string)$context;
    }

    /**
     * getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * setName
     *
     * @param $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * getValue
     *
     * @return mixed
     * @throws InvalidJsonException
     */
    public function getValue()
    {
        $value = json_decode($this->value, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidJsonException(
                "Invalid JSON config value for id: " . $this->getId() .
                ": " . json_last_error_msg()
            );
        }

        return $value;
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

    /**
     * getDescription
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * setDescription
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = (string)$description;
    }
}
