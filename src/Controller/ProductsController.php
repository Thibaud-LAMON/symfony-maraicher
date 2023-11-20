<?php

namespace App\Controller;

use App\Entity\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductsRepository;
use App\Form\CreateOrderForm;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ProductsController extends AbstractController
{
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    private function sendOrderConfirmationEmail($orderDetails, $clientEmail, $clientName, MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('example@example.com') // L'adresse email de l'expéditeur
            ->to($clientEmail)
            ->subject('Confirmation de Commande')
            ->html($this->renderView('emails/order_confirmation.html.twig', [
                'clientName' => $clientName,
                'orderDetails' => $orderDetails
            ]));

        $mailer->send($email);
    }


    #[Route('/products', name: 'app_products')]
    public function index(Request $request, $orderDetails, $clientEmail, $mailer, $clientName): Response
    {
        $displayName = $this->productsRepository->getName();
        $displayImage = $this->productsRepository->getImage();
        $displayPrice = $this->productsRepository->getPrice();

        $form = $this->createForm(CreateOrderForm::class, null, ['products_name' => $displayName,
            'products_image' => $displayImage,
            'products_price' => $displayPrice]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = new Orders();
            $order->setState('validé');
            $order->setCreatedAt(new \DateTime());
            /*foreach ($formData['products'] as $productData) {
                // ... logique pour traiter chaque produit
            }*/

            $this->sendOrderConfirmationEmail($orderDetails, $clientEmail, $clientName, $mailer);
        }

        return $this->render('products/index.html.twig', [
            'controller_name' => 'ProductsController',
            'name' => $displayName,
            'image' => $displayImage,
            'price' => $displayPrice,
        ]);
    }
}
