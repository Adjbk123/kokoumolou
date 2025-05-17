<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil/', name: 'app_profil')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
     // Récupération des données du formulaire
        $currentPassword = $request->request->get('current_password');
        $newPassword = $request->request->get('new_password');
        $confirmPassword = $request->request->get('confirm_password');

        // Récupération de l'utilisateur actuellement authentifié
        $user = $this->getUser();

        // Vérification si les nouveaux mots de passe correspondent
        if ($newPassword !== $confirmPassword) {
            $this->addFlash('error', 'Les nouveaux mots de passe ne correspondent pas.');
            return $this->redirectToRoute('app_profil');
        }

        // Vérification si le mot de passe actuel est correct
        if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {

            $this->addFlash('error', 'Le mot de passe actuel est incorrect.');
            return $this->redirectToRoute('app_profil');
        }

        // Encodage et sauvegarde du nouveau mot de passe
        $user->setPassword($passwordHasher->hashPassword($user, $newPassword));

        $entityManager->persist($user);
        $entityManager->flush();
        return  $this->redirectToRoute('app_logout');

        }
        return $this->render('profil/index.html.twig', [

        ]);
    }
}
