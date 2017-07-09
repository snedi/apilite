<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/api/v{api_version}/{res}", name="api")
     * @Route("/api/v{api_version}/{res}/{id}", name="api_res_id")
     */
    public function apiAction(Request $request, $api_version, $res, $id = null)
    {
        /** @var string $path for API versioning */
        $path = $this->get('kernel')->locateResource('@AppBundle/Controller/api/v' . $api_version . '/ApiController.php');
        $apiController = 'AppBundle\Controller\api\v' . $api_version . '\ApiController';

        spl_autoload_register(function () use ($path) {
            require $path;
        });

        $apiController = $apiController::factory('AppBundle\Controller\api\v1\BookApiController');

        var_dump($apiController->apiAction(['id' => $id]));
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
