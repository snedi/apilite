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

    public function getAction()
    {
        $books = $this->em->getRepository(Book::class)->findAll();

        // TODO: fetch assoc array should be built either via Hydration or some other approach if possible
        foreach ($books as $book) {
            $booksArr[] = [
                'author_id' => $book->getAuthorId(),
                'name' => $book->getName(),
                'description' => $book->getDescription(),
            ];
        }

        return $booksArr;
    }

    public function putAction()
    {
        return "PUT";
    }

    public function postAction()
    {
        $book = new Book();
        $book->setAuthorId($_REQUEST['author_id']);
        $book->setName($_REQUEST['name']);
        $book->setDescription($_REQUEST['description']);

        $this->em->persist($book);
        $this->em->flush();

        return var_dump($_REQUEST);
    }
}
