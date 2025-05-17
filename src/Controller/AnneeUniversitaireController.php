<?php

namespace App\Controller;

use App\Entity\AnneeUniversitaire;
use App\Form\AnneeUniversitaireType;
use App\Repository\AnneeUniversitaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/annee/universitaire')]

#[IsGranted('ROLE_ADMIN')]
class AnneeUniversitaireController extends AbstractController
{
    #[Route('/', name: 'app_annee_universitaire_index', methods: ['GET'])]
    public function index(AnneeUniversitaireRepository $anneeUniversitaireRepository): Response
    {
        return $this->render('annee_universitaire/index.html.twig', [
            'annee_universitaires' => $anneeUniversitaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_annee_universitaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $anneeUniversitaire = new AnneeUniversitaire();
        $form = $this->createForm(AnneeUniversitaireType::class, $anneeUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($anneeUniversitaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_universitaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annee_universitaire/new.html.twig', [
            'annee_universitaire' => $anneeUniversitaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annee_universitaire_show', methods: ['GET'])]
    public function show(AnneeUniversitaire $anneeUniversitaire): Response
    {
        return $this->render('annee_universitaire/show.html.twig', [
            'annee_universitaire' => $anneeUniversitaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annee_universitaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnneeUniversitaire $anneeUniversitaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnneeUniversitaireType::class, $anneeUniversitaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annee_universitaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annee_universitaire/edit.html.twig', [
            'annee_universitaire' => $anneeUniversitaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annee_universitaire_delete', methods: ['POST'])]
    public function delete(Request $request, AnneeUniversitaire $anneeUniversitaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anneeUniversitaire->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($anneeUniversitaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annee_universitaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
