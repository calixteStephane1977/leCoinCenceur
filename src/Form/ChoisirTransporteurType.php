<?php

namespace App\Form;

use App\Entity\Transporteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoisirTransporteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         //Récupérer les utilisateur en cours 
        $builder
            ->add('transporteurs',EntityType::class,[
                'label'=>'Choisir votre transporteur',
                'required'=>true,
                'class' =>Transporteur::class,
                'multiple'=>false,
                'expanded'=>true
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'Choisir votre transporteur',
                'attr'=>[
                    'class'=>'btn btn-success btn-block'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
       
        ]);
    }
}
