<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class ApiController extends Controller
{
    public $api_route;

    public static $mapRouteApiClass = [
        'book' => 'BookApiController',
        'author' => 'AuthorApiController',
    ];

    abstract public function getAction();
    abstract public function putAction();
    abstract public function postAction();
    abstract public function deleteAction();

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
            case 'POST':
                $response = $this->postAction();
                break;
            case 'DELETE':
                $response = $this->deleteAction();
                break;

            default:
                $response = null;
                break;
        }

        return $response;
    }

    public static function factory($class, $em)
    {
        return new $class($em);
    }
}
