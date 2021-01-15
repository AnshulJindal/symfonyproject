<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
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
        $answers=[
            'Anshul Jindal',
            'Karan Chadha',
            'Konark Kapil'
        ];
        return $this->render('defaults/show.html.twig',[
            'question' => $slug,
            'answers' => $answers
        ]);
    }
}