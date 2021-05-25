<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class HelloController
 * @package App\Controller
 */
class HelloController extends AbstractFOSRestController
{
	/**
	 * @Route("/", name="hello", methods="GET")
     */
    public function indexAction(): Response
    {
        return new JsonResponse([
            'hello' => 'This is the test of stefan izdrail',
            'docs_path' => '/api/doc'
        ]);
    }
}
