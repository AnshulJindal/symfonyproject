<?php

namespace App\Controller;

use App\Entity\Developers;
use App\Form\DevelopersType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register",name="app_registration",methods="GET")
     */
    public function registeraction(Request $request)
    {
        $Developer = new Developers();
        $form = $this->createForm(DevelopersType::class, $Developer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

        }
        return  $this->render('defaults/registrationform.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
