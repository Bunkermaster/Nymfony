<?php
namespace Controller;

use Model\PageRepository;

/**
 * Class PageController
 * @package Controller
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class PageController extends Controller
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
        if (isset($_GET['prenom'])) {
            $prenom = $_GET['prenom'];
        } else {
            $prenom = "Yann";
        }
        $repo = new PageRepository();
        $pageList = $repo->get();
        return $this->render(
            "home.php",
            [
                'prenom' => $prenom,
                'pageList' => $pageList
            ]
        );
    }

    /**
     *
     */
    public function aboutAction()
    {
        return $this->render("about.php");
    }

    /**
     *
     */
    public function homePostAction()
    {
        return $this->render("ehmerde.php");
    }
}