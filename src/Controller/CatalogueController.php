<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    private $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }
    #[Route('/catalogue', name: 'catalogue')]
    public function index(): Response
    {
        $products = $this->emi->getRepository(Product::class)->findAll();
        // dd($products);
        return $this->render('catalogue/produits.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/product/{id}', name: 'product')]
    public function index1($id): Response
    {
        
        $product = $this->emi->getRepository(Product::class)->find($id);
        if(!$product){
            return $this->redirectToRoute('catalogue');
        }
        return $this->render('catalogue/detailsProduct.html.twig', [
            'product' => $product
        ]);
    }
}
