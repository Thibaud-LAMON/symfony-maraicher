<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductAdminController extends AbstractController
{
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    #[Route('/admin_products', name: 'app_product_admin')]
    public function index(): Response
    {
        /**
         * Devais contenir la logique métier de la page permettant
         * à l'administrateur de gérer les produits.
         */


        $displayName = $this->productsRepository->getName();
        $displayImage = $this->productsRepository->getImage();
        $displayPrice = $this->productsRepository->getPrice();
        $displayAll = $this->productsRepository->getAll();

        return $this->render('product_admin/index.html.twig', [
            'controller_name' => 'ProductAdminController',
            'name' => $displayName,
            'image' => $displayImage,
            'price' => $displayPrice,
            'products' => $displayAll
        ]);
    }
}
