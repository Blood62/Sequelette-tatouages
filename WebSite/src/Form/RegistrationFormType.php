<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class,array(
                'label'=> 'Email:',
                'attr'=> array(
                    'placeholder'=>"Votre adresse mail"
                )))
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'=> "je valide",
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez valider pour confirmer',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label'=>'Mot de passe:',
                'attr'=> ['placeholder'=>'Votre Mot de passe'],
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe est composé de  {{ limit }} caractères minimum',
                        // max length allowed by Symfony for security reasons
                        'max' => 100,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
