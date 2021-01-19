<?php
namespace App\Form;

use App\Entity\Developers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class DevelopersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imagelink',FileType::class,[
                'label' => 'Image',
                'attr' => [
                    'class' => 'custom-file'
                ]
            ])
            ->add('name',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Name...'
                ]
            ])
            ->add('email',EmailType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Email...'
                ]
            ])
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options'  => ['label' => 'Password',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Password...'
                    ]
                ],
                'second_options' => ['label' => 'Confirm Password',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Confirm Password...'
                    ]
                ]
            ])
            ->add('submit',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success mt-3 mx-auto d-block'
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Developers::class
        ]);
    }
}