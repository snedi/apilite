<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;

use AppBundle\Controller\api\v1\BookApiController;

abstract class ApiController extends Controller
{
    public $api_route;

    abstract public function apiAction($params = null);

    public static function factory($class)
    {
        return new $class();
    }
}
