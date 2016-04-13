<?php
namespace Model;

use Helper\Container;

/**
 * Class Repository
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
     * Repository constructor.
     */
    public function __construct()
    {
        $this->pdo = Container::getService('PDO');
    }
}
