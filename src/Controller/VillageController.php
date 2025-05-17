<?php

namespace App\Controller;

use App\Entity\Village;
use App\Form\VillageType;
use App\Repository\VillageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/village')]
class VillageController extends AbstractController
{
    #[Route('/', name: 'app_village_index', methods: ['GET'])]
    public function index(VillageRepository $villageRepository): Response
    {
        return $this->render('village/index.html.twig', [
            'villages' => $villageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_village_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $village = new Village();
        $form = $this->createForm(VillageType::class, $village);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($village);
            $entityManager->flush();

            return $this->redirectToRoute('app_village_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('village/new.html.twig', [
            'village' => $village,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_village_show', methods: ['GET'])]
    public function show(Village $village): Response
    {
        return $this->render('village/show.html.twig', [
            'village' => $village,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_village_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Village $village, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VillageType::class, $village);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_village_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('village/edit.html.twig', [
            'village' => $village,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_village_delete', methods: ['POST'])]
    public function delete(Request $request, Village $village, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$village->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($village);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_village_index', [], Response::HTTP_SEE_OTHER);
    }
}
