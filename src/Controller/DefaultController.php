<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response('Anshul Jindal');
    }

    /**
     * @Route("/questions/{slug}")
     */

    public function show($slug)
    {
        return new Response(sprintf('to show questions %s',$slug));
    }
}