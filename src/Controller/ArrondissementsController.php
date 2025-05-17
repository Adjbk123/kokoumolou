<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArrondissementsController extends AbstractController
{
    #[Route('/arrondissements', name: 'app_arrondissements')]
    public function index(): Response
    {
        return $this->render('arrondissements/index.html.twig', [
            'controller_name' => 'ArrondissementsController',
        ]);
    }
}
