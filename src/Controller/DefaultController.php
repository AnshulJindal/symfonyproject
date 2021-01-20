<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuestionsRepository;
use App\Entity\Questions;
use App\Form\QuestionsType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(QuestionsRepository $questionsRepository)
    {
        $questions=$questionsRepository->findAll();
        dd($questions);
        return $this->render('defaults/homepage.html.twig',[
            'questions' => $questions
        ]);
    }


    /**
     * @Route("/askquestion",name="app_ask_question")
     */

    public function askquestion(Request $request)
    {
        if(!$this->getUser()){
            return $this->redirect($this->generateUrl("app_login"));
        }
        $question = new Questions();
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $question->setDevelopers($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            return $this->redirect($this->generateUrl("app_homepage"));
        }
        return $this->render("defaults/askquestion.html.twig",[
            "question" => $question,
            "form" => $form->createView()
        ]);
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