<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/",name="app_homepage")
     */
    public function index()
    {
        return $this->render('defaults/homepage.html.twig');
    }

    /**
     * @Route("/questions/{slug}",name="app_question_show")
     */

    public function show($slug)
    {
        $answers=[
            'Anshul Jindal',
            'Karan Chadha',
            'Konark Kapil'
        ];
        $questionText="I 've been turned into a cat, any thoughts on how to turn back? While 
                        I 'm adorable, I don't really care for cat food.";
        return $this->render('defaults/show.html.twig',[
            'question' => ucwords(str_replace('-',' ',$slug)),
            'answers' => $answers,
            'questionText' => $questionText
        ]);
    }
}