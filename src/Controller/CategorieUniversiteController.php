<?php

namespace App\Controller;

use App\Entity\CategorieUniversite;
use App\Form\CategorieUniversiteType;
use App\Repository\CategorieUniversiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/categorie/universite')]
#[IsGranted('ROLE_ADMIN')]
class CategorieUniversiteController extends AbstractController
{
    #[Route('/', name: 'app_categorie_universite_index', methods: ['GET'])]
    public function index(CategorieUniversiteRepository $categorieUniversiteRepository): Response
    {
        return $this->render('categorie_universite/index.html.twig', [
            'categorie_universites' => $categorieUniversiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_universite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieUniversite = new CategorieUniversite();
        $form = $this->createForm(CategorieUniversiteType::class, $categorieUniversite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieUniversite);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_universite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_universite/new.html.twig', [
            'categorie_universite' => $categorieUniversite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_universite_show', methods: ['GET'])]
    public function show(CategorieUniversite $categorieUniversite): Response
    {
        return $this->render('categorie_universite/show.html.twig', [
            'categorie_universite' => $categorieUniversite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_universite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieUniversite $categorieUniversite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieUniversiteType::class, $categorieUniversite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_universite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie_universite/edit.html.twig', [
            'categorie_universite' => $categorieUniversite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_universite_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieUniversite $categorieUniversite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieUniversite->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($categorieUniversite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_universite_index', [], Response::HTTP_SEE_OTHER);
    }
}
