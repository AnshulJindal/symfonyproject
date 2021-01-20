<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
 {
     /**
      * @Route("/comments/{id}/vote/{direction<up|down>}",methods="POST")
      */
     public function commentVote($id, $direction)
     {
         if($direction === "up"){
             $currentVoteCount = rand(7,100);
         } else{
             $currentVoteCount = rand(0,5);
         }
         return $this->json(['votes' => $currentVoteCount]);
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