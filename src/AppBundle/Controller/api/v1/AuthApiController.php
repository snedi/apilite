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
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getAction($id = null)
    {
        if ($id) {
            // TODO: fetch assoc array should be built either via Hydration or some other approach if possible
            $item = $this->em->getRepository(Auth::class)->find($id);
            if ($item) {
                $data[] = [
                    'id' => $item->getId(),
                    'author_id' => $item->getAuthorId(),
                    'name' => $item->getName(),
                    'description' => $item->getDescription(),
                ];
                $status = 200;
            } else {
                $data = null;
                $status = 404;
            }
        } else {
            $obj = new Auth();
            $obj->setToken(123);

            $this->em->persist($obj);
            $this->em->flush();

            $data = null;
            $status = 201;
        }

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
