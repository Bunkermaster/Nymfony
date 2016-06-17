<?php
namespace Helper;

use Doctrine\ORM\EntityManager;
use Exception\RepositoryException;

/**
 * Repository Class
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Model
 */
abstract class Repository
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Repository constructor
     */
    public function __construct()
    {
        $repositoryReflection = new \ReflectionClass($this);
        $this->entityManager = ServiceContainer::getService('EntityManager');
        // check if repository has $entity property
        try {
            $repositoryReflection->getProperty('entity');
        } catch (\ReflectionException $e) {
            throw new RepositoryException(
                'Please set Entity property name in Repository.'
            );
        }
    }
}
