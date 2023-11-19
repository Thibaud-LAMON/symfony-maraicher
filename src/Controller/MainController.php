<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InformationsRepository;

class MainController extends AbstractController
{
    private $informationsRepository;

    public function __construct(InformationsRepository $informationsRepository)
    {
        $this->informationsRepository = $informationsRepository;
    }

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $displayAddress = $this->informationsRepository->getAddress();
        $displayTelephone = $this->informationsRepository->getTelephone();
        $displayTimetable = $this->informationsRepository->getTimetable();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'address' => $displayAddress,
            'telephone' => $displayTelephone,
            'timetable' => $displayTimetable,
        ]);
    }
}
