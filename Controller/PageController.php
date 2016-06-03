<?php
namespace Controller;

use Helper\Request;
use Helper\ServiceContainer;
use Model\PageRepository;
use Helper\Controller;

/**
 * Class PageController
 * @package Controller
 * @author Yann Le Scouarnec <yann.le-scouarnec@hetic.net>
 */
class PageController extends Controller
{
    /**
     * PageController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function homeAction()
    {
        /** @var Request $request */
        $request = ServiceContainer::getService('Request');
        // @todo replace $_GET with Request
        if (isset($request->GET['prenom'])) {
            $prenom = $request->GET['prenom'];
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
        return $this->twigRender('about.html.twig', [
            'val' => 'Valuueeee'
        ]);
    }

    /**
     *
     */
    public function homePostAction()
    {
        return $this->render("ehmerde.php");
    }
}
