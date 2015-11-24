<?php

namespace Reliv\RcmConfig\Model;

use Doctrine\ORM\EntityManager;

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
     * @param null          $category
     */
    public function __construct(EntityManager $entityManager, $category = null)
    {
        $this->entityManager = $entityManager;
        $this->setCategory($category);
    }

    /**
     * getConfig
     *
     * @param string $category
     *
     * @return array
     */
    public function getCategoryConfig($category)
    {
        if (!array_key_exists($category, $this->config)) {
            $query = $this->entityManager->createQueryBuilder()
                ->select('config')
                ->from(
                    '\Reliv\RcmConfig\Entity\RcmConfig',
                    'config',
                    'config.id'
                )
                ->where('config.category = :category')
                ->getQuery();
            $query->setParameter('category', $category);

            $results = $query->getResult();
            $preparedResult = [];

            /**
             * @var                                   $context
             * @var \Reliv\RcmConfig\Entity\RcmConfig $item
             */
            foreach ($results as $id => $item) {
                $context = $item->getContext();
                if (!array_key_exists($context, $preparedResult)) {
                    $preparedResult[$context] = [];
                }
                $preparedResult[$context][$item->getName()] = $item->getValue();
            }

            $this->config[$category] = $preparedResult;
        }

        return $this->config[$category];
    }
}
