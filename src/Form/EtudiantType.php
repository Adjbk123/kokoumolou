<?php

namespace App\Form;

use App\Entity\AnneeUniversitaire;
use App\Entity\CategorieUniversite;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Serie;
use App\Entity\Universite;
use App\Entity\Village;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
               'label'=> 'Nom *'
            ])
            ->add('prenoms', TextType::class,[
                'label'=>'Prénoms *'
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'label'=>'Date de naissance *',
            ])
            ->add('lieuNaissance', TextType::class, [
                'label'=>'Lieu de naissance *'
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    "Masculin" => "Masculin",
                    "Féminin" => "Féminin",
                ],
                'label'=>'Sexe *',
                'required' => true,
                'multiple' => false,
            ])
            ->add('contactParent', TextType::class, [
                'label'=>'Contact parent *'
            ])
            ->add('anneeObtentionBac', NumberType::class,[
                'label'=>'Année d\'obtention du bac *',
            ])
            ->add('maison', TextType::class, [
                'label'=>'Maison * '
            ])
            ->add('contact',TextType::class, [
                'label'=>'Contact étudiant *'
            ])
            ->add('serie', EntityType::class, [
                'class' => Serie::class,
                'choice_label' => 'libelle',
                'label'=>'Série * ',
                'placeholder' => "-- Sélectionner --",
            ])
            ->add('village', EntityType::class, [
                'class' => Village::class,
                'choice_label' => 'libelle',
                'placeholder' => "-- Sélectionner --",
                'label'=>"Village *"
            ])
            ->add('university', TextType::class, [
                'label'=>'Nom université / école *',
            ])
            ->add('fil', TextType::class, [
                'label'=>'Filière *',

            ])
            ->add('anneeUniversitaire', EntityType::class, [
                'class' => AnneeUniversitaire::class,
                'choice_label' => 'libelle',
                'label'=>'Année Universitaire *',
                'placeholder' => "-- Sélectionner --",
            ])
            ->add('categorieUniversite', EntityType::class, [
                'class' => CategorieUniversite::class,
                'choice_label' => 'libelle',
                'label'=>'Catégorie Universitaire *',
                'placeholder' => "-- Sélectionner --",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
