<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',  TextType::class, array(
                'label' => "Nom ou surnom de l'artiste:"
            ))
            ->add('speciality',  TextType::class, array(
                'label' => "Description de la spécialité de l'artiste:"
            ))
            ->add('imageFile', FileType::class, array(
                'required' => false,
                'label' => "Photo à importer:"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
