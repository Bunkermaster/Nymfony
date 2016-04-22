<?php
namespace Model;

use Exception\RepositoryException;
use Helper\Container;

/**
 * Repository Class
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Model
 */
class Repository
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * Repository constructor
     */
    public function __construct()
    {
        $this->pdo = Container::getService('PDO');
        $repositoryReflection = new \ReflectionClass($this);
        // check if repository has $entity property
        try {
            $repositoryReflection->getProperty('entity');
        } catch (\ReflectionException $e) {
            throw new RepositoryException(
                'Please set Entity property name in Repository.'
            );
        }
    }

    /**
     * @param \PDOStatement $statement
     * @return mixed
     */
    protected function fetchObject(\PDOStatement $statement)
    {
        $entityReflection = new \ReflectionClass("\\Model\\Entity\\Page");
        $entityProperties = $entityReflection->getProperties();
        $fields = [];
        foreach ($entityProperties as $property) {
            $fields[] = $property->getName();
        }
        return $statement->fetchObject($this->entity);
    }
}
