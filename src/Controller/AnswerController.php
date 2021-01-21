<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Entity\Questions;
use App\Form\AnswersType;
use App\Repository\QuestionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnswerController extends AbstractController
 {
     /**
      * @Route("/answer/{id}/vote/{direction<up|down>}")
      * @param Answers
      */
     public function commentVote(Answers $answer, $direction)
     {
        $em = $this->getDoctrine()->getManager();
        if($direction === "up"){
            $answer->setLikes($answer->getLikes() + 1);
        } else{
            $answer->setDislikes($answer->getDislikes() + 1);
         }
         $em->persist($answer);
         $em->flush();
         return new JsonResponse(["votes" => $answer->getLikes()-$answer->getDislikes()]);
     }



     /**
      * @Route("/submitanswer/{id}",name="app_submitanswer")
      * @param Questions
      */
     public function submitanswer(Questions $question, Request $request)
     {
        if(!$this->getUser()){
            return $this->redirect($this->generateUrl("app_login"));
        }
        $answer = new Answers();
        $form = $this->createForm(AnswersType::class, $answer);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $answer->setQuestions($question);
            $answer->setDeveloper($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($answer);
            $em->flush();
            return $this->redirect($this->generateUrl("app_homepage"));
        }
        return $this->render('defaults/submitanswer.html.twig',[
            "form" => $form->createView()
        ]);
     }


     /**
     * @Route("/questions/{slug}",name="app_question_show")
     */

    public function show($slug, QuestionsRepository $questionsRepository)
    {
        $question=$questionsRepository->find($slug);
        return $this->render('defaults/show.html.twig',[
            'question' => $question
        ]);
    }
 }