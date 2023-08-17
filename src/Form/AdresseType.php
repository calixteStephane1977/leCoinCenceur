<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Libellé de votre adresse',
                'attr' => [
                    'placeholder' => 'e.g. Domicile, Travail...'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'prénom indiqué sur le bon de commande'
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom de famille',
                'attr' => [
                    'placeholder' => 'nom indiqué sur le bon de commande'
                ]
            ])
            ->add('textAdresse', TextType::class, [
                'label' => 'N° et nom du voix',
                'attr' => [
                    'placeholder' => 'e.g. 1002 boulevard des paradis'
                ]
            ])
            ->add('societe', TextType::class, [
                'label' => 'Société (optionnel)',
                'attr' => [
                    'placeholder' => 'votre société'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'nécessaire pour la livraison'
                ]
            ])
            ->add('cp', TextType::class, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'e.g. 00540'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'ville de résidence'
                ]
            ])
            ->add('pays', CountryType::class, [
                'label' => 'Pays'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider mon adresse'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
