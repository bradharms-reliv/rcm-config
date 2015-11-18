<?php

namespace Reliv\RcmConfig\Model;

use Doctrine\ORM\EntityManager;
use Reliv\RcmConfig\Exception\DefaultMissingException;
use Reliv\RcmConfig\Exception\TypeMissingException;

/**
 * Class DoctrineModel
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
class DoctrineModel extends ConfigModel
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * DoctrineModel constructor.
     *
     * @param EntityManager $entityManager
     * @param null          $type
     */
    public function __construct(EntityManager $entityManager, $type = null)
    {
        $this->entityManager = $entityManager;
        $this->setType($type);
    }

    /**
     * getConfig
     *
     * @param string $type
     *
     * @return array
     */
    public function getTypeConfig($type)
    {
        if (!array_key_exists($type, $this->config)) {
            $query = $this->entityManager->createQueryBuilder()
                ->select('config')
                ->from(
                    'Reliv\RcmConfig\Entity\RcmConfig',
                    'config',
                    'config.entryId'
                )
                ->where(['config.entryType' => ':type'])
                ->getQuery();
            $query->setParameter('type', $type);

            $this->config[$type] = $query->getArrayResult();
        }

        return $this->config[$type];
    }
}
