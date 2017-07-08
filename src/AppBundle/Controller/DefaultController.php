<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Author;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

	/**
     * @Route("/test", name="test-work")
     */
    public function testAction(Request $request)
    {
        return $this->render('default/test.html.twig', array(
            'test' => var_dump($_SERVER['REQUEST_METHOD']),
        ));
    }

	/**
     * @Route("/api/v{api_version}/api-route", name="api")
     */
    public function apiAction(Request $request, $api_version)
    {
		echo "<pre>";
		var_dump($api_version);die();

    }

    /**
     * test db
     * @Route("/db", name="test-db")
     */
    public function testDb(Request $request)
    {
        $author = new Author();
        $author->setName('test');

        $em = $this->getDoctrine()->getManager();
        $em->persist($author);
        $em->flush();
    }
}
