<?php

namespace App\Controller;

use App\Entity\Universite;
use App\Form\UniversiteType;
use App\Repository\UniversiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/universite')]
#[IsGranted('ROLE_ADMIN')]
class UniversiteController extends AbstractController
{
    #[Route('/', name: 'app_universite_index', methods: ['GET'])]
    public function index(UniversiteRepository $universiteRepository): Response
    {
        return $this->render('universite/index.html.twig', [
            'universites' => $universiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_universite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $universite = new Universite();
        $form = $this->createForm(UniversiteType::class, $universite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($universite);
            $entityManager->flush();

            return $this->redirectToRoute('app_universite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('universite/new.html.twig', [
            'universite' => $universite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_universite_show', methods: ['GET'])]
    public function show(Universite $universite): Response
    {
        return $this->render('universite/show.html.twig', [
            'universite' => $universite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_universite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Universite $universite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UniversiteType::class, $universite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_universite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('universite/edit.html.twig', [
            'universite' => $universite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_universite_delete', methods: ['POST'])]
    public function delete(Request $request, Universite $universite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$universite->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($universite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_universite_index', [], Response::HTTP_SEE_OTHER);
    }
}
