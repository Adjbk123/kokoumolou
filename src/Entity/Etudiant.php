<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
#[UniqueEntity(
    fields: ['contact'],
)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenoms = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieuNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $sexe = null;

    #[ORM\Column(length: 255)]
    private ?string $contactParent = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Serie $serie = null;

    #[ORM\Column]
    #[Assert\Length(
        min: 4,
        max: 4,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?int $anneeObtentionBac = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Village $village = null;

    #[ORM\Column(length: 255)]
    private ?string $maison = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Universite $universite = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Filiere $filiere = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?AnneeUniversitaire $anneeUniversitaire = null;

    #[ORM\Column(length: 255)]
    private ?string $contact = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?CategorieUniversite $categorieUniversite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $university = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): static
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): static
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getContactParent(): ?string
    {
        return $this->contactParent;
    }

    public function setContactParent(string $contactParent): static
    {
        $this->contactParent = $contactParent;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getAnneeObtentionBac(): ?int
    {
        return $this->anneeObtentionBac;
    }

    public function setAnneeObtentionBac(int $anneeObtentionBac): static
    {
        $this->anneeObtentionBac = $anneeObtentionBac;

        return $this;
    }

    public function getVillage(): ?Village
    {
        return $this->village;
    }

    public function setVillage(?Village $village): static
    {
        $this->village = $village;

        return $this;
    }

    public function getMaison(): ?string
    {
        return $this->maison;
    }

    public function setMaison(string $maison): static
    {
        $this->maison = $maison;

        return $this;
    }

    public function getUniversite(): ?Universite
    {
        return $this->universite;
    }

    public function setUniversite(?Universite $universite): static
    {
        $this->universite = $universite;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }

    public function getAnneeUniversitaire(): ?AnneeUniversitaire
    {
        return $this->anneeUniversitaire;
    }

    public function setAnneeUniversitaire(?AnneeUniversitaire $anneeUniversitaire): static
    {
        $this->anneeUniversitaire = $anneeUniversitaire;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getCategorieUniversite(): ?CategorieUniversite
    {
        return $this->categorieUniversite;
    }

    public function setCategorieUniversite(?CategorieUniversite $categorieUniversite): static
    {
        $this->categorieUniversite = $categorieUniversite;

        return $this;
    }

    public function getUniversity(): ?string
    {
        return $this->university;
    }

    public function setUniversity(?string $university): static
    {
        $this->university = $university;

        return $this;
    }

    public function getFil(): ?string
    {
        return $this->fil;
    }

    public function setFil(?string $fil): static
    {
        $this->fil = $fil;

        return $this;
    }
}
