<?php
namespace Controller;

use Model\PageRepository;

/**
 * Class PageController
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 * @package Controller
 */
class PageController
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function homeAction()
    {
        if(isset($_GET['prenom'])){
            $prenom = $_GET['prenom'];
        } else {
            $prenom = "Yann";
        }
        $repo = new PageRepository($this->pdo);
        $pageList = $repo->get();
        include APP_VIEW_DIR."home.php";
    }

    /**
     *
     */
    public function aboutAction()
    {
        include APP_VIEW_DIR."about.php";
    }
}