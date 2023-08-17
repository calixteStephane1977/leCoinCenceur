<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChoisirAdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['user']; //Récupérer les utilisateur en cours 
        $builder
            ->add('adresseLivraison',EntityType::class,[
                'label'=>'Choisir votre adresse de livraison',
                'required'=>true,
                'class' =>Adresse::class,
                'choices'=>$user->getAdresses(),
                'multiple'=>false,
                'expanded'=>true
            ])
        
            ->add('adresseFacturation',EntityType::class,[
                'label'=>'Choisir votre adresse de facturation',
                'required'=>true,
                'class' =>Adresse::class,
                'choices'=>$user->getAdresses(),
                'multiple'=>false,
                'expanded'=>true
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'Valide mes adresses',
                    'attr'=>[
                        'class'=>'btn btn-success btn-block'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'user' => array()
        ]);
    }
}
