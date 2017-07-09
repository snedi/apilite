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
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                $response = $this->getAction();
                break;
            case 'PUT':
                $response = $this->putAction();
                break;

            default:
                $response = $this->getAction();
                break;
        }

        return $response;
    }

    private function getAction()
    {
        return "GET";
    }

    private function putAction()
    {
        return "PUT";
    }
}
