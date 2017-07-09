<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\api\v1\ApiController;
use AppBundle\Entity\Book;

class BookApiController extends ApiController
{
    public function apiAction($params = null)
    {
        var_dump($params);
        var_dump($_SERVER['REQUEST_METHOD']);die();
    }
}
