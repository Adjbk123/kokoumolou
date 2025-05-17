<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Village;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSupVillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class, [
                'label'=>'Prénoms'
            ])
            ->add('contact', TextType::class, [
                'label'=>'Numéro de téléphone'
            ])
            ->add('email', EmailType::class, [
                'label'=>'Adresse Email'
            ])
            ->add('password', PasswordType::class, [
                'label'=>"Mot de passe"
            ])
            ->add('village', EntityType::class, [
                'class' => Village::class,
                'choice_label' => 'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
