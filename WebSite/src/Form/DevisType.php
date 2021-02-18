<?php

namespace App\Form;

use App\Entity\Corp;
use App\Entity\Devis;
use App\Entity\TarifHoraire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TarifHoraire', EntityType::class,array(
            'class'=>TarifHoraire::class,
            'required'=>true,
            'choice_label'=>'valeurTarif',
            'multiple'=> false,
            'label'=>'   '
        ))
            ->add('Contact', TextType::class, array(
                'label'=> "Email ou telephone (pour mieux vous contacter)"
            ))
            ->add('PartieCorp', EntityType::class, array(
                'class' => Corp::class,
                'label' => "Partie du corp:",
                'required' => false,
                'choice_label' => 'partie',
                'multiple' => false
            ))

            ->add('Temp', IntegerType::class, array(
                'label'=>"temp que vous estimez necessaire pour le  tatouage (en heures):",
                /*'choices' => range(0,20)*/
            ))
            ->add('Commentaire', TextareaType::class, array(
                'label'=>"Commentaire (pour plus de precision):"
            ))
            ->add('imageFile', FileType::class, array(
                'required' => false,
                'label' => "Photo à importer:(obligatoire)"
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
