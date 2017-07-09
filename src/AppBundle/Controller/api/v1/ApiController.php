<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;

class ApiController extends Controller
{
    public $api_route;

    function __construct($api_route)
    {
        $this->api_route = $api_route;
    }

    public function bookApiAction()
    {
        var_dump($_REQUEST);
        var_dump($_SERVER['REQUEST_METHOD']);die();
    }

    public function authorApiAction()
    {
        var_dump($_REQUEST);
        var_dump($_SERVER['REQUEST_METHOD']);die();
    }


}
