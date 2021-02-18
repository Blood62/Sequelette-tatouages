<?php

namespace App\Form;

use App\Entity\Galerie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('auteur',  TextType::class, array(
                'label' => "Auteur du tatouage/percing:"
            ))
            ->add('descriptif',  TextType::class, array(
                'label' => "Description et /ou commentaire de l'auteur:"
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
            'data_class' => Galerie::class,
        ]);
    }
}
