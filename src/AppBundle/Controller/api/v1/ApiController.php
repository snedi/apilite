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
        'auth' => 'AuthApiController',
    ];

    abstract public function getAction($id = null);
    abstract public function putAction($id = null);
    abstract public function postAction($id = null);
    abstract public function deleteAction($id = null);

    public function apiAction($params = null)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        isset($params['id']) ? $id = $params['id'] : $id = null;

        switch ($method) {
            case 'GET':
                $response = $this->getAction($id);
                break;
            case 'PUT':
                $response = $this->putAction($id);
                break;
            case 'POST':
                $response = $this->postAction($id);
                break;
            case 'DELETE':
                $response = $this->deleteAction($id);
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
