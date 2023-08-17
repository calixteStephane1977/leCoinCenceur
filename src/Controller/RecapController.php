<?php

namespace App\Controller;

use App\Classe\Panier;
use App\Form\ChoisirTransporteurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class RecapController extends AbstractController
{
    #[Route('/compte/recap/{adrL}/{adrF}', name: 'recap')]
    public function index($adrF,$adrL,Panier $panier,Request $request): Response
    {
        $transporteurs=null;
        $formTransporteur = $this->createForm(ChoisirTransporteurType::class);
        $formTransporteur->handleRequest($request);
        if($formTransporteur->isSubmitted() && $formTransporteur->isValid()){
            $transporteur=$formTransporteur->get('transporteurs')->getData();
        }
        return $this->render('recap/recap.html.twig', [
            'adrL' => $adrL,
            'adrF' => $adrF,
            'panier' => $panier->afficherTout(),
            'transporteur' => $transporteur
        ]);
    }
}
