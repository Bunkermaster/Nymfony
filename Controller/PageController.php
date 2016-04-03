<?php
namespace Controller;

use Model\PageRepository;

class PageController extends Controller
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
    }

    public function homeAction()
    {
        if(isset($_GET['prenom'])){
            $prenom = $_GET['prenom'];
        } else {
            $prenom = "Yann";
        }
        $repo = new PageRepository($this->pdo);
        $pageList = $repo->get();
        return $this->render("home.php", [
            'pageList' => $pageList,
            'prenom' => $prenom
        ]);
    }
    
    public function aboutAction()
    {
        return $this->render("about.php");
    }
}