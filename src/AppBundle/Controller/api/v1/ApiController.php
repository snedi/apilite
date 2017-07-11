<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Auth;

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
                if ($this->isAuthenticated())
                    $response = $this->putAction($id);
                else
                    $response = $this->noAuthMessage();
                break;
            case 'POST':
                if ($this->isAuthenticated())
                    $response = $this->postAction($id);
                else
                    $response = $this->noAuthMessage();
                break;
            case 'DELETE':
                if ($this->isAuthenticated())
                    $response = $this->deleteAction($id);
                else
                    $response = $this->noAuthMessage();
                break;

            default:
                $response = null;
                break;
        }

        return $response;
    }

    public function isAuthenticated()
    {
        $item = $this->em->getRepository(Auth::class)->findByToken($_REQUEST['token']);
        return ($item) ? true : false;
        if(!$item) {

        }
    }

    public function noAuthMessage()
    {
        $data = ['message' => 'This API request requires authentication via token'];
        $status = 404;
        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public static function factory($class, $em)
    {
        return new $class($em);
    }
}
