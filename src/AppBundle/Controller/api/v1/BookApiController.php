<?php

namespace AppBundle\Controller\api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Controller\api\v1\ApiController;
use AppBundle\Entity\Book;

class BookApiController extends ApiController
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

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

    private function postAction()
    {
        $book = new Book();
        $book->setAuthorId(1);
        $book->setName('test22');
        $book->setDescription('test11');

        $this->em->persist($book);
        $this->em->flush();

        return 'ok';
    }
}
