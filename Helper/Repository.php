<?php
namespace Helper;

use Doctrine\ORM\EntityManager;
use Exception\RepositoryException;
<<<<<<< HEAD:Helper/Repository.php
=======
use Helper\ServiceContainer;
>>>>>>> a3e66c70649e9529d64871a179dce9d0a4b6a220:Model/Repository.php

/**
 * Repository Class
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Model
 */
abstract class Repository
{
    /**
     * @var \PDO
     */
    protected $pdo;
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Repository constructor
     */
    public function __construct()
    {
        $this->pdo = ServiceContainer::getService('PDO');
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
