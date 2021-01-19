<?php

namespace App\Controller;

use App\Entity\Developers;
use App\Form\DevelopersType;
use App\services\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/",name="app_registration")
     */
    public function registeraction(Request $request, UserPasswordEncoderInterface $encoder,FileUploader $fileuploader)
    {
        $Developer = new Developers();
        $form = $this->createForm(DevelopersType::class, $Developer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $Developer->setPassword($encoder->encodePassword($Developer, $Developer->getPassword()));
            /**
             * @var UploadedFile $file
             */
            $file = $request->files->get('developers')['imagelink'];
            if($file){
                $filename = $fileuploader->uploadFile($file);
                $Developer->setImagelink($filename);
            }
            dump($Developer);
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
