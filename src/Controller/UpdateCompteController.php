<?php

namespace App\Controller;

use App\Form\UpdateCompteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UpdateCompteController extends AbstractController
{
    private $emi;
    public function __construct(EntityManagerInterface $emi){
        $this->emi = $emi;
    }
    #[Route('/compte/update', name: 'updateCompte')]
    public function index(Request $request, UserPasswordHasherInterface $uphi): Response
    {
        // variable de notification (modification réussie OU non réussie)
        $notif = null;
        // récupérer l'utilisateur en cours(connecté)
        $user = $this->getUser();
        $form = $this->createForm(UpdateCompteType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // récupérer le mot de passe actuel depuis le formulaire
            $actualPassword = $form->get('oldPassword')->getData();
            // Tester si le mot de passe actuel est conforme au mot de passe 
            // de l'utilisateur connecté
            if($uphi->isPasswordValid($user, $actualPassword)){
                // récupérer le nouveau mot de passe actuel depuis le formulaire
                $newPassword = $form->get('newPassword')->getData();
                // Crypter le nouveau mot de passe
                $pwd = $uphi->hashPassword($user, $newPassword);
                // Placer le nouveau mot de passe (crypté) dans l'objet $user
                $user->setPassword($pwd);
                // Dans le cas d'une modification : le persist n'est pas obligatoire
                $this->emi->persist($user);
                $this->emi->flush();
                $notif = "!! Bravo modification réussie !!";
            }else{
                $notif = "!! Désolé impossible d'appliquer la modification !!";
            }
        }

        return $this->render('compte/updateCompte.html.twig', [
            'formUpdate' => $form->createView(),
            'notif' => $notif
        ]);
    }
}
