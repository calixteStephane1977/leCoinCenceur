<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre prénom min 2 caractères'
                ]
            ])
            ->add('lname', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length(2,2,35),
                'attr' => [
                    'placeholder' => 'Saisir votre nom min 2 caractères'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'numéro portable'
                ]
            ])
            ->add('birthday', DateType::class, [
                'label' => 'Date de naissance',
                'years' => range(1920,2010),
                'format' => 'dd-MM-yyyy'
            ])           
            ->add('email', EmailType::class, [
                'label' => 'Adresse électronique',
                'attr' => [
                    'placeholder' => 'Saisir une adresse électronique valide'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'label' => 'Mot de passe',
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe de confirmation non valide',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'saisir mot de passe']
                ],
                'second_options' => [
                    'label' => 'Cofirmation mot de passe',
                    'attr' => ['placeholder' => 'saisir confirmation mot de passe']
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
