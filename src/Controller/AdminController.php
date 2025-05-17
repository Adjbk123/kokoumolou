<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\EtudiantRepository;
use App\Repository\FiliereRepository;
use App\Repository\SerieRepository;
use App\Repository\UniversiteRepository;
use App\Repository\UserRepository;
use App\Repository\VillageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/portail', name: 'app_admin')]
    public function index(
        VillageRepository $villageRepository,
        FiliereRepository $filiereRepository,
        SerieRepository $serieRepository,
        EtudiantRepository $etudiantRepository,
        UserRepository $userRepository,
    ): Response
    {
        // Vérifier les rôles de l'utilisateur
        if ($this->getUser()->getRoles() == ["ROLE_SUP_VILLAGE", "ROLE_USER"]) {
            return $this->redirectToRoute('app_admin_village');
        }

        // Récupérer les données pour le tableau de bord
        $nbSerie = count($serieRepository->findAll());
        $nbVillage = count($villageRepository->findAll());
        $nbFiliere = count($filiereRepository->findAll());
        $nbEtudiant = count($etudiantRepository->findAll());

        // Récupérer les données spécifiques pour les graphiques
        $etudiantsParVillage = $etudiantRepository->countStudentsByVillage();
        $etudiantsParSexe = $etudiantRepository->countStudentsBySexe();
        $etudiantsParSerie = $etudiantRepository->countStudentsBySerie();
        $etudiantsParFiliere = $etudiantRepository->countStudentsByFiliere();

        // Récupérer les listes de filières, séries et villages
        $filiereList = $filiereRepository->findAll();
        $serieList = $serieRepository->findAll();
        $villageList = $villageRepository->findAll();

        // Initialiser des tableaux pour les données à afficher dans les graphiques
        $etudiantsParFiliereArray = [];
        $etudiantsParSerieArray = [];
        $etudiantsParVillageArray = [];
        $etudiantsParSexeArray = [
            'Masculin' => 0,
            'Féminin' => 0,
        ];

        // Remplir les tableaux avec les données récupérées
        foreach ($filiereList as $filiere) {
            $filiereName = $filiere->getLibelle();
            $etudiantsParFiliereArray[$filiereName] = 0; // Initialisation à 0
        }
        foreach ($etudiantsParFiliere as $item) {
            $filiereName = $item['filiere'];
            $etudiantsParFiliereArray[$filiereName] = $item['nbStudents'];
        }

        foreach ($serieList as $serie) {
            $serieName = $serie->getLibelle();
            $etudiantsParSerieArray[$serieName] = 0; // Initialisation à 0
        }
        foreach ($etudiantsParSerie as $item) {
            $serieName = $item['serie'];
            $etudiantsParSerieArray[$serieName] = $item['nbStudents'];
        }

        foreach ($villageList as $village) {
            $villageName = $village->getLibelle();
            $etudiantsParVillageArray[$villageName] = 0; // Initialisation à 0
        }
        foreach ($etudiantsParVillage as $item) {
            $villageName = $item['village'];
            $etudiantsParVillageArray[$villageName] = $item['nbStudents'];
        }

        // Compter les étudiants par sexe
        foreach ($etudiantsParSexe as $item) {
            $sexe = $item['sexe'];
            if ($sexe === 'Masculin') {
                $etudiantsParSexeArray['Masculin'] += $item['nbStudents'];
            } elseif ($sexe === 'Féminin') {
                $etudiantsParSexeArray['Féminin'] += $item['nbStudents'];
            }
        }

        // Rendre la vue avec toutes les données nécessaires
        return $this->render('admin/index.html.twig', [
            'nbSerie' => $nbSerie,
            'nbVillage' => $nbVillage,
            'nbFiliere' => $nbFiliere,
            'nbEtudiant' => $nbEtudiant,
            'etudiantsParVillage' => $etudiantsParVillageArray,
            'etudiantsParSexe' => $etudiantsParSexeArray,
            'etudiantsParSerie' => $etudiantsParSerieArray,
            'etudiantsParFiliere' => $etudiantsParFiliereArray,
            'villageLabels' => json_encode(array_keys($etudiantsParVillageArray)),
            'serieLabels' => json_encode(array_keys($etudiantsParSerieArray)),
            'filiereLabels' => json_encode(array_keys($etudiantsParFiliereArray)),
            'nbUser'=> count($userRepository->findAll()),
        ]);
    }
    #[Route('/portail/sup/village', name: 'app_admin_village')]
    public function indexVillage(


        EtudiantRepository $etudiantRepository
    ): Response
    {

      $village =  $this->getUser()->getVillage();
      $etudiant = $etudiantRepository->findBy(['village'=>$village]);
      $nbEtudiant = count($etudiant);

        return $this->render('admin/indexSupVillage.html.twig', [

            'nbEtudiant'=>$nbEtudiant
        ]);
    }

    #[Route('/etudiant/village', name: 'app_etudiant_village')]
    public function indexEtudiantVillage(


        EtudiantRepository $etudiantRepository
    ): Response
    {

        $village =  $this->getUser()->getVillage();
        $etudiant = $etudiantRepository->findBy(['village'=>$village]);
        $nbEtudiant = count($etudiant);

        return $this->render('user/indexEtudiantParVillage.html.twig', [

            'etudiants'=>$etudiant,
            'village'=>$village
        ]);
    }

}
