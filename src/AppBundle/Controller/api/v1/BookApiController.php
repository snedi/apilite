<?php

namespace AppBundle\Controller\api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Controller\api\ApiController;
use AppBundle\Entity\Book;

class BookApiController extends ApiController
{
    public $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getAction($id = null)
    {
        if ($id) {
            // TODO: fetch assoc array should be built either via Hydration or some other approach if possible
            $item = $this->em->getRepository(Book::class)->find($id);
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
            // TODO: fetch assoc array should be built either via Hydration or some other approach if possible
            $collection = $this->em->getRepository(Book::class)->findAll();
            if ($collection) {
                foreach ($collection as $item) {
                    $data[] = [
                        'id' => $item->getId(),
                        'author_id' => $item->getAuthorId(),
                        'name' => $item->getName(),
                        'description' => $item->getDescription(),
                    ];
                    $status = 200;
                }
            } else {
                $data = null;
                $status = 404;
            }
        }

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public function putAction($id = null)
    {
        if ($id) {
            parse_str(file_get_contents("php://input"), $putVars);
            $obj = $this->em->getRepository(Book::class)->find($id);
            if ($obj) {
                $obj->setAuthorId($putVars['author_id']);
                $obj->setName($putVars['name']);
                $obj->setDescription($putVars['description']);

                $this->em->persist($obj);
                $this->em->flush();

                $data = null;
                $status = 200;
            } else {
                $data = null;
                $status = 404;
            }
        } else {
            $data = null;
            $status = 405;
        }

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public function deleteAction($id = null)
    {
        if ($id) {
            $item = $this->em->getRepository(Book::class)->find($id);
            if ($item) {
                $this->em->remove($item);
                $this->em->flush();

                $data = null;
                $status = 200;
            } else {
                $data = null;
                $status = 404;
            }
        } else {
            $data = null;
            $status = 405;
        }

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }

    public function postAction($id = null)
    {
        if (!$id) {
            $obj = new Book();
            $obj->setAuthorId($_REQUEST['author_id']);
            $obj->setName($_REQUEST['name']);
            $obj->setDescription($_REQUEST['description']);

            $this->em->persist($obj);
            $this->em->flush();

            $data = null;
            $status = 201;
        } else {
            $data = null;
            // no specific item method for POST /sample_action/{id}
            $status = 405;
        }

        return new Response(new JsonResponse($data), $status, array('content-type' => 'text/json'));
    }
}
