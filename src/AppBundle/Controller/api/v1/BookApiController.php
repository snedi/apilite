<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\api\v1\ApiController;
use AppBundle\Entity\Book;

class BookApiController extends ApiController
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getAction()
    {
        $collection = $this->em->getRepository(Book::class)->findAll();

        // TODO: fetch assoc array should be built either via Hydration or some other approach if possible
        foreach ($collection as $item) {
            $data[] = [
                'id' => $item->getId(),
                'author_id' => $item->getAuthorId(),
                'name' => $item->getName(),
                'description' => $item->getDescription(),
            ];
        }

        return new Response(new JsonResponse($data), 200, array('content-type' => 'text/json'));
    }

    public function putAction()
    {
        // test resonses
        $response = new Response(
            'PUT',
            200,
            array('content-type' => 'text/json')
        );
        //var_dump($response);die();
        return $response;
    }

    public function deleteAction()
    {
        // test resonses
        $response = new Response(
            'DELETE',
            200,
            array('content-type' => 'text/json')
        );
        //var_dump($response);die();
        return $response;
    }

    public function postAction()
    {
        $obj = new Book();
        $obj->setAuthorId($_REQUEST['author_id']);
        $obj->setName($_REQUEST['name']);
        $obj->setDescription($_REQUEST['description']);

        $this->em->persist($obj);
        $this->em->flush();

        return var_dump($_REQUEST);
    }
}
