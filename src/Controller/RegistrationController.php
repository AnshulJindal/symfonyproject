<?php

namespace App\Controller;

use App\Entity\Developers;
use App\Form\DevelopersType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register",name="app_registration")
     */
    public function registeraction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $Developer = new Developers();
        $form = $this->createForm(DevelopersType::class, $Developer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Developer->setPassword($encoder->encodePassword($Developer, $Developer->getPassword()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($Developer);
            $em->flush();
            return $this->redirectToRoute('app_homepage');
        }
        return  $this->render('defaults/registrationform.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
