<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\api\v1\ApiController;
use AppBundle\Entity\Auth;

class AuthApiController extends ApiController
{
    public $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getAction($id = null)
    {
        $obj = new Auth();
        $token = bin2hex(random_bytes(Auth::TOKEN_LENGTH));
        $obj->setToken($token);

        $this->em->persist($obj);
        $this->em->flush();

        $data = ['token' => $token];
        $status = 201;

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public function putAction($id = null)
    {
        $data = null;
        $status = 405;

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public function deleteAction($id = null)
    {
        $data = null;
        $status = 405;

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public function postAction($id = null)
    {
        $data = null;
        $status = 405;

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }
}
