<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $apiController = 'AppBundle\Controller\api\ApiController';

        spl_autoload_register(function ($class) use ($api_version) {
            /** api version switching */
            $class = str_replace('api\\', 'api\\v' . $api_version . '\\', $class);
	    $class_path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            $path = $this->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . $class_path . ".php";

            if (file_exists($path)) {
                require $path;
            } else {
                echo "API version $api_version is not implemented";
                die();
            }

        });

        $apiController = $apiController::factory('AppBundle\Controller\api\\' . $apiController::$mapRouteApiClass[$res],
            $this->getDoctrine()->getManager());

        return $apiController->apiAction([
            'id' => $id
        ]);
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
