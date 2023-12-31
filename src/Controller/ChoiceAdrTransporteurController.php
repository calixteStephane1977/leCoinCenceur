<?php

namespace App\Controller;

use App\Form\ChoisirAdresseType;
use App\Form\ChoisirTransporteurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChoiceAdrTransporteurController extends AbstractController
{
    #[Route('/compte/choisir/adresse', name: 'choisirAdresse')]
    public function index(): Response
    {
        $form= $this->createForm(ChoisirAdresseType::class,null,[
            'user' => $this->getUser()
        ]);
        
        return $this->render('choice/choisirAdresse.html.twig', [
            'f' => $form->createView()
        ]);
    }
    #[Route('/compte/choisir/transporteur', name: 'choisirTransporteur')]
    public function choisirTransporteur(Request $request): Response
    {   
        $adrL = null;
        $adrF = null;
        $formAdresse= $this->createForm(ChoisirAdresseType::class,null,['user'=> $this->getUser()]);
        $formAdresse->handleRequest($request);
        if($formAdresse->isSubmitted() && $formAdresse->isValid()){
            //Mettre l'adresse de livraison choisie dans la variable $adrL
            $adrL=$formAdresse->get('adresseLivraison')->getData();
            //Mettre l'adresse de facturation choisie dans la variable $adrF
            $adrF=$formAdresse->get('adresseFacturation')->getData();
        }

     $form= $this->createForm(ChoisirTransporteurType::class);
        
        return $this->render('choice/choisirTransporteur.html.twig', [
            'f' => $form->createView(),
            'adrL' => $adrL,
            'adrF' => $adrF
        ]);
    }
}
